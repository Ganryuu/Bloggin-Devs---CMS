@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col mb-1">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('del-message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session('del-message') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Slider - List
                        <a href="{{ route('sliders.create') }}" class="btn btn-sm btn-primary float-right">Add New</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" width="60">No</th>
                                    {{-- <th scope="col" width="60">ID</th> --}}
                                    <th scope="col">Slider Title</th>
                                    <th scope="col">Slider Description</th>
                                    <th scope="col" width="200">Image</th>
                                    <th scope="col" width="130">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($sliders as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        {{-- <td>{{ $category->id }}</td> --}}
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td><img src="{{ asset($category->image) }}" style="max-width:100px;" alt=""
                                                srcset=""></td>
                                        <td>
                                            <a href="{{ route('sliders.edit', $category->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            {!! Form::open(['route' => ['sliders.destroy', $category->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
