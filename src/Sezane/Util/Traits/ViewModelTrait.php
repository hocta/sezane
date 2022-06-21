<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Util\Traits;

use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ViewModelTrait
{
    private ?string $globalMessage = null;
    private ?ConstraintViolationListInterface $constraintErrors = null;

    public function getGlobalMessage(): ?string
    {
        return $this->globalMessage;
    }

    public function setGlobalMessage(?string $globalMessage): self
    {
        $this->globalMessage = $globalMessage;
        return $this;
    }

    public function getErrors(): ?ConstraintViolationListInterface
    {
        return $this->constraintErrors;
    }

    public function setErrors(?ConstraintViolationListInterface $errors): self
    {
        $this->constraintErrors = $errors;
        return $this;
    }
}