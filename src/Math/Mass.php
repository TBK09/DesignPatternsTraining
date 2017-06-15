<?php

namespace Math;

/**
 * Class Mass
 */
final class Mass
{
    private $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Mass cannot be lower than 0.');
        }

        $this->value = $value;
    }

    public static function fromKilograms(float $value): self
    {
        return new self(round($value * 1000));
    }

    public function add(self $other)
    {
        return new self($this->value + $other->value);
    }

    public function getValue()
    {
        return $this->value;
    }
}