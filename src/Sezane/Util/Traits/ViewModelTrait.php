<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Util\Traits;

use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ViewModelTrait
{
    private ?string $globalErrorMessage = null;
    private ?ConstraintViolationListInterface $constraintErrors = null;

    public function getGlobalErrorMessage(): ?string
    {
        return $this->globalErrorMessage;
    }

    public function setGlobalErrorMessage(?string $globalErrorMessage): self
    {
        $this->globalErrorMessage = $globalErrorMessage;
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