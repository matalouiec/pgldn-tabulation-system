@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    @include('includes.messages')
                    <a href="{{ url('/category/create') }}" class='btn btn-primary'><span class="glyphicon glyphicon-plus"></span> Add New</a><br /><br>
                    @if (count($categories)>0)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">is Active?</th>
                                <th scope="col">Percentage</th>
                                <th scope="col">Round</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->catname}}</th>
                                    <td>{!!$category->description!!}</td>
                                    <td>
                                        @if($category->is_active == 1)
                                            <small style='color:green;font-weight:bold;'>Active</small>
                                        @else
                                            <small style='color:red;font-weight:bold;'>Inactive</small>
                                        @endif
                                    </td>
                                    <td>{{ $category->percentage }}%</td>
                                    <td>{{ $category->levelname }}</td>
                                    <td>
                                        <a href="/category/{{$category->id}}" class="btn btn-success btn-sm" >Criteria</a>
                                        <a href="/category/{{$category->id}}/edit" class='btn btn-info btn-sm'>Edit</a>
                                        {!!Form::open(['action' => ['CategoryController@destroy',$category->id],'method' => 'POST','class' => 'btn btn-sm'])!!}
                                            {{Form::hidden('_method','DELETE')}}
                                            {{Form::submit('Delete',['class'=>'btn btn-danger btn-sm','onclick'=>'Confirm(Are you sure?)'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <center><small>No categories found</small></center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalCriteria" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="criteriaHeader">
                  <small id="subHeader"></small>
              </h4>
            </div>
            <div class="modal-body">
            <table class="table table-default">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <th><b>Rating</b></th>
                    </tr>
                </thead>
                <tbody id="criteria"></tbody>
            </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#modalCriteria').on("show.bs.modal", function (e){
                let categoryid = $(e.relatedTarget).data('id'); // id of the selected category
                let categoryname = $(e.relatedTarget).data('name');

                $('#criteriaHeader').html(categoryname);
                getCriteria(categoryid); // this will get all the criteria of a specific category
            });
        });

        function getCriteria(id){
            $.get("/category/"+id,function(data){
                if(data.length==0){
                    console.log('No criteria found.')
                }else{
                    var items = [];
                    $.each(data,function(key,val){
                        items.push("<tr>");
                        items.push("<td id="+ key +">"+ val.criteria_name +"</td><td>"+ val.percentage +" %</td>");                     
                        items.push("</tr>");
                    });
                    $("#criteria").html(items);
                    console.log(items);
                }
            },"json");
        }
    </script>
@endsection