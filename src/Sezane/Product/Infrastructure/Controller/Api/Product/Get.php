<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Controller\Api\Product;

use Sezane\Product\Domain\UseCase\Product\Get\Get as UCGet;
use Sezane\Product\Domain\UseCase\Product\Get\GetRequest;
use Sezane\Product\Infrastructure\ViewRender\Product\Get\JsonViewRender;
use Sezane\Product\Presentation\Product\Get\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Get extends AbstractController
{
    public function __construct(
        private JsonPresenter  $presenter,
        private JsonViewRender $viewRender,
        private UCGet          $get
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $getRequest = new GetRequest();
        $getRequest
            ->setPage($request->get('page'))
            ->setShopId($request->get('shopId'));

        $this->get->execute($getRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}