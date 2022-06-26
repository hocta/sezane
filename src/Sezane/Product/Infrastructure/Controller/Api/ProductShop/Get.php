<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Controller\Api\ProductShop;

use Sezane\Product\Domain\UseCase\ProductShop\Get\Get as UCGet;
use Sezane\Product\Domain\UseCase\ProductShop\Get\GetRequest;
use Sezane\Product\Infrastructure\ViewRender\ProductShop\Get\JsonViewRender;
use Sezane\Product\Presentation\ProductShop\Get\JsonPresenter;
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
        $json = json_decode($request->getContent());
        $parameters = $json->parameters ?? null;

        $getRequest = new GetRequest();

        $orderBy = [];

        if (!empty($json->orderBy)) {
            $orderBy = [
                'name' => $json->orderBy->name ?? null
            ];
        }

        if ($parameters) {
            $getRequest
                ->setPage($json->page)
                ->setLimit($json->limit)
                ->setShopId($parameters->shopId ?? null)
                ->setOrderBy($orderBy);
        }

        $this->get->execute($getRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}