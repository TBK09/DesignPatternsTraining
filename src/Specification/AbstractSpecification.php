<?php

namespace Specification;

/**
 * Class AbstractSpecification
 * @package Specification
 */
abstract class AbstractSpecification implements SpecificationInterface
{
    public function andX(SpecificationInterface $other): self
    {
        return new AndSpecification($this, $other);
    }

    public function andNotX(SpecificationInterface $other): self
    {
        return $this->andX($this->notX($other));
    }

    public function orX(SpecificationInterface $other): self
    {
        return new OrSpecification($this, $other);
    }

    public function orNotX(SpecificationInterface $other): self
    {
        return $this->orX($this->notX($other));
    }

    public function notX(SpecificationInterface $other): self
    {
        return new NotSpecification($other);
    }

    public function not(): self
    {
        return $this->notX($this);
    }
}