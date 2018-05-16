<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\FoundationInitializationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class FoundationInitializationEventListener
{
    protected $staffsCNPath;

    protected $positionsCNPath;

    protected $unitsCNPath;

    protected $staffsUSPath;

    protected $positionsUSPath;

    protected $unitsUSPath;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->staffsCNPath = config('foundation.models_namespace').'\StaffsCN';

        $this->positionsCNPath = config('foundation.models_namespace').'\PositionsCN';

        $this->unitsCNPath = config('foundation.models_namespace').'\UnitsCN';

        $this->staffsUSPath = config('foundation.models_namespace').'\StaffsUS';

        $this->positionsUSPath = config('foundation.models_namespace').'\PositionsUS';

        $this->unitsUSPath = config('foundation.models_namespace').'\UnitsUS';
    }

    /**
     * Handle the event.
     *
     * @param  FoundationInitializationEvent  $event
     * @return void
     */
    public function handle(FoundationInitializationEvent $event)
    {
        $staffsCNModel = new $this->staffsCNPath();

        $positionsCNModel = new $this->positionsCNPath();

        $unitsCNModel = new $this->unitsCNPath();

        $staffsUSModel = new $this->staffsUSPath();

        $positionsUSModel = new $this->positionsUSPath();

        $unitsUSModel = new $this->unitsUSPath();

        $foundationData = $event->data['message'];

        $staffsCN = $foundationData['cnStaffs'];

        $positionsCN = $foundationData['cnPositions'];

        $unitsCN = $foundationData['cnUnits'];

        $staffsUS = $foundationData['usStaffs'];

        $positionsUS = $foundationData['usPositions'];

        $unitsUS = $foundationData['usUnits'];

        // CN清空Staff，插入Staff
        $staffsCNModel::truncate();
        foreach ($staffsCN as $staffCN)
        {
            $staffCNModel = new $this->staffsCNPath(PublicConverter::transform('staffs_cn', $staffCN));
            $staffCNModel->save();
        }

        // CN清空Units，插入Units
        $unitsCNModel::truncate();
        foreach ($unitsCN as $unitCN)
        {
            $unitCNModel = new $this->unitsCNPath(PublicConverter::transform('units_cn', $unitCN));
            $unitCNModel->save();
        }

        // CN清空Position，插入Position
        $positionsCNModel::truncate();
        foreach ($positionsCN as $positionCN)
        {
            $positionCNModel = new $this->positionsCNPath(PublicConverter::transform('positions_cn', $positionCN));
            $positionCNModel->save();
        }

        // US清空Staff，插入Staff
        $staffsUSModel::truncate();
        foreach ($staffsUS as $staffUS)
        {
            $staffUSModel = new $this->staffsUSPath(PublicConverter::transform('staffs_us', $staffUS));
            $staffUSModel->save();
        }

        // US清空Units，插入Units
        $unitsUSModel::truncate();
        foreach ($unitsUS as $unitUS)
        {
            $unitUSModel = new $this->unitsUSPath(PublicConverter::transform('units_us', $unitUS));
            $unitUSModel->save();
        }

        // US清空Position，插入Position
        $positionsUSModel::truncate();
        foreach ($positionsUS as $positionUS)
        {
            $positionUSModel = new $this->positionsUSPath(PublicConverter::transform('positions_us', $positionUS));
            $positionUSModel->save();
        }
    }
}
