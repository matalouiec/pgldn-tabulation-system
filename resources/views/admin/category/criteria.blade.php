@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Criteria - <b style="color:red;">{{ $data['category']->name }}</b></h2></div>
                <div class="panel-body">
                    @include('includes.messages')
                    <!-- Button trigger modal -->
                    <a href="{{ url('/category') }}" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
                    <button id="btnAddCriteria" type="button" class="btn btn-primary" data-target="#addCriteriaWindow" data-toggle="modal" data-categoryid="{{ $data['category']->id }}">
                        <span class="glyphicon glyphicon-plus"></span> Add New
                    </button>
                    <br />
                    @if(count($data['criterias'])>0)
                        <table class="table table-striped" id="criteriaTable">
                            <thead>
                                <tr>
                                    <th>Criteria Name</th>
                                    <th>Percentage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['criterias'] as $criteria)
                                    <tr>
                                        <td>{{ $criteria->criteria_name }}</td>
                                        <td style="color:red;font-weight:bold;">{{ $criteria->percentage }} %</td>
                                        <td>
                                            <a href="" title="Edit">
                                                <span class="material-icons">edit</span>
                                            </a>
                                            <a href="" title="Delete">
                                                    <span class="material-icons">delete</span>
                                                </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <center><small>No criteria found</small></center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCriteriaWindow" tabindex="-1" role="dialog" aria-labelledby="addCriteriaWindow">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        {!! Form::open(['action' => 'CriteriaController@store','method' => 'POST','name' => 'frmAddNew']) !!}
        <div class="modal-header">
            <span class="modal-title">New Criteria</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('criteria_name','Criteria Name') }}
                    {{ Form::text('criteria_name','',['class' => 'form-control','placeholder' => 'criteria name']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('subcategoryid','Sub Category') }}
                    {{ Form::select('subcategoryid',$data['subcategory'],null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                        {{ Form::label('percentage','Percentage') }}
                        {{ Form::number('percentage','',['class' => 'form-control','placeholder' => '0','id' => 'percentage','style' => 'font-weight:bold;font-size:20px;']) }}
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>
    <script type="text/javascript">

        var slider = document.getElementById('myRange');
        var output = document.getElementById('percentage');

        slider.oninput = () => {
            output.value = slider.value;
        }

        output.oninput = () => {
            slider.value = output.value;
        }

        $(document).ready(function(){
            //Initialize value of the percentage
            output.value = slider.value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Criteria Form Submission
            $("form").submit((event) => {
                event.preventDefault();
                
                var ruler = $('#myRange');
                var cname = $('#criteria_name');
                var percentage = $('#percentage');
                var subcategoryid = $('#subcategoryid');
                var categoryid = $("#btnAddCriteria").attr("data-categoryid");
                
                if(cname.val() == "" || percentage.val() == "" || percentage.val()==0){
                    $.notify("Hey! Some fields are missing. ",{ position:"right-bottom" },"warn");
                }else{
                    //Post data to db using Jquery post
                    $.post('/criteria',{
                        category_id: categoryid,
                        criteria_name: cname.val(),
                        percentage: percentage.val(),
                        subcategoryid: subcategoryid.val()
                    },function(data,status){
                        if(status == 'success'){
                            if(data.status){
                                //if everything else is good
                                $.notify(data.message,"success");
                                $('#addCriteriaWindow').modal('hide');
                                location.reload();
                            }else{
                                //if theres something wrong with the data
                                $.notify(data.message,{ position:"right-bottom" });
                                percentage.val(data.left);
                                ruler.val(data.left);
                                
                            }
                        }else{
                            $.notify("Something went wrong while submitting your request.");
                        }
                    },'json').fail(function(){
                        $.notify("Something went wrong while submitting your request.");
                    });
                    //end Post
                }
            });
            // End Criteria form submission

            $('#btnAddCriteria').click(function(){
                $('#addCriteriaWindow').modal('show');
            });

            // Criteria Table JSON
            var ctable = $('#criteriaTable').DataTable({
                paging : false,
                searching : false,
                info : false
            });
        });

    </script>
@endsection