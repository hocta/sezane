<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Controller\Api\ProductShop;

use Sezane\Product\Domain\UseCase\ProductShop\Save\saveRequest;
use Sezane\Product\Infrastructure\ViewRender\ProductShop\Save\JsonViewRender;
use Sezane\Product\Presentation\ProductShop\Save\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sezane\Product\Domain\UseCase\ProductShop\Save\Save as UCAdd;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Save extends AbstractController
{
    public function __construct(
        private JsonPresenter  $presenter,
        private JsonViewRender $viewRender,
        private UCAdd          $add
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent());
        $parameters = $json->parameters ?? null;

        $addRequest = new saveRequest();

        if($parameters) {
            $addRequest
                ->setProductShopId($parameters->productShopId ?? null)
                ->setProductId($parameters->productId ?? null)
                ->setShopId($parameters->shopId ?? null)
                ->setQuantity($parameters->quantity ?? null);
        }

        $this->add->execute($addRequest, $this->presenter);
        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}