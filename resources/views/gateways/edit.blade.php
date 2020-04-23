@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('gateways.edit', $gateway->gatewayId))
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Modifica gateway</h1>
        </div>
        <div class="d-sm-inline-flex mb-4 ml-sm-auto">
            <a href="{{route('gateways.index')}}" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                          <span class="fas fa-arrow-circle-left"></span>
                        </span>
                <span class="text">Torna indietro</span>
            </a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                   <span class="icon text-blue-50">
                          <span class="fas fa-plus-circle"></span>
                   </span>
                    Modifica gateway
                </h6>
            </div>
            @can(['isAdmin'])
                <div id="cardGateway" class="card-body">
                    <p>Puoi modificare un gateway inserendo le informazioni elencate in seguito:</p>
                    <form method="POST" action="{{route('gateways.update', $gateway->gatewayId)}}" id="update">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="inputGatewayName" class="col-sm-4 col-form-label"><span class="fas fa-dungeon"></span> Nome gateway</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="inputGatewayName" placeholder="Nome del gateway" value="{{old('name')??$gateway->name}}" name="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                    </form>

                </div>
        </div>
        <div class="d-inline-block my-1">
            <button type="submit" id="addGateway" class="btn btn-success btn-icon-split" form="update">
                        <span class="icon text-white-50">
                          <span class="fas fa-save"></span>
                        </span>
                <span class="text">Salva</span>
            </button>
        </div>
        <div class="d-inline-block my-1 float-right">
            <a onclick="event.preventDefault(); document.getElementById('delete').submit();" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                      <span class="fas fa-trash"></span>
                                    </span>
                <span class="text">Elimina</span>
            </a>
            <form id="delete" action="{{ route('gateways.destroy', ['gatewayId' => $gateway->gatewayId]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
        @endcan
    </div>


@endsection
