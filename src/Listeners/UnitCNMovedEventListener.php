<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitCNMovedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitCNMovedEventListener
{
    protected $unitsCNPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unitsCNPath = config('foundation.models_namespace').'\UnitsCN';
    }

    /**
     * Handle the event.
     *
     * @param  UnitCNMovedEvent  $event
     * @return void
     */
    public function handle(UnitCNMovedEvent $event)
    {
        $unitData = $event->data['message']['entity'];

        $unitData = PublicConverter::transform('units_cn', $unitData);

        $unitsCNModel = new $this->unitsCNPath();

        $unitsCNModel = $unitsCNModel->findOrFail($unitData['id']);

        $unitsCNModel->fill($unitData);

        $unitsCNModel->save();

        if(isset($event->data['message']['childEntities']))
        {
            $childsUnitData = $event->data['message']['childEntities'];

            foreach ($childsUnitData as $childUnitData)
            {
                $childUnitData = PublicConverter::transform('units_cn', $childUnitData);

                $unitsCNModel = $unitsCNModel->findOrFail($childUnitData['id']);

                $unitsCNModel->fill($childUnitData);

                $unitsCNModel->save();
            }
        }
    }
}
