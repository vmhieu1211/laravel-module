@extends('layouts.layout')

@section('content')
    @csrf
    <div class="post">
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

    <div class="post">
        <div class="col-xs-12 col-sm-12 col-md-12">
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
            <th>Author</th>
            <th>Status</th>
            <th>Publish Date</th>
            <th width="280px">Action</th>

        </tr>
        @foreach ($posts as $post)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>
                    <img src="{{ asset($post->images) }}" style="max-width: 150px; margin-bottom: 10px;"
                        class="img img-responsive" />
                </td>
                <td>
                    @if ($post->author)
                        <span>{{ $post->user->name }}</span>
                    @else
                        Null
                    @endif
                </td>
                <td>
                    @if ($post->status == 0)
                        InActive
                    @else
                        Active
                    @endif
                </td>
                <td>{{ $post->published_at }} </td>


                <td>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('posts.show', $post->id) }}">Show</a>
                        @can('post-edit')
                            <a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a>
                        @endcan

                        @can('post-delete')
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- {!! $posts->links() !!} --}}
@endsection
