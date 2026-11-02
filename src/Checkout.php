<?php

namespace App;

class Checkout
{
    public function __construct(private Cart $cart)
    {
    }

    public function applyPromoCode(string $code): void
    {
        if ($code === 'SAVE10') {
            $this->cart->applyDiscount(10);
        }
    }

    public function applyLoyaltyDiscount(int $years): void
    {
        // 2% per year of membership, capped at 20%.
        $this->cart->applyDiscount(min($years * 0.02, 0.20));
    }
}
