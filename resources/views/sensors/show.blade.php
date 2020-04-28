@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('sensors.show', $device->deviceId, $sensor->realSensorId))
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex mb-4">
        <h1 class="h4 mb-0 text-gray-800"> Sensore <span class="real-id">{{$sensor->realSensorId}}</span> del dispositivo <span class="logic-id">{{$sensor->device}}</span> </h1>
    </div>
    <div class="d-inline-block mt-2 mb-4 px-0">
        <a href="{{route('devices.show', $sensor->device)}}" class="btn btn-sm btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <span class="fas fa-arrow-circle-left"></span>
                </span>
            <span class="text">Torna indietro</span>
        </a>
    </div>

    @can(['isAdmin'])
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><span class="fas fa-microchip"></span> Lista enti*</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive-lg">
                <table class="table table-striped table-bordered border-secondary">
                    <thead class="thead-dark table-borderless">
                    <tr>
                        <th>Nome</th>
                        <th>Luogo</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--@foreach($entities as $entity)--}}
                        <tr>
                            <td>{{--$entity->name--}}Test</td>
                            <td>{{--$entity->location--}}test</td>

                            <td>{{--@if($entity->deleted===true)--}}
                                {{-- <span class="badge badge-danger">Eliminato</span>--}}
                             {{-- @else--}}
                                    <span class="badge badge-success">Attivo</span>
                                {{-- @endif--}}
                            </td>
                        </tr>
                    {{-- @endforeach--}}
                    </tbody>
                </table>
                <hr>
                <p class="my-2 small"><span class="fas fa-info-circle text-primary"></span>
                    *Lista degli enti che hanno la possibilità di visualizzare i dati di questo sensore.
                </p>
            </div>
        </div>
    </div>
    @endcan

    <div class="row">
         <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><span class="fas fa-chart-area"></span> Dato sensore real-time</h6>
                </div>
                <div class="card-body">
                    <single-chart
                        :sensor="{{json_encode($sensor)}}"
                        :frequency ="{{$device->frequency}}"
                        @canany(['isUser', 'isMod']) :alerts = "{{json_encode($alerts['enable'])}}" @endcanany
                    ></single-chart>
                </div>
            </div>
         </div>
    </div>
</div>
@endsection
