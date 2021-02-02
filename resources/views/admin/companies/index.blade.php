@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-list-alt"></i> Lista de Empresas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-success" href="{{route('admin.companies.create')}}">
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
<div class="row">
    <!-- /.col -->
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lista de Empresas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="data-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>CNPJ</th>
                            <th>IE</th>
                            <th>Responsável</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{$company->social_name}}</td>
                            <td>{{$company->alias_name}}
                            </td>
                            <td>{{$company->document_company}}</td>
                            <td> {{$company->document_company_secondary}}</td>
                            <td> {{$company->owner()->first()->name}}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{route('admin.companies.edit',['company'=>$company->id])}}" class="btn btn-primary mr-3"><i class="fa fa-pen"></i></a>
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
