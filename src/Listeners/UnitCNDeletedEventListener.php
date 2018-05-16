<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitCNDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitCNDeletedEventListener
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
     * @param  UnitCNDeletedEvent  $event
     * @return void
     */
    public function handle(UnitCNDeletedEvent $event)
    {
        $unitData = $event->data['message'];

        $unitData = PublicConverter::transform('units_cn', $unitData);

        $unitsCNModel = new $this->unitsCNPath();

        $unitsCNModel::where('id', '=', $unitData['id'])->delete();
    }
}
