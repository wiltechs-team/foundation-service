<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionCNAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionCNAddedEventListener
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
     * @param  PositionCNAddedEvent  $event
     * @return void
     */
    public function handle(PositionCNAddedEvent $event)
    {
        $positionData = $event->data['message'];

        $positionCNModel = new $this->positionsCNPath(PublicConverter::transform('positions_cn', $positionData));

        $positionCNModel->save();
    }
}
