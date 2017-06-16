<?php

namespace Specification;

/**
 * Class OrSpecification
 * @package Specification
 */
final class OrSpecification extends AbstractSpecification
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
        return $this->one->isSatisfiedBy($candidate) || $this->two->isSatisfiedBy($candidate);
    }
}