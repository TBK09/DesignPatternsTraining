<?php

namespace ECommerce;

use Money\Money;
use ECommerce\Coupon\Address;

/**
 * Class Sale
 * @package ECommerce
 */
class Sale
{
    private $totalAmount;
    private $discount;
    private $deliveryAddress;

    public function __construct(Money $totalAmount, Address $deliveryAddress)
    {
        $this->totalAmount = $totalAmount;
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getTotalAmount() : Money
    {
        return $this->totalAmount;
    }

    public function discount(Money $discount)
    {
        if ($this->discount) {
            throw new \RuntimeException('Sale was already discounted');
        }

        $this->discount = $discount;
        $this->totalAmount = $this->totalAmount->subtract($discount);
    }

    public function getDiscount()
    {
        return $this->discount ?: new Money(0, $this->totalAmount->getCurrency());
    }

    public function getDeliveryAddress() : Address
    {
        return $this->deliveryAddress;
    }
}