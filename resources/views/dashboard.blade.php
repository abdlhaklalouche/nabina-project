@extends('layouts.dashboard')

@section('dashboardContent')

<div class="p-5 text-center">
    <h4>Welcome, {{ auth()->user()->first_name }}</h4>
    <h5>{{ auth()->user()->position }} <small>({{ auth()->user()->role() }})</small></h5>
</div>

@endsection