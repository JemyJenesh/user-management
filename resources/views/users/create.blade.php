@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Create user') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
              @csrf
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
              </div>
              <fieldset class="form-group row">
                <legend class="col-form-label col-sm-2 float-sm-left pt-0">Roles</legend>
                <div class="col-sm-10">
                  @foreach ($roles as $role)
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="role" id="{{ $role->name }}"
                        value="{{ $role->id }}" {{ $role->name === 'User' ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $role->name }}">
                        {{ $role->name }}
                      </label>
                    </div>
                  @endforeach
              </fieldset>
              <button type="submit" class="btn btn-primary float-right">Create</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
