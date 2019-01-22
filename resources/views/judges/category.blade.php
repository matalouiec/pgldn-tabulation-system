@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $data['category']->name }}</h3>
                </div>
                @include('includes.messages')
                <div class="panel-body">
                    @if(count($data['contestants'])>0)
                        <div class="container-fluid">
                            @foreach ($data['contestants'] as $contestant)
                                <div class="row" style="margin-top:20px;">
                                    <div class="col-xs-6 col-md-4">
                                        <span class="badge" style="font-size:30px;">{{ $contestant->number }}</span> &nbsp;&nbsp;
                                        <img src="/storage/cover_image/{!! $contestant->cover_image !!}" class="img-fluid" width="200" height="150" alt="{!! $contestant->name !!}" />
                                    </div>
                                    <div class="col-xs-6 col-md-4">
                                        <b>Name :</b> {{ $contestant->name }}<br />
                                        <b>Representing :</b> {{ $contestant->representing }}<br />
                                        <b>Description :</b> <p>{!! $contestant->short_description !!}</p>
                                    </div>
                                    <div class="col-xs-6 col-md-4" id="actionBtn">
                                        <button id="btnRate" type="button" class="btn btn-danger" data-target="#RateWindow" data-toggle="modal" 
                                            data-uid="{{ Auth::user()->id }}"
                                            data-catid="{{ $data['category']->id }}" 
                                            data-cid="{{ $contestant->id }}" 
                                            data-cnumber="{{ $contestant->number }}" 
                                            data-cname="{{ $contestant->name }}" 
                                            data-crepresent="{{ $contestant->representing }}"
                                            data-image="/storage/cover_image/{!! $contestant->cover_image !!}">
                                                <span class="glyphicon glyphicon-pencil"></span>  &nbsp;Rate
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <center><small>No contestants found</small></center>
                    @endif
                </div>
                <div class="panel-footer">
                     <a href="{{ url('/judge-dashboard') }}" class="btn btn-primary" >Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="RateWindow" tabindex="-1" role="dialog" aria-labelledby="RateWindowLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        {!! Form::open(['action' => 'CriteriaController@store','method' => 'POST','name' => 'frmAddNew']) !!}
            <div class="modal-header">
                <span id="cidTitle"></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-3">
                                <img src="#" id="imageURL" class="img-fluid" width="200" height="150" style="margin-bottom:5px;"/>
                                Name: <span id="cnameTitle"></span><br />
                                Representing : <span id="crepresentTitle"></span>
                            </div>
                            <div class="col-md-9">
                                <div class="container-fluid" id="ratingWindow">
                                    <div class="row">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="300">Criteria</th>
                                                    <th class="text-center" width="300" colspan="2">Rating Score</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($data['criterias'])>0)
                                                    @foreach ($data['criterias'] as $criteria)
                                                        <tr>
                                                            <td width="300">{{ $criteria->criteria_name }} <span style="color:red;">({{$criteria->percentage}}%)</span></td>
                                                            <td width="230">
                                                                    <input type="range" min="0" max="{{ $criteria->percentage }}" id="{{ $criteria->id }}" name="{{ $criteria->id }}" value="0" class="slider">
                                                            </td>
                                                            <td>
                                                                    <input type="number" min="0" max="{{ $criteria->percentage }}" id="score{{ $criteria->id }}" name="txtScore[]" class="form-control" readonly/>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                        <tr>
                                                            <td align="right"><b>Total Score : </b></td>
                                                            <td colspan="2" id="lblTotalScore" style="font-size:20px;font-weight:bold;">0%</td>
                                                        </tr>
                                                @else 
                                                    <tr>
                                                        <td>No criteria found for this category</td>
                                                    </tr>
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Submit & Finalize</button>
                <button type="button" class="btn btn-info">Reset</button>            
                <button type="button" class="btn btn-primary" id="btnOK">OK</button>
            </div>
          {!! Form::close() !!}  
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection
@section('script')
    <script type="text/javascript">
        $(function(){
            var uid,cnumber,crepresent,cname,cid,catid,imageURL;
            
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //SLIDER
            $(".slider").on("input",(e) => {
                let lblTotalScore = $("#lblTotalScore");
                let id = e.currentTarget.id;
                let slider = document.getElementById(id);
                let output = document.getElementById("score"+id);

                slider.oninput = () => {
                    output.value = slider.value;
                    lblTotalScore.html(getTotalRating()+"%");
                }
            });
            //END SLIDER

            //RATE button actions
            $('#actionBtn button').click(function(){
                uid = $(this).attr('data-uid');
                cnumber = $(this).attr('data-cnumber');
                cname = $(this).attr('data-cname');
                crepresent = $(this).attr('data-crepresent');
                cid = $(this).attr('data-cid'); //contestant id
                catid = $(this).attr('data-catid'); //category id
                imageURL =  $(this).attr('data-image'); //image URL

                $("#cidTitle").html("<b>Contestant number : "+cnumber+"</b>");
                $("#cnameTitle").html("<b>"+cname+"</b>"); // Dynamic header title
                $("#crepresentTitle").html("<b>"+crepresent+"</b>");
                $("#imageURL").attr('src',imageURL);
            });
            //END rate button

            //OK button
            $("#btnOK").click(() => {
                let totalrating = getTotalRating();
                $.post('/judge-dashboard/rating',
                    { 
                        categoryid : catid,
                        contestantid : cid,
                        totalrating: totalrating
                    },
                    (data,status) => {
                        if(status == 'success')
                        {
                            $("input[name='txtScore[]']").each(function(){ //loop thru all textbox
                                var parentId = data.id;
                                var score = (($(this).val() == 0) ? 0:$(this).val());
                                var txtName = $(this).attr("id").split("score");
                                var criteria = txtName[1];
                                    $.post('/judge-dashboard/rating-entries',
                                            {
                                                parentid: parentId,
                                                categoryid: catid,
                                                criteriaid: criteria,
                                                contestantid: cid,
                                                acquired_rating: score
                                            },
                                            (data,status) => {
                                                if(status != 'success'){
                                                    console.log('error');
                                                    $.notify('Something went wrong on entry no. '+criteria,{ position:"right-bottom" },"warn");
                                                }
                                            },'json');
                            });
                        }
                        else
                        {
                            $.notify("Something went wrong.Please try again.",{ position:"right-bottom" },"warn");
                        }
                    },'json');
                $.notify('Your scores has been successfully saved.','success');
                $('#RateWindow').modal('hide');
            });
            //End OK

            //Get the total ratings given by judge
            getTotalRating = () => {
                let totalScore=0;
                $("input[name='txtScore[]']").each(function(e){
                    if($(this).val() > 0){
                        totalScore = totalScore + parseInt($(this).val());
                    }
                });
                return totalScore;
            }
            // End total ratings

        });

    </script>
@endsection

