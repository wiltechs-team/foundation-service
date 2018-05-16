<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionUSUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionUSUpdatedEventListener
{
    protected $positionsUSPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->positionsUSPath = config('foundation.models_namespace').'\PositionsUS';
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

        $positionsUSModel = new $this->positionsUSPath();

        $positionsUSModel = $positionsUSModel->findOrFail($positionData['id']);

        $positionsUSModel->fill($positionData);

        $positionsUSModel->save();
    }
}
