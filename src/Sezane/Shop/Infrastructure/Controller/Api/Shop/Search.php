<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Controller\Api\Shop;

use Sezane\Shop\Domain\UseCase\Shop\Search\SearchRequest;
use Sezane\Shop\Infrastructure\ViewRender\Shop\Search\JsonViewRender;
use Sezane\Shop\Presentation\Shop\Search\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sezane\Shop\Domain\UseCase\Shop\Search\Search as UCSearch;

class Search extends AbstractController
{
    public function __construct(
        private JsonPresenter $presenter,
        private JsonViewRender $viewRender,
        private UCSearch $search
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $searchRequest = new SearchRequest();
        $searchRequest
            ->setName($request->get('name'))
            ->setLatitude($request->get('latitude'))
            ->setLongitude($request->get('longitude'))
            ->setDistance($request->get('distance'))
            ->setPage(intval($request->get('page')));

        $this->search->execute($searchRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}