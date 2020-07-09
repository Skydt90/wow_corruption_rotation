@extends('layouts.app')

@section('content')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let start = new Date("{{ $schedule->start_date }}");
            let end   = new Date("{{ $schedule->end_date }}");
            let rest  = {!! json_encode($schedules->toArray()) !!};
            
            for (i = 0; i < rest.length; i++) {
                document.getElementById('future-' + i).innerText = "Start Date: \r\n" + new Date(rest[i].start_date).toLocaleString(undefined, {timeStyle:"short", dateStyle:"medium"});;
                document.getElementById('future-end-' + i).innerText = "End Date: \r\n" + new Date(rest[i].end_date).toLocaleString(undefined, {timeStyle:"short", dateStyle:"medium"});;
            }
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
    <h2 class="text-center">Corruption Vendor</h2>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card main">
                <div class="card-header">
                    <h4 class="text-center">{{ $schedule->rotation->name }} - Active</h4>
                </div>
                <div class="card-body pb-2 pt-2 pl-1 pr-1">

                    <div class="row mt-n4">
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
    <br>
    <div class="row">
        @foreach($schedules as $index => $schedule)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" data-toggle="collapse" href="#col-{{ $index }}">
                        <h4 class="text-center">{{ $schedule->rotation->name }}</h4>
                    </div>
                    <div id="col-{{ $index }}" class="card-body pb-2 pt-2 pl-1 pr-1 collapse">

                        <div class="row mt-n4">
                            <div class="col-md-4">
                                <p id="future-{{ $index }}" class="pl-1"></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <p id="future-end-{{ $index }}"></p>
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
            <br><br><br>
        @endforeach
    </div>
</div>
@endsection
