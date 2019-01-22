<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name','Sagayan Festival Ranking System') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <style>
        body{
            padding-top:0px;
        }
    </style>
    <script type="text/javascript">
        
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <center><h2>Paskuhan sa Lanao del Norte</h2></center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center style="font-weight:bold;font-size:18px;">INTER-LGU SAYAWIT COMPETITION</center>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <center>December 8,2018 7:00PM | Agora Terminal, Sagadan, Tubod, Lanao del Norte</center>
            </div>
        </div>
        <div class="row">
            @if(count($data['rank'])>0)
            <br />
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center" rowspan="2">Rank</th>
                        <th class="text-center" rowspan="2">Contingent</th>
                        <th class="text-center" colspan="4" style="background:rgba(64, 160, 255,0.5);">PERFORMANCE</th>
                        <th class="text-center" rowspan="2">TOTAL (100%)</th>
                    </tr>
                    <tr>
                        <th class="text-center">Voice Quality (40%)</th>
                        <th class="text-center">Choreography (30%)</th>
                        <th class="text-center">Costume/Props (20%)</th>
                        <th class="text-center">Overall Impact (10%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['rank'] as $rank)
                        <tr>
                            <th scope="row" class="text-center">{{ $rank->seqno }}</th>
                            <td>{{ $rank->Contestants }}</td>
                            <td class="text-center">{{ $rank->Voice_Quality }}</td>
                            <td class="text-center">{{ $rank->Choreography }}</td>
                            <td class="text-center">{{ $rank->Costume_Props }}</td>
                            <td class="text-center">{{ $rank->Overall_Impact }}</td>
                            <td class="text-center">{{ $rank->TOTAL }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <div class="row">
            <div class="col-md-3">
                <br /><br />
                <center>
                    <b>{{ $data['judge']->name }}</b>
                    <br />
                    <span style="text-decoration:overline;">
                        Judge's Signature over Printed Name
                    </span>
                </center>
            </div>
        </div>
    </div>
</body>
</html>