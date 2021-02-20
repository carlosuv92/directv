<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiWarehouseController extends Controller
{
    public function getListGuide()
    {
        return DB::table('guides')
            ->join('users', 'guides.user_id', '=', 'users.id')
            ->select('guides.*',DB::raw('CONCAT(users.name, ", ", users.surname) AS name_user'))
            ->get();
    }
}
