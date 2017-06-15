<?php

namespace ECommerce;

/**
 * Interface ProductInterface
 * @package ECommerce
 */
interface ProductInterface extends SaleableInterface, ShippableInterface
{
    public function getName(): string;
}