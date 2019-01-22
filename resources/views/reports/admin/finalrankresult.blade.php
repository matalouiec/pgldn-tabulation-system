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
            <div class="col-md-12">
                <br />
                <center style="font-weight:bold;font-size:18px;font-family: Arial, Helvetica, sans-serif;">Final Result</center>
            </div>
        </div>
        <div class="row">
            @if(count($data['rank'])>0)
            <br />
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Contingent</th>
                        <th class="text-center">Judge 1</th>
                        <th class="text-center">Judge 2</th>
                        <th class="text-center">Judge 3</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['rank'] as $rank)
                        <tr>
                            <td>{{ $rank->Contestants }}</td>
                            <td class="text-center">{{ $rank->Judge1 }}</td>
                            <td class="text-center">{{ $rank->Judge2 }}</td>
                            <td class="text-center">{{ $rank->Judge3 }}</td>
                            <td class="text-center">{{ $rank->T }}</td>
                            <th scope="row" class="text-center">{{ $rank->counter }}</th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
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
</body>
</html>