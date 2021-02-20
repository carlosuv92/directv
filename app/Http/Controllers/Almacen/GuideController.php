<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuideController extends Controller
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
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['technician', 'admin']);
        return view('almacen.guide.index');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $guide = new Guide();
            $guide->guide = $request->number_guide;
            $guide->amount = $request->cant_deco;
            $guide->date_reception = $request->date_reception;
            $guide->user_id = $request->person;
            $guide->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
