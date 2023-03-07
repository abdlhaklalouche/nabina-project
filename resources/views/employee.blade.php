@extends('layouts.dashboard')

@section('dashboardContent')

<dl class="row p-5">
    <dt class="col-sm-3">First name</dt>
    <dd class="col-sm-9">{{ auth()->user()->first_name }}</dd>

    <dt class="col-sm-3">Last name</dt>
    <dd class="col-sm-9">{{ auth()->user()->last_name }}</dd>

    <dt class="col-sm-3 text-truncate">Position</dt>
    <dd class="col-sm-9">{{ auth()->user()->position }}</dd>

    <dt class="col-sm-3 text-truncate">Status</dt>
    <dd class="col-sm-9">{{ auth()->user()->role() }}</dd>
</dl>

@endsection