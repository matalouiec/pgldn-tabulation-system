@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center><h2>{{ config('app.name') }}</h2></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center style="font-weight:bold;font-size:18px;">INTER-LGU BEAUTY PAGEANT</center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>July 2, 2019  8:00PM | MCC Gymnasium, Sagadan, Tubod, Lanao del Norte</center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center style="font-weight:bold;font-size:18px;font-family: Arial, Helvetica, sans-serif;">Preliminary Interview</center>
                <br />
            </div>
        </div>
        <div class="row">
            <br />
            <per-category-report vwname="vw_interview"></per-category-report>
        </div>
        <div class="row">
            <div class="col-md-4">
                <br />
                <b>Judge's Name and Signature</b>
                <ol>
                    @foreach($data['judges'] as $judge)
                        <li style="margin:10px 1px 0px 2px;">{{ $judge->name }}  ______________________</li>
                    @endforeach
                </ol>
            </div>
            <div class="col-md-4">
                <br />
                <b>Chairman</b><br/><br />
                ______________________________________
                <br />
                {{ $data['chairman']->name }}
            </div>
            <div class="col-md-4">
                <br />
                <b>Tabulator</b>
                <br><br>
                ______________________________________
            </div>
        </div>
    </div>
@endsection