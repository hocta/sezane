<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Controller\Api\Shop;

use Sezane\Shop\Domain\UseCase\Shop\Save\Save as UCSave;
use Sezane\Shop\Domain\UseCase\Shop\Save\SaveRequest;
use Sezane\Shop\Infrastructure\ViewRender\Shop\Save\JsonViewRender;
use Sezane\Shop\Presentation\Shop\Save\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Save extends AbstractController
{
    public function __construct(
        private JsonPresenter  $presenter,
        private JsonViewRender $viewRender,
        private UCSave          $save
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent());
        $parameters = $json->parameters ?? null;

        $saveRequest = new SaveRequest();

        if($parameters) {
            $saveRequest
                ->setShopId($parameters->shopId ?? null)
                ->setName($parameters->name)
                ->setLatitude($parameters->latitude)
                ->setLongitude($parameters->longitude)
                ->setAddress($parameters->address);
        }

        $this->save->execute($saveRequest, $this->presenter);

        return $this->viewRender->generateView(
            $this->presenter->getViewModel()
        );
    }
}