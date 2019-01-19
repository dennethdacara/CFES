<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Model\SchoolYear;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function activeSY()
    {
        return SchoolYear::whereIsActive(true)->first();
    }

    public function activeSYID()
    {
        $sy = SchoolYear::whereIsActive(true)->first();
        return $sy->id;
    }

}
