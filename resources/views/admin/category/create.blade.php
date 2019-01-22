@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category - Create</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('includes.messages')
                    {!! Form::open(['action' => 'CategoryController@store','method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('name','Name') }}
                            {{Form::text('name','',['class' => 'form-control','placeholder' => 'Category name'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('level','Level')}}
                            {{Form::select('level',$level,null,['class'=>'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('percentage','Percentage')}}
                            {{Form::text('percentage','',['class' => 'form-control','placeholder' => 'percentage'])}}
                        </div>
                        <div class="form-group">
                                {{Form::label('description','Description') }}
                                {{Form::textarea('description','',['id'=>'article-ckeditor','class' => 'form-control','placeholder' => 'Short description'])}}
                        </div>
                        <div class="form-group">
                                {{Form::label('is_active','Is Active?') }}
                                {{Form::checkbox('is_active',1,true)}}
                        </div>
                        <div class="form-group">
                                {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                                <a href="{{ url('/category') }}" class="btn btn-danger">Cancel</a>
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
