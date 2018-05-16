<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\StaffUSUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class StaffUSUpdatedEventListener
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
     * @param  StaffUSUpdatedEvent  $event
     * @return void
     */
    public function handle(StaffUSUpdatedEvent $event)
    {
        $staffData = $event->data['message'];

        $staffData = PublicConverter::transform('staffs_us', $staffData);

        $staffsUSModel = new $this->staffsUSPath();

        $staffsUSModel = $staffsUSModel->findOrFail($staffData['id']);

        $staffsUSModel->fill($staffData);

        $staffsUSModel->save();
    }
}
