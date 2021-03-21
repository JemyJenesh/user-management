@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Update user') }}</div>

          <div class="card-body">
            @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('email')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('password')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <form method="POST" action="{{ route('users.update', $user) }}">
              @csrf
              @method('PUT')
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required
                    readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <fieldset class=" form-group row mt-3">
                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Roles</legend>
                <div class="col-sm-10">
                  @foreach ($roles as $role)
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="role" id="{{ $role->name }}"
                        value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $role->name }}">
                        {{ $role->name }}
                      </label>
                    </div>
                  @endforeach
              </fieldset>
              <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
