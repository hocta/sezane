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
        private JsonPresenter  $presenter,
        private JsonViewRender $viewRender,
        private UCSearch       $search
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $searchRequest = new SearchRequest();

        $json = json_decode($request->getContent());
        $parameters = $json->parameters ?? null;

        if ($parameters) {
            $searchRequest
                ->setName($parameters->name)
                ->setLatitude($parameters->latitude ?? null)
                ->setLongitude($parameters->longitude ?? null)
                ->setDistance($parameters->distance ?? null);
        }

        if (!empty($json->orderBy)) {
            $orderBy = [
                'distance' => $json->orderBy->distance ?? null,
                'name' => $json->orderBy->name ?? null
            ];
        }

        $searchRequest
            ->setPage($json->page ?? null)
            ->setOrderBy($orderBy ?? [])
            ->setLimit($json->limit ?? null);

        $this->search->execute($searchRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}