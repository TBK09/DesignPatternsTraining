<?php

namespace ECommerce\Coupon;

use ECommerce\Sale;
use Money\Money;

/**
 * Class RateCoupon
 * @package ECommerce\Coupon
 */
class RateCoupon implements CouponInterface
{
    private $code;

    private $rate;

    public function __construct(string $code, float $rate)
    {
        if ($rate <= 0  || $rate > 1) {
            Throw new \InvalidArgumentException('Invalid discount rate');
        }

        $this->code = $code;
        $this->rate = $rate;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function calculateDiscount(Sale $sale): Money
    {
        $totalAmount = $sale->getTotalAmount();

        return $totalAmount->multiply($this->rate);
    }

}