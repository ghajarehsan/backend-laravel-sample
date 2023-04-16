<?php

namespace App\Observers;

use App\Models\ProductBrand;
use Illuminate\Support\Facades\Cache;

class ProductBrandObserver
{
    /**
     * Handle the ProductBrand "created" event.
     */
    public function created(ProductBrand $productBrand): void
    {
        Cache::forget('ProductBrand');
    }

    /**
     * Handle the ProductBrand "updated" event.
     */
    public function updated(ProductBrand $productBrand): void
    {
        Cache::forget('ProductBrand');
    }

    /**
     * Handle the ProductBrand "deleted" event.
     */
    public function deleted(ProductBrand $productBrand): void
    {
        Cache::forget('ProductBrand');
    }

    /**
     * Handle the ProductBrand "restored" event.
     */
    public function restored(ProductBrand $productBrand): void
    {
        Cache::forget('ProductBrand');
    }

    /**
     * Handle the ProductBrand "force deleted" event.
     */
    public function forceDeleted(ProductBrand $productBrand): void
    {
        Cache::forget('ProductBrand');
    }
}
