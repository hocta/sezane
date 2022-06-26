<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Controller\Api\Product;

use Sezane\Product\Domain\UseCase\Product\ListProduct\ListProductRequest;
use Sezane\Product\Infrastructure\ViewRender\Product\ListProduct\JsonViewRender;
use Sezane\Product\Presentation\Product\ListProduct\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sezane\Product\Domain\UseCase\Product\ListProduct\ListProduct as UCListProduct;

class ListProduct extends AbstractController
{
    public function __construct(
        private JsonPresenter $presenter,
        private JsonViewRender $viewRender,
        private UCListProduct $listProduct
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent());

        if (!empty($json->orderBy)) {
            $orderBy = [
                'name' => $json->orderBy->name ?? null
            ];
        }

        $listRequest = new ListProductRequest();
        $listRequest
            ->setOrderBy($orderBy)
            ->setLimit($json->limit ?? null)
            ->setPage($json->page);

        $this->listProduct->execute($listRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}