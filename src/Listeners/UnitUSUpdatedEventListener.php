<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitUSUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitUSUpdatedEventListener
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
     * @param  UnitUSUpdatedEvent  $event
     * @return void
     */
    public function handle(UnitUSUpdatedEvent $event)
    {
        $unitData = $event->data['message']['Entity'];

        $unitData = PublicConverter::transform('units_us', $unitData);

        $unitsUSModel = new $this->unitsUSPath();

        $unitsUSModel = $unitsUSModel->findOrFail($unitData['id']);

        $unitsUSModel->fill($unitData);

        $unitsUSModel->save();
    }
}
