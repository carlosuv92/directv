<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiWarehouseController extends Controller
{
    public function getListGuide(Request $request)
    {
        return DB::table('guides')
            ->join('users', 'guides.user_id', '=', 'users.id')
            ->where('guides.guide', 'like', '%' . $request->search . '%')
            ->select('guides.*',DB::raw('CONCAT(users.name, ", ", users.surname) AS name_user'))
            ->paginate(15);
    }

    public function getListModem(Request $request)
    {
        if(strlen($request->search)>0){
            return DB::table('warehouses')
                ->join('guides', 'warehouses.guide_id', '=', 'guides.id')
                ->where('warehouses.imei', "=", $request->search)
                ->orWhere('warehouses.card', "=", $request->search)
                ->select('warehouses.*','guides.guide')
                ->paginate(15);
        }else{
            return DB::table('warehouses')
                ->join('guides', 'warehouses.guide_id', '=', 'guides.id')
                ->select('warehouses.*','guides.guide')
                ->paginate(15);
        }
    }
}
