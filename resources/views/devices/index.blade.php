@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>I tuoi dispositivi</h1>
        <div class="d-flex">
            @foreach($devices as $device)
                <div class="col-3-auto p-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>{{$device->nome}}</h2>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Sensori disponibilii</h5>
                            <p class="card-text">
                                @foreach($device->sensori as $sensore)
                                    {{$sensore['nome']}}<br>
                                @endforeach
                            </p>
                            <a href="/user/{{ $user->id.'/devices/'.$device->nome}}" class="btn btn-primary">Vai al dipositivo</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
