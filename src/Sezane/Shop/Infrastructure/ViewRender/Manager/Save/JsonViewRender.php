<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\ViewRender\Manager\Save;

use Sezane\Shop\Presentation\Manager\Save\ViewModel;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonViewRender
{
    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $message = $this->translator->trans($viewModel->getGlobalMessage());

        if ($viewModel->getManager()) {
            $result = [
                'code' => 'OK',
                'manager' => [
                    'id' => $viewModel->getManager()->getId(),
                    'firstName' => $viewModel->getManager()->getFirstName(),
                    'lastName' => $viewModel->getManager()->getLastName(),
                ]
            ];

            foreach ($viewModel->getShops() as $shop) {
                $result['shops'][] = [
                    'id' => $shop->getId(),
                    'name' => $shop->getName(),
                    'latitude' => $shop->getLatitude(),
                    'longitude' => $shop->getLongitude(),
                    'address' => $shop->getAddress(),
                ];
            }
        } else {
            $result['code'] = 'KO';

            if ($viewModel->getCustomErrors()) {
                foreach ($viewModel->getCustomErrors() as $error) {
                    $result['errors'][] = $this->translator->trans($error);
                }
            }
        }

        $output['message'] = $message;
        $output['result'] = $result;

        return new JsonResponse(
            $output,
            $httpResponse
        );
    }
}