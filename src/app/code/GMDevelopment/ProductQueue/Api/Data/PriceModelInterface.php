<?php

namespace GMDevelopment\ProductQueue\Api\Data;

interface PriceModelInterface
{
    /**
     * String constants for property names
     */
    public const SKU = "sku";
    public const PRICE = "price";
    public const SPECIAL_PRICE = "special_price";

    /**
     * Getter for Sku.
     *
     * @return string|null
     */
    public function getSku(): ?string;

    /**
     * Setter for Sku.
     *
     * @param string|null $sku
     *
     * @return void
     */
    public function setSku(?string $sku): void;

    /**
     * Getter for Price.
     *
     * @return float|null
     */
    public function getPrice(): ?float;

    /**
     * Setter for Price.
     *
     * @param float|null $price
     *
     * @return void
     */
    public function setPrice(?float $price): void;

    /**
     * Getter for SpecialPrice.
     *
     * @return float|null
     */
    public function getSpecialPrice(): ?float;

    /**
     * Setter for SpecialPrice.
     *
     * @param float|null $specialPrice
     *
     * @return void
     */
    public function setSpecialPrice(?float $specialPrice): void;
}
