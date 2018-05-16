<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\PositionCNDeletedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class PositionCNDeletedEventListener
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
     * @param  PositionCNDeletedEvent  $event
     * @return void
     */
    public function handle(PositionCNDeletedEvent $event)
    {
        $positionData = $event->data['message'];

        $positionData = PublicConverter::transform('positions_cn', $positionData);

        $positionsCNModel = new $this->positionsCNPath();

        $positionsCNModel::where('id', '=', $positionData['id'])->delete();
    }
}
