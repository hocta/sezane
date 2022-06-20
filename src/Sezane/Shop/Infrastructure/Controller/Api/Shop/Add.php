<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Controller\Api\Shop;

use Sezane\Shop\Domain\UseCase\Shop\Add\Add as UCAdd;
use Sezane\Shop\Domain\UseCase\Shop\Add\AddRequest;
use Sezane\Shop\Infrastructure\ViewRender\Shop\Add\JsonViewRender;
use Sezane\Shop\Presentation\Shop\Add\JsonPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Add extends AbstractController
{
    public function __construct(
        private JsonPresenter  $presenter,
        private JsonViewRender $viewRender,
        private UCAdd          $add
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $addRequest = new AddRequest();
        $addRequest
            ->setName($request->get('name'))
            ->setLatitude(floatval($request->get('latitude')))
            ->setLongitude(floatval($request->get('longitude')))
            ->setAddress($request->get('address'));

        $this->add->execute($addRequest, $this->presenter);

        return $this->viewRender->generateView(
            $this->presenter->getViewModel()
        );
    }
}