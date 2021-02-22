@extends('layouts.principal')

@section('content')

    <insert-warehouse :guide="{{json_encode($guide)}}"></insert-warehouse>
@endsection
