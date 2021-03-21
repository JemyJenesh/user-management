@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Update role') }}</div>

          <div class="card-body">
            @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('permissions')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <form method="POST" action="{{ route('roles.update', $role) }}">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
              </div>
              <div class="form-row">
                @foreach ($permissions as $permission)
                  <div class="form-check col-3 form-check-inline mr-0">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                      id="permission-{{ $permission->id }}"
                      {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                      {{ $permission->name }}
                    </label>
                  </div>
                @endforeach
              </div>
              <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
