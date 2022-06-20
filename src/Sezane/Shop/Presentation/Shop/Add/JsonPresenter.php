<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Presentation\Shop\Add;

use Sezane\Shop\Domain\UseCase\Shop\Add\AddPresenterInterface;
use Sezane\Shop\Domain\UseCase\Shop\Add\AddResponse;

class JsonPresenter implements AddPresenterInterface
{
    private ViewModel $viewModel;

    public function present(AddResponse $response): void
    {
        $viewModel = new ViewModel();
        $viewModel
            ->setGlobalErrorMessage($response->getGlobalErrorMessage())
            ->setErrors($response->getErrors());
        $this->viewModel = $viewModel;
    }

    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }

}