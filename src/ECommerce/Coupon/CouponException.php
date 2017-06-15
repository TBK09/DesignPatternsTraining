<?php

namespace ECommerce\Coupon;

/**
 * Class CouponException
 * @package ECommerce\Coupon
 */
class CouponException extends \DomainException
{
    private $couponCode;

    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}