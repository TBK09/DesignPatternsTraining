<?php

namespace ECommerce\Coupon\Restriction;

use ECommerce\Coupon\CouponRestriction;
use ECommerce\Sale;
use ECommerce\Coupon\CouponInterface;
use ECommerce\Coupon\CouponException;
use Money\Money;

/**
 * Class LimitedLifetimeRestriction
 */
class LimitedLifetimeRestriction extends CouponRestriction
{
    private $coupon;

    private $validFrom;

    private $validUntil;

    public function __construct(CouponInterface $coupon, \DateTimeInterface $dateFrom, \DateTimeInterface $dateTo = null)
    {
        if ($dateTo && $dateTo < $dateFrom) {
            throw new \InvalidArgumentException('End date must be later than start date.');
        }

        parent::__construct($coupon);

        $this->validFrom = $dateFrom;
        $this->validUntil = $dateTo;
        $this->coupon = $coupon;
    }

    protected function checkEligibility(Sale $sale)
    {
        $now = new \DateTimeImmutable('now');

        if ($now < $this->validFrom) {
            throw $this->createCouponException(sprintf(
                'Coupon must be redeemed from %s',
                $this->validFrom->format('Y-m-d H:i:s')
            ));
        }

        if ($this->validUntil && $this->validUntil < $now) {
            throw $this->createCouponException(sprintf(
                'Coupon has expired on %s.',
                $this->validUntil->format('Y-m-d H:i:s')
            ));
        }
    }

}