<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Warehouse;
use App\Models\WarehouseTechnician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id)
    {
        $request->user()->authorizeRoles(['technician', 'admin']);
        return view('almacen.warehouse.insert',[
            'guide' => Guide::find($id)
        ]);
    }

    public function give(Request $request)
    {
        $request->user()->authorizeRoles(['technician', 'admin']);
        return view('almacen.warehouse.give');
    }

    public function list(Request $request)
    {
        $request->user()->authorizeRoles(['technician', 'admin']);
        return view('almacen.warehouse.list');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $deco = new Warehouse();
            $deco->guide_id = $request->number_guide;
            $deco->imei = $request->imei;
            $deco->card = $request->card;
            $deco->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    public function storeDecos(Request $request)
    {
        $guide_out = '';
        DB::beginTransaction();
        try {
            $check_list = json_decode($request->decos);
            $guide_out = $this->generateBarcodeNumber();
            foreach ($check_list as $list) {
                $deco_tech = new WarehouseTechnician();
                $deco_tech->warehouse_id = $list->id;
                $deco_tech->received = $request->person;
                $deco_tech->send_by = Auth::id();
                $deco_tech->save();

                $deco_up = Warehouse::whereId($list->id)->first();
                $deco_up->type_warehouse = 2;
                $deco_up->guide_out = $guide_out;
                $deco_up->save();
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
        return ['guide_out' => $guide_out];
    }
    function generateBarcodeNumber() {
        $number = mt_rand(1000000000, 9999999999);
        if ($this->barcodeNumberExists($number)) {
            return generateBarcodeNumber();
        }
        return $number;
    }

    function barcodeNumberExists($number) {
        return Warehouse::whereGuideOut($number)->exists();
    }
}
