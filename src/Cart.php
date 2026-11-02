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
     * Apply a discount given as a percentage (10 = 10% off).
     */
    public function applyDiscount(float $percent): void
    {
        if ($percent < 0 || $percent > 100) {
            throw new \InvalidArgumentException('Discount must be between 0 and 100.');
        }
        $this->discount = $percent / 100;
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
