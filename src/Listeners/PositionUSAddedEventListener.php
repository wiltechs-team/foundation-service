<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionUSAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionUSAddedEventListener
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
     * @param  PositionUSAddedEvent  $event
     * @return void
     */
    public function handle(PositionUSAddedEvent $event)
    {
        $positionData = $event->data['message'];

        $positionUSModel = new $this->positionUSPath(PublicConverter::transform('positions_us', $positionData));

        $positionUSModel->save();
    }
}
