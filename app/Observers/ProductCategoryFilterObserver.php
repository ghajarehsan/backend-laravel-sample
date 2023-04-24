<?php

namespace App\Observers;

use App\Models\ProductCategoryFilter;

class ProductCategoryFilterObserver
{
    /**
     * Handle the ProductCategoryFilter "created" event.
     */
    public function created(ProductCategoryFilter $productCategoryFilter): void
    {
        //
    }

    /**
     * Handle the ProductCategoryFilter "updated" event.
     */
    public function updated(ProductCategoryFilter $productCategoryFilter): void
    {
        //
    }

    /**
     * Handle the ProductCategoryFilter "deleted" event.
     */
    public function deleted(ProductCategoryFilter $productCategoryFilter): void
    {
        //
    }

    /**
     * Handle the ProductCategoryFilter "restored" event.
     */
    public function restored(ProductCategoryFilter $productCategoryFilter): void
    {
        //
    }

    /**
     * Handle the ProductCategoryFilter "force deleted" event.
     */
    public function forceDeleted(ProductCategoryFilter $productCategoryFilter): void
    {
        //
    }
}
