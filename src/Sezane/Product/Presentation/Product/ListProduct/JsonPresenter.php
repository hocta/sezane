<?php

declare(strict_types=1);

namespace Sezane\Product\Presentation\Product\ListProduct;

use Sezane\Product\Domain\UseCase\Product\ListProduct\ListProductPresenterInterface;
use Sezane\Product\Domain\UseCase\Product\ListProduct\ListProductResponse;

class JsonPresenter implements ListProductPresenterInterface
{
    private ViewModel $viewModel;

    public function present(ListProductResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setGlobalMessage($response->getGlobalMessage())
            ->setProducts($response->getProducts());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}