<?php

namespace Shopsys\ProductFeed\ZboziBundle;

use Shopsys\Plugin\PluginDataStorageProviderInterface;
use Shopsys\ProductFeed\DomainConfigInterface;
use Shopsys\ProductFeed\FeedConfigInterface;

class ZboziFeedConfig implements FeedConfigInterface
{
    /**
     * @var \Shopsys\Plugin\PluginDataStorageProviderInterface
     */
    private $pluginDataStorageProvider;

    public function __construct(
        PluginDataStorageProviderInterface $pluginDataStorageProvider
    ) {
        $this->pluginDataStorageProvider = $pluginDataStorageProvider;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return 'Zboží.cz';
    }

    /**
     * @return string
     */
    public function getFeedName()
    {
        return 'zbozi';
    }

    /**
     * @return string
     */
    public function getTemplateFilepath()
    {
        return '@ShopsysProductFeedZbozi/feed.xml.twig';
    }

    /**
     * @param \Shopsys\ProductFeed\StandardFeedItemInterface[] $items
     * @param \Shopsys\ProductFeed\DomainConfigInterface $domainConfig
     * @return \Shopsys\ProductFeed\StandardFeedItemInterface[]
     */
    public function processItems(array $items, DomainConfigInterface $domainConfig)
    {
        $domainId = $domainConfig->getId();
        $productsDataById = $this->getProductsDataById($items);

        foreach ($items as $key => $item) {
            $productData = $productsDataById[$item->getId()] ?? [];

            $showInFeed = $productData['show'][$domainId] ?? true;
            if (!$showInFeed) {
                unset($items[$key]);
                continue;
            }

            $item->setCustomValue('cpc', $productData['cpc'][$domainId] ?? null);
            $item->setCustomValue('cpc_search', $productData['cpc_search'][$domainId] ?? null);
        }

        return $items;
    }

    /**
     * @param array $items
     * @return array
     */
    private function getProductsDataById(array $items)
    {
        $productIds = [];
        foreach ($items as $item) {
            $productIds[] = $item->getId();
        }

        $productDataStorage = $this->pluginDataStorageProvider
            ->getDataStorage(ShopsysProductFeedZboziBundle::class, 'product');

        return $productDataStorage->getMultiple($productIds);
    }
}
