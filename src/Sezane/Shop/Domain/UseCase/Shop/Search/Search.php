<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Search;

use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Presentation\Shop\Search\JsonPresenter;

class Search
{
    public function __construct(
        private ShopManager $shopManager
    )
    {
    }

    public function execute(
        SearchRequest $request,
        JsonPresenter $presenter
    ): void
    {
        $response = new SearchResponse();

        $shops = $this->shopManager->search(
            [
                'name' => $request->getName(),
                'latitude' => $request->getLatitude(),
                'longitude' => $request->getLongitude(),
                'distance' => $request->getDistance()
            ],
            $request->getPage(),
            [
                'distance' => 'ASC',
                's.name' => 'ASC'
            ]
        );

        if(!$shops){
            $response->setGlobalMessage('shop.search.message.result_empty');
        }

        $response->setShops($shops);
        $presenter->present($response);
    }
}