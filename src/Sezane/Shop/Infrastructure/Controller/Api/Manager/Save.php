<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Controller\Api\Manager;

use Sezane\Shop\Domain\UseCase\Manager\Save\SaveRequest;
use Sezane\Shop\Infrastructure\ViewRender\Manager\Save\JsonViewRender;
use Sezane\Shop\Presentation\Manager\Save\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sezane\Shop\Domain\UseCase\Manager\Save\Save as UCSave;

class Save extends AbstractController
{
    public function __construct(
        private JsonPresenter $presenter,
        private JsonViewRender $viewRender,
        private UCSave $save
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent());
        $parameters = $json->parameters ?? null;

        $saveRequest = new SaveRequest();
        $saveRequest
            ->setManagerId($parameters->managerId ?? null)
            ->setFirstName($parameters->firstName ?? null)
            ->setLastName($parameters->lastName ?? null)
            ->setShopsId($parameters->shopsId ?? null);

        $this->save->execute($saveRequest, $this->presenter);

        return $this->viewRender->generateView($this->presenter->getViewModel());
    }
}