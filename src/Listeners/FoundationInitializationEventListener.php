<?php

namespace wiltechsteam\FoundationService\Listeners;

use wiltechsteam\FoundationService\Events\FoundationInitializationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use wiltechsteam\FoundationService\Converter\PublicConverter;

class FoundationInitializationEventListener
{
    protected $staffCNPath;

    protected $positionCNPath;

    protected $unitCNPath;

    protected $staffUSPath;

    protected $positionUSPath;

    protected $unitUSPath;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->staffCNPath = config('foundation.models_namespace').'\StaffCN';

        $this->positionCNPath = config('foundation.models_namespace').'\PositionCN';

        $this->unitCNPath = config('foundation.models_namespace').'\UnitCN';

        $this->staffUSPath = config('foundation.models_namespace').'\StaffUS';

        $this->positionUSPath = config('foundation.models_namespace').'\PositionUS';

        $this->unitUSPath = config('foundation.models_namespace').'\UnitUS';
    }

    /**
     * Handle the event.
     *
     * @param  FoundationInitializationEvent  $event
     * @return void
     */
    public function handle(FoundationInitializationEvent $event)
    {
        $staffCNModel = new $this->staffCNPath();

        $positionCNModel = new $this->positionCNPath();

        $unitCNModel = new $this->unitCNPath();

        $staffUSModel = new $this->staffUSPath();

        $positionUSModel = new $this->positionUSPath();

        $unitUSModel = new $this->unitUSPath();

        $foundationData = $event->data['message'];

        $staffsCN = $foundationData['cnStaffs'];

        $positionsCN = $foundationData['cnPositions'];

        $unitsCN = $foundationData['cnUnits'];

        $staffsUS = $foundationData['usStaffs'];

        $positionsUS = $foundationData['usPositions'];

        $unitsUS = $foundationData['usUnits'];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // CN清空Staff，插入Staff
        $staffCNModel::truncate();
        foreach ($staffsCN as $staffCN)
        {
            $staffCNInfoModel = new $this->staffCNPath(PublicConverter::transform('staffs_cn', $staffCN));
            $staffCNInfoModel->save();
        }

        // CN清空Units，插入Units
        $unitCNModel::truncate();
        foreach ($unitsCN as $unitCN)
        {
            $unitCNInfoModel = new $this->unitCNPath(PublicConverter::transform('units_cn', $unitCN));
            $unitCNInfoModel->save();
        }

        // CN清空Position，插入Position
        $positionCNModel::truncate();
        foreach ($positionsCN as $positionCN)
        {
            $positionCNInfoModel = new $this->positionCNPath(PublicConverter::transform('positions_cn', $positionCN));
            $positionCNInfoModel->save();
        }

        // US清空Staff，插入Staff
        $staffUSModel::truncate();
        foreach ($staffsUS as $staffUS)
        {
            $staffUSInfoModel = new $this->staffUSPath(PublicConverter::transform('staffs_us', $staffUS));
            $staffUSInfoModel->save();
        }

        // US清空Units，插入Units
        $unitUSModel::truncate();
        foreach ($unitsUS as $unitUS)
        {
            $unitUSInfoModel = new $this->unitUSPath(PublicConverter::transform('units_us', $unitUS));
            $unitUSInfoModel->save();
        }

        // US清空Position，插入Position
        $positionUSModel::truncate();
        foreach ($positionsUS as $positionUS)
        {
            $positionUSInfoModel = new $this->positionUSPath(PublicConverter::transform('positions_us', $positionUS));
            $positionUSInfoModel->save();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
