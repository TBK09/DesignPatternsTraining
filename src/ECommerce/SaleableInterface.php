<?php

namespace ECommerce;

use Money\Money;

/**
 * Interface SaleableInterface
 * @package ECommerce
 */
interface SaleableInterface
{
    public function getPrice() : Money;
}
