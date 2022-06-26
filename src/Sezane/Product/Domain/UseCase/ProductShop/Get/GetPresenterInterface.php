<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\ProductShop\Get;

interface GetPresenterInterface
{
    public function present(GetResponse $response): void;
}