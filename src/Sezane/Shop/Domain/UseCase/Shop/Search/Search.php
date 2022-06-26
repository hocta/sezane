<?php

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

        $shops = $this->shopManager->searchByName(
            [
                'name' => $request->getName(),
                'latitude' => $request->getLatitude(),
                'longitude' => $request->getLongitude(),
                'distance' => $request->getDistance()
            ],
            $request->getPage(),
            $request->getOrderBy(),
            $request->getLimit()
        );

        if(!$shops){
            $response->setGlobalMessage('shop.search.message.result_empty');
        }

        $response->setShops($shops);
        $presenter->present($response);
    }
}