@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Contestant - Edit</div>
                <div class="panel-body">
                    @include('includes.messages')
                    {!! Form::open(['action' => ['ContestantController@update',$contestant->id],'method' => 'PUT','enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::label('number','Sequence Number') }}
                            {{Form::text('number',$contestant->number,['class' => 'form-control','placeholder' => 'Sequence number'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('name','Name') }}
                            {{Form::text('name',$contestant->name,['class' => 'form-control','placeholder' => 'Contestants name'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('representing','Representing') }}
                            {{Form::text('representing',$contestant->representing,['class' => 'form-control','placeholder' => 'Representing'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('age','Age') }}
                            {{Form::text('age',$contestant->age,['class' => 'form-control','placeholder' => 'Current age'])}}
                        </div>
                        <div class="form-group">
                                {{Form::label('short_description','Description') }}
                                {{Form::textarea('short_description',$contestant->short_description,['id' => 'article-ckeditor','class' => 'form-control','placeholder' => 'Short description'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('cover_image','Image') }}
                            {{Form::file('cover_image')}}
                        </div>
                        <div class="form-group">
                                {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                                <a href="{{ url('/contestant') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'article-ckeditor' );
</script>
@endsection