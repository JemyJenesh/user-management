@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Settings') }}</div>

          <div class="card-body">

            @livewire('settings.edit', ['setting' => $settings[0]])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
