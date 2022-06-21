<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Search;

interface SearchPresenterInterface
{
    public function present(SearchResponse $response): void;
}