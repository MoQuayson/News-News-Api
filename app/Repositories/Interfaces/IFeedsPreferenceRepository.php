<?php

namespace App\Repositories\Interfaces;

interface IFeedsPreferenceRepository{
    public function getPreferences($userId);
    public function createOrUpdatePreference($request);
}
