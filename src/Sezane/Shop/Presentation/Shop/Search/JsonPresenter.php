<?php

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Shop\Search;

use Sezane\Shop\Domain\UseCase\Shop\Search\SearchPresenterInterface;
use Sezane\Shop\Domain\UseCase\Shop\Search\SearchResponse;

class JsonPresenter implements SearchPresenterInterface
{
    private ViewModel $viewModel;

    public function present(SearchResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setGlobalMessage($response->getGlobalMessage())
            ->setShops($response->getShops());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}