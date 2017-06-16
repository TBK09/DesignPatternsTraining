<?php

namespace Specification;

/**
 * Class NotSpecification
 * @package Specification
 */
final class NotSpecification extends AbstractSpecification
{
    private $specification;

    public function __construct(SpecificationInterface $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy($candidate): bool
    {
        return !$this->specification->isSatisfiedBy($candidate);
    }
}