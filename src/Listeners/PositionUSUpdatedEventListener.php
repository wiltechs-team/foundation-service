<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionUSUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionUSUpdatedEventListener
{
    protected $positionUSPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->positionUSPath = config('foundation.models_namespace').'\PositionUS';
    }

    /**
     * Handle the event.
     *
     * @param  PositionUSUpdatedEvent  $event
     * @return void
     */
    public function handle(PositionUSUpdatedEvent $event)
    {
        $positionData = $event->data['message'];

        $positionData = PublicConverter::transform('positions_us', $positionData);

        $positionUSModel = new $this->positionUSPath();

        $positionUSModel = $positionUSModel->findOrFail($positionData['id']);

        $positionUSModel->fill($positionData);

        $positionUSModel->save();
    }
}
