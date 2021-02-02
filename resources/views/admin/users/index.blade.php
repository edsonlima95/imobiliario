@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-3">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-list-alt"></i> Lista de Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-success" href="{{route('admin.users.create')}}">
                                <i class="fa fa-plus-circle mr-1"></i> <strong>Cadastrar</strong></a></li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @if($errors->all())
        @foreach($errors->all() as $error)
            <x-alert type="danger">
                {{$error}}
            </x-alert>
        @endforeach
    @endif

    @if(session()->exists('message'))
        <x-alert type="{{session()->get('color')}}">
            {{ session()->get('message') }}
        </x-alert>
    @endif
    <!-- /.content-header -->
    <div class="row">
        <!-- /.col -->
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Usuários</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="data-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Nome Completo</th>
                            <th>E-mail</th>
                            <th>Cpf</th>
                            <th>Nascimento</th>
                            <th>Editar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}
                                </td>
                                <td>{{$user->document}}</td>
                                <td>{{date('d/m/Y', strtotime($user->date_of_birth))}}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('admin.users.edit',['user'=>$user->id])}}" class="btn btn-primary mr-3"><i class="fa fa-pen"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
