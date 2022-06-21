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

        if (null !== $viewModel->getGlobalMessage()) {
            $httpResponse = Response::HTTP_BAD_GATEWAY;
            $message = $this->translator->trans($viewModel->getGlobalMessage());

            if ($viewModel->getErrors() instanceof ConstraintViolationList && $viewModel->getErrors()->count() > 0) {
                $httpResponse = Response::HTTP_BAD_REQUEST;
                $validationErrors = [];

                foreach ($viewModel->getErrors()->getIterator() as $validationError) {
                    $validationErrorMessage = $this->translator->trans($validationError->getMessage());
                    $validationErrors[$validationError->getPropertyPath()] = $validationErrorMessage;
                }
                $result['errors'] = $validationErrors;
            }
        } else {
            $message = $this->translator->trans('shop.add.message.success');
            $result['msg'] = $this->translator->trans('shop.add.success');
        }

        $output['message'] = $message;
        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}