<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitUSAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitUSAddedEventListener
{
    protected $unitUSPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unitUSPath = config('foundation.models_namespace').'\UnitUS';
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

        $unitUSModel = new $this->unitUSPath(PublicConverter::transform('units_us', $unitData));

        $unitUSModel->save();
    }
}
