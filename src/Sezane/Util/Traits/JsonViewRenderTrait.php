<?php

declare(strict_types=1);

namespace Sezane\Util\Traits;

trait JsonViewRenderTrait
{
    private function codeSuccess(): string
    {
        return 'OK';
    }

    private function codeError(): string
    {
        return 'KO';
    }
}