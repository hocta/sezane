<?php

declare(strict_types=1);

namespace Sezane\Util\Traits;

use Symfony\Component\Validator\ConstraintViolationListInterface;

trait ResponseTrait
{
    private ?string $globalMessage = null;
    private ?ConstraintViolationListInterface $errorsContraint = null;
    private ?array $customErrors = null;

    public function getGlobalMessage(): ?string
    {
        return $this->globalMessage;
    }

    public function setGlobalMessage(string $globalMessage): self
    {
        $this->globalMessage = $globalMessage;
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

    public function getCustomErrors(): ?array
    {
        return $this->customErrors;
    }

    public function addCustomErrors(string $error): self
    {
        $this->customErrors = $this->customErrors ?? [];

        if (!in_array($error, $this->customErrors)) {
            array_push($this->customErrors, $error);
        }

        return $this;
    }
}