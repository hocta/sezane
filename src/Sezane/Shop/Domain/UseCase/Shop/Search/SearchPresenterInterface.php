<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Search;

interface SearchPresenterInterface
{
    public function present(SearchResponse $response): void;
}