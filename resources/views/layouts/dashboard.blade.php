@extends('layouts.app')

@section('content')

<div class="d-flex flex-column" style="height: 100vh">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="d-flex bd-highlight container-fluid">
        <span class=" flex-grow-1 text-end mr-auto navbar-text">
            Welcome, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
        </span>
        </div>
    </nav>
    <div class="container-fluid flex-grow-1 row">
        <div class="col-sm-3 px-0 mx-0" style="background-color: #E9EAEC">
    
        <ul class="list-group list-group-flush">
        <li class="list-group-item text-center bg-transparent p-4">
            <h4>System admin dashboard</h4>
        </li>
        @if(auth()->user()->role == 2)
            <a href="{{ route('user_account') }}" class="list-group-item bg-transparent text-center list-group-item-action">User Account</a>
        @endif
        @if(auth()->user()->role == 2 || auth()->user()->role == 1)
            <a href="{{ route('hr') }}" class="list-group-item bg-transparent text-center list-group-item-action">Human Resources</a>
        @endif
        <a href="{{ route('employee') }}" class="list-group-item bg-transparent text-center list-group-item-action">Employee Profile</a>
        <a href="{{ route('logout') }}" class="list-group-item bg-transparent text-center list-group-item-action">Quite</a>
            </ul>
        </div>
        <div class="col-sm-9">
            <div class="row h-100 flex-column">
                @yield("dashboardContent")
            </div>
        </div>
    </div>
</div>


@endsection