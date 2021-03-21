@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Update details') }}</div>
          <div class="card-body">
            <div class="mb-3">
              @can('edit users')
                <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Edit</a>
              @endcan
            </div>
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>{{ $user->name }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Email</th>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <th>Email verified at</th>
                  <td>{{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : 'Not verified' }}</td>
                </tr>
                <tr>
                  <th>Roles</th>
                  <td>{{ $user->getRoleNames()->implode('name', ', ') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
