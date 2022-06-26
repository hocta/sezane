<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Controller\Api\ProductShop\Stock;

use Sezane\Product\Domain\UseCase\ProductShop\Stock\Get as UCStock;
use Sezane\Product\Domain\UseCase\ProductShop\Stock\GetRequest;
use Sezane\Product\Infrastructure\ViewRender\ProductShop\Stock\JsonViewRender;
use Sezane\Product\Presentation\ProductShop\Stock\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Get extends AbstractController
{
    public function __construct(
        private JsonPresenter  $presenter,
        private JsonViewRender $viewRender,
        private UCStock        $stock
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent());
        $parameters = $json->parameters ?? null;

        $stockRequest = new GetRequest();

        if ($parameters) {
            $stockRequest
                ->setProductId($parameters->productId)
                ->setShopsId($parameters->shopsId);
        }

        $this->stock->execute($stockRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}