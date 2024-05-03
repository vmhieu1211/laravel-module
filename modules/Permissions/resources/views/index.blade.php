@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
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
                <th>Permission</th>
                <th>Role</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($permissions as $key => $permission)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        @foreach ($permission->roles as $role)
                            <span class="badge bg-dark">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{ route('permissions.show', $permission->id) }}">Show</a>
                        @can('permission-edit')
                            <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                        @endcan
                        @can('permission-delete')
                            <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}"
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
        {{-- {!! $permission->render() !!} --}}
    @endsection
