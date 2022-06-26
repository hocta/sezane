<?php

declare(strict_types=1);

namespace Sezane\Product\Presentation\ProductShop\Save;

use Sezane\Product\Domain\UseCase\ProductShop\Save\SavePresenterInterface;
use Sezane\Product\Domain\UseCase\ProductShop\Save\SaveResponse;

class JsonPresenter implements SavePresenterInterface
{
    private ViewModel $viewModel;

    public function present(SaveResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setProduct($response->getProduct())
            ->setShop($response->getShop())
            ->setProductShopId($response->getProductShopId())
            ->setQuantity($response->getQuantity())
            ->setGlobalMessage($response->getGlobalMessage())
            ->setCustomErrors($response->getCustomErrors());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}