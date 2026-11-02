<?php

namespace App;

class Cart
{
    /** @var array<int, array{price: float, qty: int}> */
    private array $lines = [];

    private float $discount = 0.0;

    public function add(float $price, int $qty = 1): void
    {
        $this->lines[] = ['price' => $price, 'qty' => $qty];
    }

    /**
     * Apply a discount given as a fraction (0.10 = 10% off).
     */
    public function applyDiscount(float $rate): void
    {
        if ($rate < 0 || $rate > 1) {
            throw new \InvalidArgumentException('Discount must be between 0 and 1.');
        }
        $this->discount = $rate;
    }

    public function total(): float
    {
        $subtotal = 0.0;
        foreach ($this->lines as $line) {
            $subtotal += $line['price'] * $line['qty'];
        }
        return round($subtotal * (1 - $this->discount), 2);
    }
}
