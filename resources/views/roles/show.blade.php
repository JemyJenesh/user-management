@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Role details') }}</div>
          <div class="card-body">
            <div class="mb-3">
              @can('edit roles')
                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">Edit</a>
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
                  <th>Role</th>
                  <th>{{ $role->name }}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Users</th>
                  <td>{{ $role->users()->count() }}</td>
                </tr>
                <tr>
                  <th>Permissions</th>
                  <td>{{ $role->getAllPermissions()->count() . '/' . $permissions->total() }}</td>
                </tr>
              </tbody>
            </table>
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Permissions</th>
                  <th>Access</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($permissions as $permission)
                  <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                      @if ($role->hasPermissionTo($permission->name))
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="text-success bi bi-check2" viewBox="0 0 16 16">
                          <path
                            d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                        </svg>
                      @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                          class="text-danger bi bi-x" viewBox="0 0 16 16">
                          <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <th>This role has no permission!</th>
                  </tr>
                @endforelse
              </tbody>
            </table>
            <div class="d-flex justify-content-end">
              {{ $permissions->links() }}
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
