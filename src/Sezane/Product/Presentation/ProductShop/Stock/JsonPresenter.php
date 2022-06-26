<?php

declare(strict_types=1);

namespace Sezane\Product\Presentation\ProductShop\Stock;

use Sezane\Product\Domain\UseCase\ProductShop\Stock\GetPresenterInterface;
use Sezane\Product\Domain\UseCase\ProductShop\Stock\GetResponse;

class JsonPresenter implements GetPresenterInterface
{
    private ViewModel $viewModel;

    public function present(GetResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setGlobalMessage($response->getGlobalMessage())
            ->setProduct($response->getProduct())
            ->setProductShops($response->getProductShops());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}