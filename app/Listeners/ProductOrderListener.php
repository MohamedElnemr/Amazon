<?php

namespace App\Listeners;

use App\Events\ProductOrderEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ProductOrderEvent $event)
    {
        $product = $event->product ;
        $product->qty -= 1;
        $product->save();
    }
}
