<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Stock;

interface GetPresenterInterface
{
    public function present(GetResponse $response): void;
}