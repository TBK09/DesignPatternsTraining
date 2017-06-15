<?php

namespace ECommerce\Coupon;

use ECommerce\Sale;
use Money\Money;

/**
 * Class ValueCoupon
 * @package ECommerce\Coupon
 */
class ValueCoupon implements CouponInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var Money
     */
    private $discount;


    public function __construct(string $code, Money $discount)
    {
        if ($discount->lessThanOrEqual(new Money(0, $discount->getCurrency()))) {
            throw new \InvalidArgumentException('Discount value must be strictly greater than 0.');
        }

        $this->code = $code;
        $this->discount = $discount;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function calculateDiscount(Sale $sale): Money
    {
        return $this->discount;
    }

}