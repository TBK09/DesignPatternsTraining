<?php

namespace ECommerce;

use Money\Money;
use Math\Mass;

/**
 * Class Bundle
 * @package ECommerce
 */
class Bundle implements ProductInterface
{
    private $name;

    private $price;

    /**
     * @var Product []
     */
    private $products;

    public function __construct($name, Money $price = null)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function add(ProductInterface $product)
    {
        $this->products[] = $product;
    }

    public function remove(Product $product)
    {

    }

    public function getMass() : Mass
    {
        $total = New Mass(0);
        foreach ($this->products as $product) {
            $total = $total->add($product->getMass());
        }

        return $total;
    }

    public function getPrice() : Money
    {
        if ($this->price) {
            return $this->price;
        }

        $max = count($this->products);
        $total = $this->products[0]->getPrice();
        for ($i = 1; $i < $max; $i++) {
            $total = $total->add($this->products[$i]->getPrice());
        }

        return $total;
    }

    public function getName(): string
    {
        return $this->name;
    }


}