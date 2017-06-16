<?php

namespace ECommerce\Coupon\RestrictionSpecification;

/**
 * Class TerritoryRestriction
 * @package ECommerce\Coupon\Restriction
 */
class TerritoryRestrictionSpecification extends AbstractRestrictionSpecification
{
    private $territories;

    public function __construct(array $territories)
    {
        if (!count($territories)) {
            throw new \InvalidArgumentException('At least one territory must be provided');
        }

        $this->territories = $territories;
    }

    public function isSatisfiedBy($sale): bool
    {
        $deliveryAddress = $sale->getDeliveryAddress();

        if (!in_array($countryCode = $deliveryAddress->getCountryCode(), $this->territories)) {
            $this->addCause(sprintf(
                'Delivery country %s must be one of "%s"',
                $countryCode,
                implode(', ', $this->territories)
            ));

            return false;
        }

        return true;
    }



}