@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Slider - Create
                    </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'sliders.store']) !!}

                        <div class="form-group @if ($errors->has('Title')) has-error @endif">
                            {!! Form::label('Title') !!}
                            {!! Form::text('Title', null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => 'required']) !!}
                            @if ($errors->has('Title'))
                                <span class="help-block">{!! $errors->first('Title') !!}</span>
                            @endif
                        </div>

                        <div class="form-group @if ($errors->has('Title')) has-error @endif">
                            {!! Form::label('Description') !!}
                            {!! Form::text('Description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'required' => 'required']) !!}
                            @if ($errors->has('Description'))
                                <span class="help-block">{!! $errors->first('Description') !!}</span>
                            @endif
                        </div>

                        <div class="form-group @if ($errors->has('Title')) has-error @endif">
                            {!! Form::label('image') !!}
                            {!! Form::file('image', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('is_published'))
                                <span class="help-block">{!! $errors->first('is_published') !!}</span>
                            @endif
                        </div>

                        {!! Form::submit('Create', ['class' => 'btn btn-sm btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
