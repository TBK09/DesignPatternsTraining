<?php

namespace ECommerce\Coupon;

use ECommerce\Sale;
use Money\Money;

/**
 * Class CouponRestriction
 * @package ECommerce\Coupon
 */
abstract class CouponRestriction implements CouponInterface
{
    private $innerCoupon;

    public function __construct(CouponInterface $coupon)
    {
        $this->innerCoupon = $coupon;
    }

    public function getCode(): string
    {
        return $this->innerCoupon->getCode();
    }

    public function calculateDiscount(Sale $sale): Money
    {
        $this->checkEligibility($sale);

        return $this->innerCoupon->calculateDiscount($sale);
    }

    abstract protected function checkEligibility(Sale $sale);

    protected function createCouponException(string $message) : CouponException
    {
        return new CouponException($message);
    }
}