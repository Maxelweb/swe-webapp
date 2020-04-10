@extends('layouts.app')
@section('breadcrumbs', Breadcrumbs::render('users.index'))
@section('content')
    <div class="container-fluid">
            <div class="d-sm-flex mb-4">
                <h1 class="h3 mb-0 text-gray-800"> Gestione utenti</h1>
            </div>
        <div class="d-sm-flex mb-4 ml-sm-auto">
            <a href="{{route('dashboard.index')}}" class="btn btn-sm btn-danger btn-icon-split mr-4">
                        <span class="icon text-white-50">
                          <span class="fas fa-arrow-circle-left"></span>
                        </span>
                <span class="text">Torna indietro</span>
            </a>
            @canany(['isAdmin', 'isMod'])
            <a href="{{route('users.create')}}" class="btn btn-sm btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <span class="fas fa-user-plus"></span>
                    </span>
                <span class="text">Crea nuovo utente</span>
            </a>
            @endcanany
        </div>
        @error('createError')
        <p class="text-danger">{{$message}}</p>
        @enderror
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><span class="fas fa-users"></span> Lista utenti</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive-lg">
                    <table class="table border-secondary table-bordered table-striped dataTableUsers">
                        <thead class="thead-dark table-borderless">
                            <tr>
                                <th>ID</th>
                                <th>Nome e cognome</th>
                                <th>Stato</th>
                                <th>Email</th>
                                <th>Ruolo</th>
                                <th class="bg-secondary"> </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td><a href="{{route('users.show', ['userId' => $u->userId ])}}">{{$u->userId}}</a></td>
                                <td><a href="{{route('users.show', ['userId' => $u->userId ])}}">{{$u->name}} {{$u->surname}}</a></td>
                                <td>
                                    @if($u->deleted)
                                        <span class="badge badge-danger">Disattivo</span>
                                    @else
                                        <span class="badge badge-success">Attivo</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-info">{{$u->getRole()}}</span>
                                </td>
                                <td>{{$u->email}}</td>

                                <td class="text-center">
                                    @canany(['isAdmin', 'isMod'])
                                    @if($u->type < Auth::user()->type)
                                        <div class="d-sm-flex mb-4 ml-sm-auto">
                                            <a href="{{route('users.edit', $u->userId)}}" class="btn btn-sm btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                  <span class="fas fa-user-edit"></span>
                                                </span>
                                                <span class="text">Modifica</span>
                                            </a>
                                        </div>
                                    @endif
                                    @endcanany
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
