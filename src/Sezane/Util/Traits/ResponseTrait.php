<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Util\Traits;

use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ResponseTrait
{
    private ?string $globalErrorMessage = null;
    private ?ConstraintViolationListInterface $errorsContraint = null;

    public function getGlobalErrorMessage(): ?string
    {
        return $this->globalErrorMessage;
    }

    public function setGlobalErrorMessage(string $globalErrorMessage): self
    {
        $this->globalErrorMessage = $globalErrorMessage;
        return $this;
    }

    public function getErrors(): ?ConstraintViolationListInterface
    {
        return $this->errorsContraint;
    }

    public function setErrors(?ConstraintViolationListInterface $errors): self
    {
        $this->errorsContraint = $errors;
        return $this;
    }
}