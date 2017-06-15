<?php

namespace ECommerce\Coupon\Restriction;

use ECommerce\Coupon\CouponException;
use ECommerce\Coupon\CouponRestriction;
use ECommerce\Sale;
use Money\Money;
use ECommerce\Coupon\CouponInterface;

/**
 * Class TerritoryRestriction
 * @package ECommerce\Coupon\Restriction
 */
class TerritoryRestriction extends CouponRestriction
{
    private $territories;

    public function __construct(CouponInterface $coupon, array $territories)
    {
        if (!count($territories)) {
            throw new \InvalidArgumentException('At least one territory must be provided');
        }

        parent::__construct($coupon);
        $this->territories = $territories;
    }


    protected function checkEligibility(Sale $sale)
    {
        $deliveryAddress = $sale->getDeliveryAddress();

        if (!in_array($countryCode = $deliveryAddress->getCountryCode(), $this->territories)) {
            throw $this->createCouponException(sprintf(
                'Delivery country %s must be one of "%s"',
                $countryCode,
                implode(', ', $this->territories)
            ));
        }
    }

}