<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitUSUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitUSUpdatedEventListener
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
     * @param  UnitUSUpdatedEvent  $event
     * @return void
     */
    public function handle(UnitUSUpdatedEvent $event)
    {
        $unitData = $event->data['message']['Entity'];

        $unitData = PublicConverter::transform('units_us', $unitData);

        $unitUSModel = new $this->unitUSPath();

        $unitUSModel = $unitUSModel->findOrFail($unitData['id']);

        $unitUSModel->fill($unitData);

        $unitUSModel->save();
    }
}
