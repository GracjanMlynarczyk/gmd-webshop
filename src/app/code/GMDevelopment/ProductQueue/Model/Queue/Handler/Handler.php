<?php

declare(strict_types=1);

namespace GMDevelopment\ProductQueue\Model\Queue\Handler;

use Exception;
use GMDevelopment\ProductQueue\Api\Data\PriceModelInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\MessageQueue\PublisherInterface;
use Psr\Log\LoggerInterface;

class Handler
{
    private const TOPIC_NAME = 'product.price';

    /**
     * @param PublisherInterface $publisher
     * @param LoggerInterface $logger
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        private readonly PublisherInterface $publisher,
        private readonly LoggerInterface $logger,
        private readonly ProductRepositoryInterface $productRepository
    ) {
    }

    /**
     * @param PriceModelInterface $priceModel
     * @return void
     */
    public function execute(PriceModelInterface $priceModel): void
    {
        try {
            $product = $this->productRepository->get($priceModel->getSku());
            $product->setPrice($priceModel->getPrice());
            $product->setData('special_price', $priceModel->getSpecialPrice());

            $this->productRepository->save($product);
        } catch (Exception $e) {
            $this->logger->error(sprintf('Publisher executed with error: %s', $e->getMessage()), $priceModel->getData());
        }
    }

    /**
     * @param PriceModelInterface $priceModel
     * @return void
     */
    public function publish(PriceModelInterface $priceModel): void
    {
        $this->publisher->publish(self::TOPIC_NAME, $priceModel);
    }
}
