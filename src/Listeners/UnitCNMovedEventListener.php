<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\UnitCNMovedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class UnitCNMovedEventListener
{
    protected $unitCNPath;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unitCNPath = config('foundation.models_namespace').'\UnitCN';
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

        $unitCNModel = new $this->unitCNPath();

        $unitCNModel = $unitCNModel->findOrFail($unitData['id']);

        $unitCNModel->fill($unitData);

        $unitCNModel->save();

        if(isset($event->data['message']['childEntities']))
        {
            $childsUnitData = $event->data['message']['childEntities'];

            foreach ($childsUnitData as $childUnitData)
            {
                $childUnitData = PublicConverter::transform('units_cn', $childUnitData);

                $unitCNModel = $unitCNModel->findOrFail($childUnitData['id']);

                $unitCNModel->fill($childUnitData);

                $unitCNModel->save();
            }
        }
    }
}
