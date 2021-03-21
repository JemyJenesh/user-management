@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('User') }}</div>

          <div class="card-body">
            <div class="mb-3">
              <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
            </div>
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Roles</th>
                  <th scope="col">Email Verified At</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($users as $user)
                  <tr>
                    <th scope="row">
                      {{ $loop->iteration + (request()->has('page') ? (request()->get('page') - 1) * 5 : 0) }}
                    </th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->getRoleNames()->implode('name', ', ') }}</td>
                    <td>{{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : 'Not verified' }}</td>
                    <td>
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                      <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                  </tr>
                @empty

                @endforelse
              </tbody>
            </table>
            <div class="d-flex justify-content-end">
              {{ $users->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
