<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\StaffUSAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class StaffUSAddedEventListener
{
    protected $staffsUSPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->staffsUSPath = config('foundation.models_namespace').'\StaffsUS';
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

        $staffsUSModel = new $this->staffsUSPath(PublicConverter::transform('staffs_us', $staffData));

        $staffsUSModel->save();
    }
}
