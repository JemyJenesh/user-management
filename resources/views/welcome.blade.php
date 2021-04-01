@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">{{ __('Laravel') }}</div>

          <div class="card-body">
            This app is powered by laravel, a php framework.
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">{{ __('User management') }}</div>

          <div class="card-body">
            This application can be used to manage users, their role(s) and permissions they have.
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">{{ __('Super admin credentials') }}</div>

          <div class="card-body">

            <h5><span class="badge bg-primary text-white">superadmin@quizy.com</span></h5>
            <h5><span class="badge bg-secondary text-white">password</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
