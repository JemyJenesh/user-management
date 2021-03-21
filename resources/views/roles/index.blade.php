@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">{{ __('Roles') }}</div>

          <div class="card-body">
            <div class="mb-3">
              <a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
            </div>
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            @if (session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Users</th>
                  <th scope="col">Permissions ({{ $permissionsCount }})</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($roles as $role)
                  <tr>
                    <th scope="row">
                      {{ $loop->iteration }}
                    </th>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->users()->count() }}</td>
                    <td>{{ $role->getAllPermissions()->count() }}</td>
                    <td>
                      <a href="{{ route('roles.show', $role->id) }}" class="btn btn-success btn-sm">Show</a>
                      <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                      <form class="d-none" method="POST" action="{{ route('roles.destroy', $role) }}"
                        id="delete-role-{{ $role->id }}">
                        @csrf
                        @method('DELETE')
                      </form>
                      <button class="btn btn-danger btn-sm" onclick="deleteRole({{ $role }})">Delete</button>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td align="center" colspan="6">No role found!</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    function deleteRole(role) {
      window.swal({
          title: "Delete role?",
          text: `Are you sure you want to remove ${role.name} from roles?`,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            document.querySelector(`#delete-role-${role.id}`).submit();
          }
        });
    }

  </script>
@endpush
