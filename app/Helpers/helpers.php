<?php

if (! function_exists('currency_lkr')) {
    function currency_lkr(float $amount, ?float $rate = null): string
    {
        if ($rate === null) {
            $rate = (float) env('CURRENCY_EXCHANGE_RATE', 360);
        }

        $lkrAmount = $amount * $rate;

        return 'Rs ' . number_format($lkrAmount, 2);
    }
}

if (! function_exists('public_storage_url')) {
    function public_storage_url(?string $path): ?string
    {
        if (empty($path)) {
            return null;
        }

        if (preg_match('/^https?:\/\//i', $path)) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (str_starts_with($path, 'storage/')) {
            $path = substr($path, strlen('storage/'));
        }

        return route('storage.local', ['path' => $path]);
    }
}
