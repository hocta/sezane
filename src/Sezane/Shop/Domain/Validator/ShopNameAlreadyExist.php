<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\Validator;

use Symfony\Component\Validator\Constraint;

class ShopNameAlreadyExist extends Constraint
{
    public string $message = 'Cette boutique "{{ string }}" existe déjà';

    public function validatedBy(): string
    {
        return static::class.'Validator';
    }
}