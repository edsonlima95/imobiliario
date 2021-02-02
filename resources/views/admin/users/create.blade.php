@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-plus-circle"></i> Cadastro de Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-primary" href="{{route('admin.users.index')}}">
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

    <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data" class="col-12">
        @csrf
        {{-- MENU TABLS --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data"
                   aria-selected="true">Dados Cadastrais</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="conjugue-tab" data-toggle="tab" href="#conjugue" role="tab"
                   aria-controls="conjugue"
                   aria-selected="false">Dados Complementares</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="imobil-tab" data-toggle="tab" href="#imobil" role="tab" aria-controls="imobil"
                   aria-selected="false">Imóveis</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin"
                   aria-selected="false">Administrativo</a>
            </li>
        </ul>

        {{-- CONTEUDO --}}
        <div class="tab-content" id="myTabContent">

            {{-- DADOS CADASTRAIS --}}
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">

                <nav class="navbar navbar-light bg-dark my-3 p-3 justify-content-start">
                    <div class="form-check form-check-inline mr-4">
                        <label class="form-check-label font-weight-bold" for="inlineCheckbox1">Perfil:</label>
                    </div>
                    <div class="form-check form-check-inline mr-5">
                        <input class="form-check-input" type="checkbox" id="lessor"
                               name="lessor" {{old('lessor') == 'on' || old('lessor') == true ? 'checked' : ''}}>
                        <label class="form-check-label" for="lessor">Locatário</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="lessee"
                               name="lessee" {{old('lessee') == 'on' || old('lessee') == true ? 'checked' : ''}}>
                        <label class="form-check-label" for="lessee">Locador</label>
                    </div>
                </nav>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h1 class="card-title">Pessoal</h1>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="name">*Nome:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Nome Completo"
                                       value="{{old('name') ?? ''}}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="genre">*Genero:</label>
                                <select name="genre" id="genre" class="form-control">
                                    <option value="male" {{old('genre') == 'male' ? 'selected' : ''}}>Masculino</option>
                                    <option value="female" {{old('genre') == 'female' ? 'selected' : ''}}>Feminino
                                    </option>
                                    <option value="other" {{old('genre') == 'other' ? 'selected' : ''}}>Outros</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="document">*CPF:</label>
                                <input type="text" class="form-control mask-doc" id="document" name="document"
                                       placeholder="CPF do Cliente" value="{{old('document') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="document_secondary">*RG:</label>
                                <input type="text" class="form-control mask-doc-secondary" id="document_secondary"
                                       name="document_secondary"
                                       placeholder="RG do Cliente" value="{{old('document_secondary') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="document_secondary_complement">*Órgão Expedidor:</label>
                                <input type="text" class="form-control" id="document_secondary_complement"
                                       name="document_secondary_complement" placeholder="Expedição"
                                       value="{{old('document_secondary_complement') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="date_of_birth">*Data Nascimento:</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                       placeholder="Data de Nascimento" value="{{old('date_of_birth') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="place_of_birth">*Naturalidade</label>
                                <input type="text" class="form-control" id="place_of_birth" name="place_of_birth"
                                       placeholder="Naturalidade" value="{{old('place_of_birth') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="exampleFormControlSelect2">*Estado Civil</label>
                                <select class="form-control" name="civil_status">
                                    <optgroup label="Cônjuge Obrigatório">
                                        <option value="married" {{old('civil_status') == 'married' ? 'selected' : ''}}>
                                            Casado
                                        </option>
                                        <option
                                            value="separated" {{old('civil_status') == 'separated' ? 'selected' : ''}}>
                                            Separado
                                        </option>
                                    </optgroup>
                                    <optgroup label="Cônjuge não Obrigatório">
                                        <option value="single" {{old('civil_status') == 'married' ? 'selected' : ''}}>
                                            Solteiro
                                        </option>
                                        <option
                                            value="divorced" {{old('civil_status') == 'divorced' ? 'selected' : ''}}>
                                            Divorciado
                                        </option>
                                        <option value="widower" {{old('civil_status') == 'widower' ? 'selected' : ''}}>
                                            Viúvo
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="cover">Foto</label>
                                <input type="file" name="cover" class="form-control" id="cover">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Renda</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="occupation">*Profissão:</label>
                                <input type="text" class="form-control" id="occupation" name="occupation"
                                       placeholder="Profissão do Cliente" value="{{old('occupation') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="income">*Renda:</label>
                                <input type="text" class="form-control mask-money" id="income" name="income"
                                       placeholder="Valores em Reais" value="{{old('income') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="company_work">*Empresa:</label>
                                <input type="text" class="form-control" id="company_work" name="company_work"
                                       placeholder="Contratante" value="{{old('company_work') ?? ''}}">
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
                                       name="zipcode" placeholder="Digite o CEP" value="{{old('zipcode') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="street">*Endereço:</label>
                                <input type="text" class="form-control" id="street" name="street"
                                       placeholder="Endereço Completo" value="{{old('street') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="number">*Numero:</label>
                                <input type="text" class="form-control" id="number" name="number"
                                       placeholder="Número do Endereço" value="{{old('number') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="complement">Complemento:</label>
                                <input type="text" class="form-control" id="complement" name="complement"
                                       placeholder="Completo (Opcional)" value="{{old('complement') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="neighborhood">*Bairro:</label>
                                <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                                       placeholder="Bairro" value="{{old('neighborhood') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="state">*Estado:</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Estado"
                                       value="{{old('state') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="city">*Cidade:</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade"
                                       value="{{old('city') ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Contato</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="telephone">Telefone:</label>
                                <input type="text" class="form-control mask-tel" id="telephone" name="telephone"
                                       placeholder="Número do Telefonce com DDD (opcional)" value="{{old('telephone') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="cell">*Celular:</label>
                                <input type="text" class="form-control mask-phone" id="cell" name="cell"
                                       class="mask-cell"
                                       placeholder="Número do Telefonce com DDD" value="{{old('cell') ?? ''}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Acesso</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="email">*Email:</label>
                                <input type="text" class="form-control" id="email" name="email"
                                       placeholder="Melhor e-mail"
                                       value="{{old('email') ?? ''}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="password">*Senha:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Senha de acesso" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 btn-center">
                    <button type="submit" class="col-4 btn btn-success"><i class="mr-2 fa fa-save"></i>Cadastrar</button>
                </div>
            </div>

            {{-- DADOS COMPLEMENTARES --}}
            <div class="mt-3 tab-pane fade" id="conjugue" role="tabpanel" aria-labelledby="conjugue-tab">
                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Cônjuge</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body js-conjugue">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="genre">Tipo de Comunhão:</label>
                                <select name="type_of_communion" class="form-control">
                                    <option value="">Selecione um tipo de comunhao</option>
                                    <option
                                        value="Comunhão Universal de Ben" {{old('type_of_communion') == 'Comunhão Universal de Ben' ? 'selected' : ''}}>
                                        Comunhão Universal de Bens
                                    </option>
                                    <option
                                        value="Comunhão Parcial de Bens" {{old('type_of_communion') == 'Comunhão Parcial de Bens' ? 'selected' : ''}}>
                                        Comunhão Parcial de Bens
                                    </option>
                                    <option
                                        value="Separação Total de Bens" {{old('type_of_communion') == 'Separação Total de Bens' ? 'selected' : ''}}>
                                        Separação Total de Bens
                                    </option>
                                    <option
                                        value="Participação Final de Aquestos" {{old('type_of_communion') == 'Participação Final de Aquestos' ? 'selected' : ''}}>
                                        Participação Final de Aquestos
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="spouse_name">Nome:</label>
                                <input type="text" class="form-control" id="spouse_name" name="spouse_name"
                                       placeholder="Nome Completo" value="{{old('spouse_name')}}">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="genre">Genero:</label>
                                <select name="spouse_genre" id="genre" class="form-control">
                                    <option value="male" {{old('type_of_communion') == 'male' ? 'selected' : ''}}>
                                        Masculino
                                    </option>
                                    <option value="female" {{old('type_of_communion') == 'female' ? 'selected' : ''}}>
                                        Feminino
                                    </option>
                                    <option value="other" {{old('type_of_communion') == 'other' ? 'selected' : ''}}>
                                        Outros
                                    </option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="spouse_document">CPF:</label>
                                <input type="text" class="form-control mask-doc" id="spouse_document"
                                       name="spouse_document"
                                       placeholder="CPF do Cliente" value="{{old('spouse_document')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="spouse_document_secondary">RG:</label>
                                <input type="text" class="form-control mask-doc-secondary"
                                       id="spouse_document_secondary"
                                       name="spouse_document_secondary" placeholder="RG do Cliente"
                                       value="{{old('spouse_document_secondary')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="document_secondary_complement">Órgão Expedidor:</label>
                                <input type="text" class="form-control" id="document_secondary_complement"
                                       name="spouse_document_secondary_complement" placeholder="Expedição"
                                       value="{{old('document_secondary_complement')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="spouse_date_of_birth">Data Nascimento:</label>
                                <input type="date" class="form-control" id="spouse_date_of_birth"
                                       name="spouse_date_of_birth"
                                       placeholder="Data de Nascimento" value="{{old('spouse_date_of_birth')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="spouse_place_of_birth">Naturalidade</label>
                                <input type="text" class="form-control" id="spouse_place_of_birth"
                                       name="spouse_place_of_birth"
                                       placeholder="Cidade de Nascimento" value="{{old('spouse_place_of_birth')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="spouse_occupation">*Profissão:</label>
                                <input type="text" class="form-control" id="spouse_occupation" name="spouse_occupation"
                                       placeholder="Profissão do Cliente" value="{{old('spouse_occupation')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="spouse_income">*Renda:</label>
                                <input type="text" class="form-control mask-money" id="spouse_income"
                                       name="spouse_income"
                                       placeholder="Valores em Reais" value="{{old('spouse_income')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="spouse_company_work">*Empresa:</label>
                                <input type="text" class="form-control" id="spouse_company_work"
                                       name="spouse_company_work"
                                       placeholder="Contratante" value="{{old('spouse_company_work')}}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 btn-center">
                    <button type="submit" class="col-4 btn btn-success"><i class="mr-2 fa fa-save"></i>Cadastrar</button>
                </div>
            </div>

            {{-- IMÓVEIS --}}
            <div class="mt-3 tab-pane fade" id="imobil" role="tabpanel" aria-labelledby="imobil-tab">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Locador</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h2>Locador</h2>
                        </div>
                    </div>
                </div>

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Locatário</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <h2>Locatário</h2>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DADOS ADMINISTRATIVO --}}
            <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                <nav class="navbar navbar-light bg-dark my-3 p-3 justify-content-start">
                    <div class="form-check form-check-inline mr-4">
                        <label class="form-check-label font-weight-bold" for="inlineCheckbox1">Conceder:</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="admin"
                               name="admin" {{old('admin') == 'on' || old('admin') == true ? 'checked' : ''}}>
                        <label class="form-check-label" for="admin">Administrativo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="client"
                               name="client" {{old('client') == 'on' || old('client') == true ? 'checked' : ''}}>
                        <label class="form-check-label" for="client">Cliente</label>
                    </div>
                </nav>
            </div>

        </div>
    </form>
@endsection
