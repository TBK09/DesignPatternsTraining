<?php

namespace ECommerce;

use Money\Money;
use Math\Mass;

/**
 * Class Product
 */
class Product implements ProductInterface
{
    private $name;
    private $price;
    private $mass;

    public function __construct(string $name, Money $price, Mass $mass)
    {
        $this->name = $name;
        $this->price = $price;
        $this->mass = $mass;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }

    /**
     * @return Mass
     */
    public function getMass(): Mass
    {
        return $this->mass;
    }
}
