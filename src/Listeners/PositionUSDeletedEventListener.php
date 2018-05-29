<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionUSDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionUSDeletedEventListener
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
     * @param  PositionUSDeletedEvent  $event
     * @return void
     */
    public function handle(PositionUSDeletedEvent $event)
    {
        $positionData = $event->data['message'];

        $positionData = PublicConverter::transform('positions_us', $positionData);

        $positionUSModel = new $this->positionUSPath();

        $positionUSModel::where('id', '=', $positionData['id'])->delete();
    }
}
