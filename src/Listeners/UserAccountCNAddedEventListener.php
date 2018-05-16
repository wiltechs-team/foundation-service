<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UserAccountCNAddedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UserAccountCNAddedEventListener
{
    protected $staffsCNPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->staffsCNPath = config('foundation.models_namespace').'\StaffsCN';
    }

    /**
     * Handle the event.
     *
     * @param  UserAccountCNAddedEvent  $event
     * @return void
     */
    public function handle(UserAccountCNAddedEvent $event)
    {
        $staffData = $event->data['message'];

        $staffData = PublicConverter::transform('staffs_cn', $staffData);

        $staffsCNModel = new $this->staffsCNPath();

        $staffsCNModel = $staffsCNModel->findOrFail($staffData['id']);

        $staffsCNModel->fill($staffData);

        $staffsCNModel->save();
    }
}
