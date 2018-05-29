<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\StaffCNAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class StaffCNAddedEventListener
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
     * @param  StaffCNAddedEvent  $event
     * @return void
     */
    public function handle(StaffCNAddedEvent $event)
    {
        $staffData = $event->data['message'];

        $staffCNModel = new $this->staffCNPath(PublicConverter::transform('staffs_cn', $staffData));

        $staffCNModel->save();
    }
}
