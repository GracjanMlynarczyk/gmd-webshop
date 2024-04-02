<?php

namespace GMDevelopment\ProductQueue\Model\Data;

use GMDevelopment\ProductQueue\Api\Data\PriceModelInterface;
use Magento\Framework\DataObject;

class PriceModel extends DataObject implements PriceModelInterface
{
    /**
     * Getter for Sku.
     *
     * @return string|null
     */
    public function getSku(): ?string
    {
        return $this->getData(self::SKU);
    }

    /**
     * Setter for Sku.
     *
     * @param string|null $sku
     *
     * @return void
     */
    public function setSku(?string $sku): void
    {
        $this->setData(self::SKU, $sku);
    }

    /**
     * Getter for Price.
     *
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->getData(self::PRICE) === null ? null
            : (float)$this->getData(self::PRICE);
    }

    /**
     * Setter for Price.
     *
     * @param float|null $price
     *
     * @return void
     */
    public function setPrice(?float $price): void
    {
        $this->setData(self::PRICE, $price);
    }

    /**
     * Getter for SpecialPrice.
     *
     * @return float|null
     */
    public function getSpecialPrice(): ?float
    {
        return $this->getData(self::SPECIAL_PRICE) === null ? null
            : (float)$this->getData(self::SPECIAL_PRICE);
    }

    /**
     * Setter for SpecialPrice.
     *
     * @param float|null $specialPrice
     *
     * @return void
     */
    public function setSpecialPrice(?float $specialPrice): void
    {
        $this->setData(self::SPECIAL_PRICE, $specialPrice);
    }
}
