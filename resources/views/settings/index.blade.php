@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Settings') }}</div>

          <div class="card-body">

            <form method="POST" action="{{ route('settings.update') }}">
              @csrf
              @method('PUT')
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="1"
                  {{ $settings[0]->value == 1 ? 'checked' : '' }}>
                <label class="custom-control-label" for="customSwitch1">Allow multiple user roles</label>
              </div>
              <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
