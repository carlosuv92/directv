@extends('layouts.principal')

@section('content')
    <div class="page-header">
        <div class="page-title">
            <h3>DASHBOARD</h3>
        </div>
    </div>
    <dashboard-index :totals="{{json_encode($totals)}}"></dashboard-index>
@endsection
