<?php

namespace ECommerce\Coupon\RestrictionSpecification;

use Specification\AbstractSpecification;

/**
 * Class AbstractRestrictionSpecification
 * @package ECommerce\Coupon\Restriction
 */
abstract class AbstractRestrictionSpecification extends AbstractSpecification
{
    private $causes;

    protected function addCause(string $message)
    {
        $this->causes[] = $message;
    }
}