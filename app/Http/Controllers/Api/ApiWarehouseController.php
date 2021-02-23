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
            ->select('guides.*', DB::raw('CONCAT(users.name, ", ", users.surname) AS name_user'))
            ->orderBy('guides.created_at', 'desc')
            ->paginate(15);
    }

    public function getListDecos(Request $request)
    {
        $search = $request->search;
        return DB::table('warehouses')
            ->join('guides', 'warehouses.guide_id', '=', 'guides.id')
            ->where(function ($q) use ($search) {
                if (strlen($search) > 0) {
                    $q->where('warehouses.imei', "=", $search)
                        ->orWhere('warehouses.card', "=", $search);
                }
            })
            ->where('warehouses.guide_id',$request->id_guide)
            ->select('warehouses.*', 'guides.guide')
            ->orderBy('warehouses.created_at', 'desc')
            ->paginate(15);
    }

    public function getAllListDecos(Request $request)
    {
        $search = $request->search;
        return DB::table('warehouses')
            ->join('guides', 'warehouses.guide_id', '=', 'guides.id')
            ->where(function ($q) use ($search) {
                if (strlen($search) > 0) {
                    $q->where('warehouses.imei', "=", $search)
                        ->orWhere('warehouses.card', "=", $search);
                }
            })
            ->where('warehouses.type_warehouse', 1)
            ->select('warehouses.*', 'guides.guide')
            ->orderBy('warehouses.created_at', 'desc')
            ->paginate(10);
    }
}
