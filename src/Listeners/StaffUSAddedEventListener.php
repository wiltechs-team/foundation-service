<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\StaffUSAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class StaffUSAddedEventListener
{
    protected $staffUSPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->staffUSPath = config('foundation.models_namespace').'\StaffUS';
    }

    /**
     * Handle the event.
     *
     * @param  StaffUSAddedEvent  $event
     * @return void
     */
    public function handle(StaffUSAddedEvent $event)
    {
        $staffData = $event->data['message'];

        $staffUSModel = new $this->staffUSPath(PublicConverter::transform('staffs_us', $staffData));

        $staffUSModel->save();
    }
}
