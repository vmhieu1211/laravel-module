@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}">Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::model($post, [
        'method' => 'PUT',
        'enctype' => 'multipart/form-data',
        'route' => ['posts.update', $post->id],
    ]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {!! Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Content:</strong>
                {!! Form::text('content', null, ['placeholder' => 'Content', 'class' => 'form-control']) !!}

            </div>
        </div>

        {{-- <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Images:</strong>
                {!! Form::file('images', ['class' => 'form-control', 'multiple' => true, 'id' => 'imageUpload']) !!}
            </div>
        </div> --}}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Images:</strong>
                <input id='imageUpload' type="file" name="images"
                    class="form-control"  multiple  value="{{ old('images', $post->images)}}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, [
                    'id' => 'status',
                    'class' => 'form-control',
                ]) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Publish Date:</strong>
                {{-- {!! Form::date('published_at', $post->publish, ['placeholder' => 'Publish Date', 'class' => 'form-control']) !!}
             --}}
             <input type="date" class="form-control" placeholder="Publish Date" name="published_at" value="{{ old('published_at', $post->published_at) }}">
            </div>
        </div>
        <div id="holder" style="margin-top:15px;max-height:100px;"></div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
    </form>
@endsection
