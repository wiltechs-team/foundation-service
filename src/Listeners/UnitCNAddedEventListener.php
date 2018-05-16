<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitCNAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitCNAddedEventListener
{
    protected $unitsCNPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unitsCNPath = config('foundation.models_namespace').'\UnitsCN';
    }

    /**
     * Handle the event.
     *
     * @param  UnitCNAddedEvent  $event
     * @return void
     */
    public function handle(UnitCNAddedEvent $event)
    {
        $unitData = $event->data['message'];

        $unitsCNModel = new $this->unitsCNPath(PublicConverter::transform('units_cn', $unitData));

        $unitsCNModel->save();
    }
}
