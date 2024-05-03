    @extends('layouts.layout')
    @section('content')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2></h2>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Role</th>
                <th>Permission</th>
                <th width="280px">Action</th>

            </tr>

            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        @if (!empty($role->permissions))
                            @foreach ($role->permissions as $permission)
                                <label class="label label-success">{{ $permission->name }},</label>
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                        @can('role-edit')
                            <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                        @endcan
                        @can('role-delete')
                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
        {!! $roles->render() !!}
    @endsection
