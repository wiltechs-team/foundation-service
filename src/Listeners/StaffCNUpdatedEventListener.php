<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\StaffCNUpdatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;


class StaffCNUpdatedEventListener
{
    protected $staffCNPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->staffCNPath = config('foundation.models_namespace').'\StaffCN';
    }

    /**
     * Handle the event.
     *
     * @param  StaffCNUpdatedEvent  $event
     * @return void
     */
    public function handle(StaffCNUpdatedEvent $event)
    {
        $staffData = $event->data['message'];

        $staffData = PublicConverter::transform('staffs_cn', $staffData);

        $staffCNModel = new $this->staffCNPath();

        $staffCNModel = $staffCNModel->findOrFail($staffData['id']);

        $staffCNModel->fill($staffData);

        $staffCNModel->save();
    }
}
