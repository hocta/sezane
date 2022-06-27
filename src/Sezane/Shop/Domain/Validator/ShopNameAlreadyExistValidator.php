<?php

namespace Sezane\Shop\Domain\Validator;

use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Domain\Model\Shop;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ShopNameAlreadyExistValidator extends ConstraintValidator
{
    public function __construct(
        private ShopManager $shopManager
    )
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ShopNameAlreadyExist) {
            throw new UnexpectedTypeException($constraint, ShopNameAlreadyExist::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        $shop = $this->shopManager->findOneBy(['name' => $value]);

        if ($shop instanceof Shop) {
            $this
                ->context
                ->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}