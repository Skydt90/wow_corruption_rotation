@extends('layouts.app')

@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let start = new Date("{{ $start }}");
            let end = new Date("{{ $end }}");
            document.getElementById('a-start').innerText = "Start Date: \r\n" + start.toLocaleString(undefined, {timeStyle:"short", dateStyle:"medium"});
            document.getElementById('a-end').innerText = "End Date: \r\n" + end.toLocaleString(undefined, {timeStyle:"short", dateStyle:"medium"});
        });
    </script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-2">
            <img id="logo" src="{{asset('storage/images/logo.png')}}" class="text-center" alt="">
        </div>
        <div class="col-md-5"></div>
    </div>
    <br>
    <h1 class="text-center">Corruption Vendor</h1>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">{{ $schedule->rotation->name }} - Active</h3>
                </div>
                <div class="card-body pb-2 pt-2 pl-1 pr-1">

                    <div class="row">
                        <div class="col-md-4">
                            <p id="a-start" class="pl-1"></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <p id="a-end"></p>
                        </div>
                        <div class="col-md-4">
                            <p class="float-right text-right pr-1">Max Corruption:<br>{{ $schedule->max_corruption }}</p>
                        </div>
                    </div>

                    <table class="table table-sm mb-0">
                        <thead>
                          <tr>
                            <th style="width: 45%">Item</th>
                            <th style="width: 33%">Echo Cost</th>
                            <th style="width: 33%" class="text-right">Corruption Cost</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedule->rotation->corruptions as $corruption)
                            <tr>
                                <td>
                                    <a href="{{ $corruption->wowhead_link }}" target="_blank">
                                        <img src="{{ $corruption->picture->getUrl() }}" alt="picture of {{ $corruption->name }}"> {{ $corruption->name }}
                                    </a>
                                </td>
                                <td><img src="{{ $corruption->picture->getEchoUrl() }}" alt=""> {{ $corruption->echo_cost }}</td>
                                <td class="text-right"><img src="{{ $corruption->picture->getCorrUrl() }}" alt=""> {{ $corruption->corr_cost }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br><br>
    <div class="row text-success"></div>

</div>

@endsection
