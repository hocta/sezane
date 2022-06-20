<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

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
            ->setGlobalErrorMessage($response->getGlobalErrorMessage())
            ->setShops($response->getShops());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}