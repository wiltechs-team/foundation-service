<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitUSAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitUSAddedEventListener
{
    protected $unitsUSPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unitsUSPath = config('foundation.models_namespace').'\UnitsUS';
    }

    /**
     * Handle the event.
     *
     * @param  UnitUSAddedEvent  $event
     * @return void
     */
    public function handle(UnitUSAddedEvent $event)
    {
        $unitData = $event->data['message'];

        $unitsUSModel = new $this->unitsUSPath(PublicConverter::transform('units_us', $unitData));

        $unitsUSModel->save();
    }
}
