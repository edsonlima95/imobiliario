@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-edit"></i> Edição de Empresas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-success" href="{{route('admin.companies.create')}}">
                                <i class="fa fa-plus-circle mr-1"></i> <strong>Cadastrar</strong></a></li>
                        <li class="breadcrumb-item"><a class="btn btn-primary" href="{{route('admin.companies.index')}}">
                                <i class="fa fa-list mr-1"></i> <strong>Listar</strong></a></li>
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
    <form action="{{route('admin.companies.update',['company'=>$company->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="card card-default col-12">
                <div class="card-header">
                    <h3 class="card-title">Empresa</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="genre">Responsável Legal:</label>
                            <select name="user" id="user" class="form-control">
                                <option value="" disabled selected>Selecione um usuário</option>
                                @foreach($users as $user)
                                    <option
                                        value="{{$user->id}}" {{old('user') ? 'selected' : ($company->user == $user->id ? 'selected' : '')}}>
                                        {{$user->name}} ({{$user->document}})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="zipcode">*Razão Social:</label>
                            <input type="text" class="form-control" id="social_name"
                                   name="social_name" placeholder="Razão Social" value="{{old('social_name') ? old('social_name')  : $company->social_name }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="zipcode">Nome Fantasia:</label>
                            <input type="text" class="form-control" id="alias_name"
                                   name="alias_name" placeholder="Nome Fantasia" value="{{old('alias_name') ? old('alias_name')  : $company->alias_name }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="street">CNPJ:</label>
                            <input type="text" class="form-control mask-cnpj" id="document_company"
                                   name="document_company" placeholder="CNPJ da Empresa"
                                   value="{{old('document_company') ? old('document_company')  : $company->document_company }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="number">Inscrição Estadual:</label>
                            <input type="text" class="form-control" id="number" name="document_company_secondary"
                                   placeholder="Número da Inscrição"
                                   value="{{old('document_company_secondary') ? old('document_company_secondary')  : $company->document_company_secondary }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-default col-12">
                <div class="card-header">
                    <h3 class="card-title">Endereço</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="zipcode">*CEP:</label>
                            <input type="text" class="form-control zip_code_search mask-zipcode" id="zipcode"
                                   name="zipcode" placeholder="Digite o CEP" value="{{old('zipcode') ? old('zipcode')  : $company->zipcode }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="street">*Endereço:</label>
                            <input type="text" class="form-control" id="street" name="street"
                                   placeholder="Endereço Completo" value="{{old('street') ? old('street')  : $company->street }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="number">*Numero:</label>
                            <input type="text" class="form-control" id="number" name="number"
                                   placeholder="Número do Endereço" value="{{old('number') ? old('number')  : $company->number }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="complement">*Complemento:</label>
                            <input type="text" class="form-control" id="complement" name="complement"
                                   placeholder="Completo (Opcional)" value="{{old('complement') ? old('complement')  : $company->complement }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="neighborhood">*Bairro:</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                                   placeholder="Bairro" value="{{old('neighborhood') ? old('neighborhood')  : $company->neighborhood }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="state">*Estado:</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="Estado"
                                   value="{{old('state') ? old('state')  : $company->state }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="city">*Cidade:</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Cidade"
                                   value="{{old('city') ? old('city')  : $company->city }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 btn-center">
                <button type="submit" class="col-4 btn btn-primary"><i class="mr-2 fa fa-edit"></i>Atualizar</button>
            </div>
        </div>
    </form>
@endsection
