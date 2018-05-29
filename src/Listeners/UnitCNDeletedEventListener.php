<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitCNDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitCNDeletedEventListener
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
     * @param  UnitCNDeletedEvent  $event
     * @return void
     */
    public function handle(UnitCNDeletedEvent $event)
    {
        $unitData = $event->data['message'];

        $unitData = PublicConverter::transform('units_cn', $unitData);

        $unitCNModel = new $this->unitCNPath();

        $unitCNModel::where('id', '=', $unitData['id'])->delete();
    }
}
