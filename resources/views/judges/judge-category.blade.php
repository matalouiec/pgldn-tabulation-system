@extends('layouts.app')
@section('content')
    <div class="container-fluid">
       <preliminary-round categoryid="{{ $category->id }}" categoryname="{{ $category->name }}" ></preliminary-round>
    </div>
@endsection