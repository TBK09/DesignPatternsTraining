<?php

namespace ECommerce;

use Math\Mass;

/**
 * Interface ShippableInterface
 * @package ECommerce
 */
interface ShippableInterface
{
    public function getMass() : Mass;
}
