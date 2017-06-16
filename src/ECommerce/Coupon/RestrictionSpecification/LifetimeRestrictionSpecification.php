<?php

namespace ECommerce\Coupon\RestrictionSpecification;

/**
 * Class LimitedLifetimeRestriction
 */
class LifetimeRestrictionSpecification extends AbstractRestrictionSpecification
{
    private $validFrom;

    private $validUntil;

    public function __construct(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo = null)
    {
        if ($dateTo && $dateTo < $dateFrom) {
            throw new \InvalidArgumentException('End date must be later than start date.');
        }

        $this->validFrom = $dateFrom;
        $this->validUntil = $dateTo;
    }

    public function isSatisfiedBy($sale): bool
    {
        $satisfied = true;

        $now = new \DateTimeImmutable('now');

        if ($now < $this->validFrom) {
            $this->addCause(sprintf(
                'Coupon must be redeemed from %s',
                $this->validFrom->format('Y-m-d H:i:s')
            ));

            $satisfied = false;
        }

        if ($this->validUntil && $this->validUntil < $now) {
            $this->addCause(sprintf(
                'Coupon has expired on %s.',
                $this->validUntil->format('Y-m-d H:i:s')
            ));

            $satisfied = false;
        }

        return $satisfied;
    }

}