<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Manager\Save;

use Sezane\Shop\Domain\Manager\ManagerManager;
use Sezane\Shop\Domain\Manager\ShopManager;
use Sezane\Shop\Domain\Model\Manager;
use Sezane\Shop\Domain\Model\Shop;

class Save
{

    public function __construct(
        private ManagerManager $managerManager,
        private ShopManager    $shopManager
    )
    {
    }

    public function execute(
        SaveRequest            $request,
        SavePresenterInterface $presenter
    ): void
    {
        $response = new SaveResponse();

        $criteria = [
            'firstName' => $request->getFirstName(),
            'lastName' => $request->getLastName()
        ];

        $manager = $this->managerManager->findOneBy($criteria);

        if ($manager && $request->getManagerId() != $manager->getId()) {
            $response
                ->setGlobalMessage('manager.save.message.error')
                ->addCustomErrors('manager.save.message.firstname_lastname_exist');
        } else {

            $manager = new Manager();
            $manager
                ->setId($request->getManagerId())
                ->setFirstName($request->getFirstName())
                ->setLastName($request->getLastName());

            $saveManager = $this->managerManager->save($manager);

            if ($saveManager && $request->getShopsId()) {

                $shops = $this->shopManager->searchByIds($request->getShopsId());

                foreach ($shops as $shop) {
                    if ($shop !== null) {
                        $shopModel = new Shop();
                        $shopModel
                            ->setId($shop->getId())
                            ->setName($shop->getName())
                            ->setLatitude($shop->getLatitude())
                            ->setLongitude($shop->getLongitude())
                            ->setAddress($shop->getAddress())
                            ->setManager($saveManager);

                        $this->shopManager->save($shopModel);
                    }
                }

                $response
                    ->setShops($shops)
                    ->setGlobalMessage('manager.save.message.success')
                    ->setManager($saveManager);
            } else {
                $response
                    ->setGlobalMessage('manager.save.message.error');
            }
        }

        $presenter->present($response);
    }
}