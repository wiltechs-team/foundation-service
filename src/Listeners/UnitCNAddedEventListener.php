<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitCNAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitCNAddedEventListener
{
    protected $unitCNPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unitCNPath = config('foundation.models_namespace').'\UnitCN';
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

        $unitCNModel = new $this->unitCNPath(PublicConverter::transform('units_cn', $unitData));

        $unitCNModel->save();
    }
}
