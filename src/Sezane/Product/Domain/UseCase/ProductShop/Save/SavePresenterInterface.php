<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Save;

interface SavePresenterInterface
{
    public function present(SaveResponse $response): void;
}