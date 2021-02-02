@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-home"></i> Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.index')}}">Clientes</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.properties.index')}}">Imóveis</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.companies.index')}}">Empresas</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.contracts.index')}}">Contratos</a></li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Clientes</h3>

                    <p><strong>Locadores: {{$lessors}}</strong></p>
                    <p><strong>Locatários: {{$lessees}}</strong></p>
                    <p><strong>Admins: {{$admins}}</strong></p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Imóveis</h3>

                    <p><strong>Disponíveis: {{$available}}</strong></p>
                    <p><strong>Locados: {{$unavailable}}</strong></p>
                    <p><strong>Total: {{$contractAll}} </strong></p>

                </div>
                <div class="icon">
                    <i class="ion ion-home"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Contratos</h3>

                    <p><strong>Pendentes: {{$pending}}</strong>  <strong>    Todos: {{$contractAll}}</strong></p>
                    <p><strong>Ativos: {{$active}}</strong></p>
                    <p><strong>Cancelados: {{$canceled}}</strong></p>

                </div>
                <div class="icon">
                    <i class="fas fa-file"></i>
                </div>

            </div>
        </div>
        <!-- ./col -->
    </div>

    <div class="row mt-5">
        <div class="col-sm-6">
            <h3 class="m-0 text-dark"><i class="fa fa-file"></i> Últimos Contratos Cadastrados</h3>
        </div>
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
    <!-- /.row -->
@endsection
