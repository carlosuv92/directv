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
            ->where('warehouses.guide_id', $request->id_guide)
            ->select('warehouses.*', 'guides.guide')
            ->orderBy('warehouses.created_at', 'desc')
            ->paginate(15);
    }

    public function getWarehouseListDecos(Request $request)
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

    public function getAllListDecos(Request $request)
    {
        $search = $request->search;
        $status_a = DB::table('warehouse_technicians')
            ->select('warehouse_technicians.*')
            ->where('type_status', 1);
        return DB::table('warehouses')
            ->join('guides', 'warehouses.guide_id', '=', 'guides.id')
            ->leftJoinSub($status_a, 'warehouse_technicians', function ($join) {
                $join->on('warehouses.id', '=', 'warehouse_technicians.warehouse_id');
            })
            ->leftJoin('users as r', 'r.id', '=', 'warehouse_technicians.received')
            ->where(function ($q) use ($search) {
                if (strlen($search) > 0) {
                    $q->where('warehouses.imei', "=", $search)
                        ->orWhere('warehouses.card', "=", $search);
                }
            })
            //->where('warehouse_technicians.type_status',1)
            ->select(
                'warehouses.*',
                'guides.guide',
                DB::raw('CONCAT(r.name, ", ", r.surname) AS r_name')
            )
            ->orderBy('warehouses.created_at', 'desc')
            ->paginate(10);
    }

    public function getDataPrint(Request $request)
    {
        $status_a = DB::table('warehouse_technicians')
            ->select('warehouse_technicians.*')
            ->where('type_status', 1);
        return DB::table('warehouses')
            ->leftJoinSub($status_a, 'warehouse_technicians', function ($join) {
                $join->on('warehouses.id', '=', 'warehouse_technicians.warehouse_id');
            })
            ->join('guides', 'warehouses.guide_id', '=', 'guides.id')
            ->join('users as r', 'r.id', '=', 'warehouse_technicians.received')
            ->join('users as s', 's.id', '=', 'warehouse_technicians.send_by')
            ->where('warehouses.guide_out', $request->guide_out)
            ->select(
                'warehouses.imei',
                'warehouses.card',
                'guides.guide',
                'warehouses.updated_at as date_s',
                'warehouses.guide_out',
                DB::raw('CONCAT(r.name, ", ", r.surname) AS r_name'),
                DB::raw('CONCAT(s.name, ", ", s.surname) AS s_name')
            )
            ->orderBy('warehouses.created_at', 'desc')
            ->get();
    }
}
