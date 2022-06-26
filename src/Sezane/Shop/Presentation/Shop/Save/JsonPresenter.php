<?php

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Shop\Save;

use Sezane\Shop\Domain\UseCase\Shop\Save\SavePresenterInterface;
use Sezane\Shop\Domain\UseCase\Shop\Save\SaveResponse;

class JsonPresenter implements SavePresenterInterface
{
    private ViewModel $viewModel;

    public function present(SaveResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setShop($response->getShop())
            ->setGlobalMessage($response->getGlobalMessage())
            ->setErrors($response->getErrors());

        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }

}