<?php

namespace Specification;

/**
 * Interface SpecificationInterface
 */
interface SpecificationInterface
{
    public function isSatisfiedBy($candidate): bool;
}