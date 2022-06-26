<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Save;

interface SavePresenterInterface
{
    public function present(SaveResponse $response): void;
}