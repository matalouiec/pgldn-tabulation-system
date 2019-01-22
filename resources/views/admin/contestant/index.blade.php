@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">List of Contestants</div>
                <div class="panel-body">
                    @include('includes.messages')
                    <a href="{{ url('/contestant/create') }}" class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span> Add New</a>
                    <br /><br />
                    @if (count($contestants)>0)
                        <table class="table table-striped table-bordered" align="center">
                            <thead>
                                <tr>
                                    <th scope="col" width="100px">Number</th>
                                    <th>Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Representing</th>
                                    <th scope="col">Short Description</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contestants as $contestant)
                                    <tr>
                                        <td><h2>{!! $contestant->number !!}</h2></td>
                                        <td style="width:200px;height:150px;">
                                            <img src="/storage/cover_image/{!! $contestant->cover_image !!}" class="img-fluid" width="200" height="150" alt="{!! $contestant->name !!}" />
                                        </td>
                                        <td>{!! $contestant->name !!}</td>
                                        <td>{!! $contestant->representing !!}</td>
                                        <td>{!! $contestant->short_description !!}</td>
                                        <td>
                                            <a href="/contestant/{{$contestant->id}}/edit" class='btn btn-info btn-sm'>Edit</a>
                                            {{--  {!!Form::open(['action' => ['CategoryController@destroy',$category->id],'method' => 'POST','class' => 'btn btn-sm'])!!}
                                                {{Form::hidden('_method','DELETE')}}
                                                {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm','onclick'=>'Confirm(Are you sure?)'])}}
                                            {!!Form::close()!!}  --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <center><small>No contestants found</small></center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
