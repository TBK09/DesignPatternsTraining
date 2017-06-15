<?php

namespace ECommerce\Coupon;

use Money\Money;
use ECommerce\Sale;

/**
 * Interface CouponInterface
 */
interface CouponInterface
{
    public function getCode(): string;

    /**
     * @throws CouponException When coupon is not eligible
     */
    public function calculateDiscount(Sale $sale): Money;
}