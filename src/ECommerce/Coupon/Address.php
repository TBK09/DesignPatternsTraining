<?php

namespace ECommerce\Coupon;

/**
 * Class Address
 * @package ECommerce\Coupon
 */
class Address
{
    private $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getCountryCode() : string
    {
        return $this->countryCode;
    }
}