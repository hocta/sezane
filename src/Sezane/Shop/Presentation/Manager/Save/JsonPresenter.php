<?php

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Manager\Save;

use Sezane\Shop\Domain\UseCase\Manager\Save\SavePresenterInterface;
use Sezane\Shop\Domain\UseCase\Manager\Save\SaveResponse;

class JsonPresenter implements SavePresenterInterface
{
    private ViewModel $viewModel;

    public function present(SaveResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setGlobalMessage($response->getGlobalMessage())
            ->setCustomErrors($response->getCustomErrors())
            ->setManager($response->getManager())
            ->setShops($response->getShops());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}