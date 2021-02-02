@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-list-alt"></i> Lista de Imóveis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-success"
                                                       href="{{route('admin.properties.create')}}">
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
    <div class="card card-default col-12">
        <div class="card-header">
            <h1 class="card-title">Imóveis</h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                        class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if(!empty($properties))
                    @foreach($properties as $property)
                        <div class="card col-lg-12" style="padding: 0">
                            <div class="row">
                                <div class="col-lg-5">
                                    <img class="card-img-top" src="{{$property->cover()}}" alt="Card image cap">
                                    <h5 class="property-title">#{{$property->id}} {{$property->title}}</h5>
                                </div>
                                <div class="col-lg-7">
                                    <div class="card-body imovel-show row">
                                        <ul class="list-unstyled row">
                                            <div class="col-lg-6">
                                                <li>
                                                    <p>
                                                        <i class="fa fa-search-location"></i>Bairro: {{$property->neighborhood}}
                                                    </p>
                                                </li>
                                                <li>
                                                    <p><i class="fa fa-home"></i>Área Útil:: {{$property->area_util}}
                                                    </p>
                                                </li>
                                            </div>
                                            <div class="col-lg-6">
                                                <li>
                                                    <p><i class="fa fa-bed"></i>Domitórios: {{$property->rooms}}</p>
                                                </li>
                                                <li>
                                                    <p><i class="fa fa-warehouse"></i>Garagem: {{$property->garage}}</p>
                                                </li>
                                            </div>

                                            <div class="col-lg-12">
                                                <li class="p-4">
                                                    <div class="d-flex justify-content-around">
                                                        <p>Venda: R$ {{$property->sale_price}}</p>
                                                        <p>Aluguél: R$ {{$property->rent_price}}</p>
                                                        <p>Visualizações: {{$property->views}} </p>
                                                    </div>
                                                    <div class="d-flex  justify-content-around">
                                                        <a href="{{route('admin.properties.edit',['property'=>$property->id])}}"
                                                           class="col-lg-6 btn btn-primary"><i class="fa fa-edit"></i>
                                                            Editar</a>
                                                    </div>
                                                </li>
                                            </div>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
