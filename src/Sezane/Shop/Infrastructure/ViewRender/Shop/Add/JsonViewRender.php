<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\ViewRender\Shop\Add;

use Sezane\Shop\Presentation\Shop\Add\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonViewRender
{
    public function __construct(
        private TranslatorInterface $translator
    )
    {
    }

    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;

        if (null !== $viewModel->getGlobalErrorMessage()) {
            $httpResponse = Response::HTTP_BAD_GATEWAY;
            $output['message'] = $this->translator->trans($viewModel->getGlobalErrorMessage());

            if ($viewModel->getErrors() instanceof ConstraintViolationList && $viewModel->getErrors()->count() > 0) {
                $httpResponse = Response::HTTP_BAD_REQUEST;
                $validationErrors = [];

                foreach ($viewModel->getErrors()->getIterator() as $validationError) {
                    $validationErrorMessage = $this->translator->trans($validationError->getMessage());
                    $validationErrors[$validationError->getPropertyPath()] = $validationErrorMessage;
                }
                $output['errors'] = $validationErrors;
            }
        } else {
            $output['message'] = $this->translator->trans('shop.add.success');
        }

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}