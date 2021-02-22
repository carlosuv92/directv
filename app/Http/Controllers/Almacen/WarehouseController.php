<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use App\Models\Warehouse;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $modem = new Warehouse();
            $modem->guide_id = $request->number_guide;
            $modem->imei = $request->imei;
            $modem->card = $request->card;
            $modem->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
