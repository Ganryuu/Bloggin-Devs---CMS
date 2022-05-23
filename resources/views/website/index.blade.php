@extends('website.template.master')

@section('content')
    <!-- Page Header -->
    <header class="masthead" style="background-image: url()">
        {{-- <div class="overlay"></div> --}}
        {{-- <div class="container"> --}}
        {{-- <div class="row"> --}}
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @php
                    $active = 'active';
                @endphp
                @foreach ($sliders as $slider)
                    <div class="carousel-item {{ $active }}">
                        <img class="d-block w-100" src="{{ asset($slider->image) }}" alt="First slide">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $slider->title }}</h5>
                            <p>{{ $slider->description }}</p>
                        </div>
                    </div>
                    @php
                        $active = '';
                    @endphp
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        {{-- <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Dev Blogger</h1>
                        <span class="subheading">A Blog post for Devs to express themselves</span>
                    </div>
                </div>
            </div>
        </div> --}}
    </header>

    <!-- EL content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                @foreach ($posts as $post)
                    <div class="post-preview">
                        <a href="{{ url('post/' . $post->slug) }}">
                            <h2 class="post-title">
                                {{ $post->title }}
                            </h2>
                            <h3 class="post-subtitle">
                                {{ $post->sub_title }}
                            </h3>
                        </a>
                        <p class="post-meta">Posted by
                            <a href="#">{{ $post->user->name }}</a>
                            on {{ date('M d, Y', strtotime($post->created_at)) }}
                            @if (count($post->categories) > 0)
                                <span class="post-category">
                                    Category :
                                    @foreach ($post->categories as $category)
                                        <a
                                            href="{{ url('category/' . $category->slug) }}">{{ $category->name . ',' }}</a>
                                    @endforeach
                                </span>
                            @endif
                        </p>
                    </div>
                    <hr>
                @endforeach
                <!-- Pager -->
                <div class="clearfix mt-4">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="category">
                    <h2 class="category-title">Category</h2>
                    <ul class="category-list">
                        @foreach ($categories as $category)
                            <li><a href="{{ url('category/' . $category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection()
