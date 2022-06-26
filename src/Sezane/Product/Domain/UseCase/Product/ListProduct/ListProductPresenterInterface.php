<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\ListProduct;

interface ListProductPresenterInterface
{
    public function present(ListProductResponse $response): void;
}