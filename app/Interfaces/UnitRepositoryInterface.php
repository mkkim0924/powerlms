<?php

namespace App\Interfaces;

interface UnitRepositoryInterface
{
    public function getUnitDetail($id);

    public function getUnits($request);

    public function storeUnitData($request);

    public function updateUnit($request, $id);

    public function updateActiveStatus($request);

    public function removeAttachment($request);
}
