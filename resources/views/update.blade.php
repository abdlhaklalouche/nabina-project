@extends('layouts.dashboard')

@section('dashboardContent')

<div class="container py-5">
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<form class="col-sm-8  mx-auto" action="{{ route('user_account_update', ['id' => $user->id]) }}" method="post">
    {{ csrf_field() }}
<div class="form-group row py-2">
    <label for="firstName" class="col-sm-2 col-form-label">FIRSTNAME</label>
    <div class="col-sm-10">
    <input class="form-control" id="firstName" type="text" name="first_name" placeholder="" value="{{ $user->first_name }}">
    <span class="text-danger">{{ $errors->first('first_name') ?? null }}</span>
    </div>
  </div>
  <div class="form-group row py-2">
    <label for="lastName" class="col-sm-2 col-form-label">LASTNAME</label>
    <div class="col-sm-10">
    <input class="form-control" id="lastName" type="text" name="last_name" placeholder="" value="{{ $user->last_name }}">
    <span class="text-danger">{{ $errors->first('last_name') ?? null }}</span>
    </div>
  </div>
  <div class="form-group row py-2">
    <label for="position" class="col-sm-2 col-form-label">POSITION</label>
    <div class="col-sm-10">
    <input class="form-control" id="position" type="text"  name="position" placeholder="Manager, Researcher..." value="{{ $user->position }}">
    <span class="text-danger">{{ $errors->first('position') ?? null }}</span>    
</div>
  </div>
  <div class="form-group row py-2">
    <label for="email" class="col-sm-2 col-form-label">EMAIL</label>
    <div class="col-sm-10">
    <input class="form-control" id="email" type="text"  name="email" placeholder="email@example.com" value="{{ $user->email }}">
    <span class="text-danger">{{ $errors->first('email') ?? null }}</span>  
    </div>
  </div>
  <div class="form-group row py-2">
    <label for="password" class="col-sm-2 col-form-label">PASSWORD</label>
    <div class="col-sm-10">
        
      <input type="password" class="form-control"  name="password" id="password" placeholder="Password">
      <span class="text-danger">{{ $errors->first('password') ?? null }}</span>
    </div>
  </div>
  <div class="form-group row py-2">
    <label for="role" class="col-sm-2 col-form-label">ROLE</label>
    <div class="col-sm-10">
    <select id="role" class="form-control"  name="role">
    <option>Select..</option>
    <option value="0" {{ $user->role == 0 ? "selected" : "" }}>Normal employee</option>
    <option value="1" {{ $user->role == 1 ? "selected" : "" }}>HR</option>
    <option value="2" {{ $user->role == 2 ? "selected" : "" }}>System Admin</option>
    </select>
    <span class="text-danger">{{ $errors->first('role') ?? null }}</span>  
    </div>
  </div>
  <div class="form-group row py-2">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10">
        <button type="submit" class="btn btn-secondary">Save</button>
    </div>
  </div>
</form>
</div>

@endsection