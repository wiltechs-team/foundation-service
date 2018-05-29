<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\StaffUSUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class StaffUSUpdatedEventListener
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
     * @param  StaffUSUpdatedEvent  $event
     * @return void
     */
    public function handle(StaffUSUpdatedEvent $event)
    {
        $staffData = $event->data['message'];

        $staffData = PublicConverter::transform('staffs_us', $staffData);

        $staffUSModel = new $this->staffUSPath();

        $staffUSModel = $staffUSModel->findOrFail($staffData['id']);

        $staffUSModel->fill($staffData);

        $staffUSModel->save();
    }
}
