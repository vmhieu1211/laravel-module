@extends('layouts.frontend')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            @foreach ($posts as $key => $post)
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        {{ $post->title }}
                    </header>
                    <!-- Preview image figure-->
                    <img class="mb-4"><img class="img-fluid rounded" src="{{ $post->images }}"
                            style="max-width: 150px; margin-bottom: 10px;" class="img img-responsive" /></img>
                    <!-- Post content-->
                    <section class="mb-5">
                        {{ $post->content }}
                    </section>
                </article>
            @endforeach

        </div>

    </div>
@endsection
