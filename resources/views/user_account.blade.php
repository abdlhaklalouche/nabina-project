@extends('layouts.dashboard')

@section('dashboardContent')

<div class="p-5">
    <h4>User account</h4>
    <div class="row py-3">
        <div class="col-sm-6">Users</div>
        <div class="col-sm-6 text-end">
            <a href="{{ route('user_account_new') }}" class="btn btn-xs btn-secondary pull-right">+ New</a>
            <a href="{{ route('user_account') }}" class="btn btn-xs btn-secondary pull-right">Refresh</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td><strong class="text-primary">{{ $user->first_name }} {{ $user->last_name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role() }}</td>
                <td>
                    <a href="{{ route('user_account_update', ['id' => $user->id ]) }}">Update</a>
                     - 
                     <a href="{{ route('user_account_delete', ['id' => $user->id ]) }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection