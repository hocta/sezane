<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\ViewRender\Shop\Save;

use Sezane\Util\Traits\JsonViewRenderTrait;
use Sezane\Shop\Presentation\Shop\Save\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonViewRender
{
    use JsonViewRenderTrait;

    public function __construct(
        private TranslatorInterface $translator
    )
    {
    }

    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $message = $this->translator->trans($viewModel->getGlobalMessage());

        if ($viewModel->getErrors() instanceof ConstraintViolationList && $viewModel->getErrors()->count() > 0) {
            $validationErrors = [];

            foreach ($viewModel->getErrors()->getIterator() as $validationError) {
                $validationErrorMessage = $this->translator->trans($validationError->getMessage());
                $validationErrors[$validationError->getPropertyPath()] = $validationErrorMessage;
            }
            $result['code'] = $this->codeError();
            $result['errors'] = $validationErrors;
        } elseif ($viewModel->getCustomErrors()) {

            $result['code'] = $this->codeError();
            foreach ($viewModel->getCustomErrors() as $errorCustom) {
                $result['errors'][] = $this->translator->trans($errorCustom);
            }
        } else {
            $result['code'] = $this->codeSuccess();
            $result['shop'] = [
                'id' => $viewModel->getShop()->getId(),
                'name' => $viewModel->getShop()->getName(),
                'latitude' => $viewModel->getShop()->getLatitude(),
                'longitude' => $viewModel->getShop()->getLongitude(),
                'address' => $viewModel->getShop()->getAddress(),
                'manager' => $viewModel->getShop()->getManager()->getId()
            ];
        }

        $output['message'] = $message;
        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}