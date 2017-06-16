<?php

namespace Specification;

/**
 * Class AndSpecification
 * @package Specification
 */
final class AndSpecification extends AbstractSpecification
{
    private $one;
    private $two;

    public function __construct(SpecificationInterface $one, SpecificationInterface $two)
    {
        $this->one = $one;
        $this->two = $two;
    }

    public function isSatisfiedBy($candidate): bool
    {
        return $this->one->isSatisfiedBy($candidate)
            && $this->two->isSatisfiedBy($candidate)
        ;
    }
}