<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionCNUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionCNUpdatedEventListener
{
    protected $positionsCNPath;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->positionsCNPath = config('foundation.models_namespace').'\PositionsCN';
    }

    /**
     * Handle the event.
     *
     * @param  PositionCNUpdatedEvent  $event
     * @return void
     */
    public function handle(PositionCNUpdatedEvent $event)
    {
        $positionData = $event->data['message'];

        $positionData = PublicConverter::transform('positions_cn', $positionData);

        $positionsCNModel = new $this->positionsCNPath();

        $positionsCNModel = $positionsCNModel->findOrFail($positionData['id']);

        $positionsCNModel->fill($positionData);

        $positionsCNModel->save();
    }
}
