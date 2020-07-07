@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h2 class="text-center text-success">Corruption Vendor</h2>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card text-success border-0">
                <div class="card-header">
                    <h3 class="text-center">Rotation 1 - Active</h3>
                </div>
                <div class="card-body pb-2 pt-2 pl-1 pr-1">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <p class="pl-1">Start Date: 22-01-2020</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <p>End Date: 24-12-2020</p>
                        </div>
                        <div class="col-md-4">
                            <p class="float-right pr-1">Max Corruption: 125</p>
                        </div>
                    </div>
                    
                    <table class="table table-sm mb-0 text-success">
                        <thead>
                          <tr>
                            <th style="width: 40%">Item</th>
                            <th style="width: 33%">Echo Cost</th>
                            <th style="width: 33%" class="text-right">Corruption Cost</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($rotation->corruptions as $corruption)
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