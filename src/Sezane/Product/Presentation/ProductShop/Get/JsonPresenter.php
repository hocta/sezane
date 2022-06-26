<?php

declare(strict_types=1);

namespace Sezane\Product\Presentation\ProductShop\Get;

use Sezane\Product\Domain\UseCase\ProductShop\Get\GetPresenterInterface;
use Sezane\Product\Domain\UseCase\ProductShop\Get\GetResponse;

class JsonPresenter implements GetPresenterInterface
{
    private ViewModel $viewModel;

    public function present(GetResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setShop($response->getShop())
            ->setProducts($response->getProducts())
            ->setGlobalMessage($response->getGlobalMessage());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}