@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-edit"></i> Lista de Contratos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-success"
                                                       href="{{route('admin.contracts.create')}}">
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
                    <h3 class="card-title">Lista de contratos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="data-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Locador</th>
                            <th>Locatário</th>
                            <th>Negócio</th>
                            <th>Início</th>
                            <th>Vigência</th>
                            <th>Gerar PDF</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contracts as $contract)
                        <tr>
                            <td>{{$contract->ownerObject->name}}</td>
                            <td>{{$contract->acquirerObject->name}}</td>
                            <td>{{$contract->sale == true ? 'Venda' : 'Locação'}}</td>
                            <td>{{$contract->start_at}}</td>
                            <td>{{$contract->due_date}}/mêses</td>
                            <td class="text-center">
                                <a class="btn btn-warning" target="_blank" href="{{route('admin.contracts.pdf',['id'=>$contract->id])}}" ><i class="fa fa-file-pdf"></i></a>
                                <a class="btn btn-primary" href="{{route('admin.contracts.edit',['contract'=>$contract->id])}}" ><i class="fa fa-edit"></i></a>
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
@section('js')
    <script !src="">
        $(function () {

        })
    </script>
@endsection
