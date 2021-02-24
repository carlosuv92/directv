<?php

namespace App\Http\Controllers\Almacen;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
        $totals['general'] = Warehouse::count();
        $totals['almacen'] = Warehouse::whereTypeWarehouse(1)->count();
        $totals['campo'] = Warehouse::whereTypeWarehouse(2)->count();
        return view('almacen.dashboard.index',[
            'totals' => $totals
        ]);
    }
}
