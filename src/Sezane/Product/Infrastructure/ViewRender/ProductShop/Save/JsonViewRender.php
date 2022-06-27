<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\ViewRender\ProductShop\Save;

use Sezane\Product\Presentation\ProductShop\Save\ViewModel;
use Sezane\Util\Traits\JsonViewRenderTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

class JsonViewRender
{
    use JsonViewRenderTrait;

    public function __construct(private TranslatorInterface $translator)
    {
    }

    public function generateView(ViewModel $viewModel): JsonResponse
    {
        $httpResponse = Response::HTTP_OK;
        $message = $this->translator->trans($viewModel->getGlobalMessage());

        if ($viewModel->getCustomErrors()) {

            $httpResponse = Response::HTTP_BAD_REQUEST;
            $result['code'] = $this->codeError();

            foreach ($viewModel->getCustomErrors() as $error) {
                $result['errors'][] = $this->translator->trans($error);
            }

        } else {
            $result = [
                'code' => $this->codeSuccess(),
                'productShopId' => $viewModel->getProductShopId(),
                'quantity' => $viewModel->getQuantity(),
                'product' => [
                    'id' => $viewModel->getProduct()->getId(),
                    'name' => $viewModel->getProduct()->getName(),
                    'imageUrl' => $viewModel->getProduct()->getImageUrl()
                ],
                'shop' => [
                    'id' => $viewModel->getShop()->getId(),
                    'name' => $viewModel->getShop()->getName(),
                    'latitude' => $viewModel->getShop()->getLatitude(),
                    'longitude' => $viewModel->getShop()->getLongitude(),
                    'address' => $viewModel->getShop()->getAddress(),
                    'manager_id' => $viewModel->getShop()->getManager()->getId(),
                ]
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