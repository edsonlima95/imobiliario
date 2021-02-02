@extends('admin.layout')
@section('content')
    <!-- Content Header (Admin) -->
    <div class="content-header ">
        <div class="container-fluid my-4">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-plus-circle"></i> Cadastro de Imóveis</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a class="btn btn-primary" href="{{route('admin.properties.index')}}">
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
    <form action="{{ route('admin.properties.store') }}" method="post" enctype="multipart/form-data" class="col-12">
        @csrf
        {{-- MENU TABLS --}}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="data-tab" data-toggle="tab" href="#data" role="tab" aria-controls="data"
                   aria-selected="true">Dados Cadastrais</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="structure-tab" data-toggle="tab" href="#structure" role="tab"
                   aria-controls="structure"
                   aria-selected="false">Estrutura</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="image-tab" data-toggle="tab" href="#image" role="tab" aria-controls="image"
                   aria-selected="false">Imagens</a>
            </li>
        </ul>

        {{-- CONTEUDO --}}
        <div class="tab-content" id="myTabContent">

            {{-- DADOS CADASTRAIS --}}
            <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="data-tab">

                <nav class="navbar navbar-light bg-dark my-3 p-3 justify-content-start">
                    <div class="form-check form-check-inline mr-4">
                        <label class="form-check-label font-weight-bold" for="inlineCheckbox1">Finalidade:</label>
                    </div>
                    <div class="form-check form-check-inline mr-5">
                        <input class="form-check-input" type="checkbox" id="sale"
                               name="sale" {{old('sale') == 'on' || old('sale') == true ? 'checked' : ''}}>
                        <input type="hidden" name="sale_persist" value="{{old('sale')}}">
                        <label class="form-check-label" for="lessor">Venda</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="lessee"
                               name="rent" {{old('rent') == 'on' || old('rent') == true ? 'checked' : ''}}>
                        <input type="hidden" name="rent_persist" value="{{old('rent')}}">
                        <label class="form-check-label" for="lessee">Alugar</label>
                    </div>
                </nav>
                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Imóvel</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="category">*Categoria:</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="Imóvel Residencial" {{ (old('category') == 'Imóvel Residencial' ? 'selected' : '') }}>Imóvel Residencial</option>
                                    <option value="Comercial/Industrial" {{ (old('category') == 'Comercial/Industrial' ? 'selected' : '') }}>Comercial/Industrial</option>
                                    <option value="Terreno" {{ (old('category') == 'Terreno' ? 'selected' : '') }}>Terreno</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="type">*Tipo:</label>
                                <select name="type" class="form-control" id="type">
                                    <optgroup label="Imóvel Residencial">
                                        <option value="Casa" {{ (old('type') == 'Casa' ? 'selected' : '') }}>Casa</option>
                                        <option value="Cobertura" {{ (old('type') == 'Cobertura' ? 'selected' : '') }}>Cobertura</option>
                                        <option value="Apartamento" {{ (old('type') == 'Apartamento' ? 'selected' : '') }}>Apartamento</option>
                                        <option value="Studio" {{ (old('type') == 'Studio' ? 'selected' : '') }}>Studio</option>
                                        <option value="Kitnet" {{ (old('type') == 'Kitnet' ? 'selected' : '') }}>Kitnet</option>
                                    </optgroup>
                                    <optgroup label="Comercial/Industrial">
                                        <option value="Sala Comercial" {{ (old('type') == 'Sala Comercial' ? 'selected' : '') }}>Sala Comercial</option>
                                        <option value="Depósito/Galpão" {{ (old('type') == 'Depósito/Galpão' ? 'selected' : '') }}>Depósito/Galpão</option>
                                        <option value="Ponto Comercial" {{ (old('type') == 'Ponto Comercial' ? 'selected' : '') }}>Ponto Comercial</option>
                                    </optgroup>
                                    <optgroup label="Terreno">
                                        <option value="Terreno" {{ (old('type') == 'Terreno' ? 'selected' : '') }}>Terreno</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="user">*Propretário:</label>
                                <select name="user" class="form-control" id="user">
                                    <option value="">Selecione o proprietário</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{old('user') == $user->id ? 'selected' : ''}}>{{ $user->name }} ({{ $user->document }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="status">*Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1" {{ (old('status') == '1' ? 'selected' : '') }}>Disponível</option>
                                    <option value="0" {{ (old('status') == '0' ? 'selected' : '') }}>Indisponível</option>
                                </select>
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
                                       name="zipcode"
                                       placeholder="Digite o CEP" value="{{ old('zipcode') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="street">*Endereço:</label>
                                <input type="text" class="form-control" id="street" name="street"
                                       placeholder="Endereço Completo" value="{{ old('street') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="number">*Numero:</label>
                                <input type="text" class="form-control" id="number" name="number"
                                       placeholder="Número do Endereço" value="{{ old('number') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="complement">Complemento:</label>
                                <input type="text" class="form-control" id="complement" name="complement"
                                       placeholder="Completo (Opcional)" value="{{ old('complement') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="neighborhood">*Bairro:</label>
                                <input type="text" class="form-control" id="neighborhood" name="neighborhood"
                                       placeholder="Bairro" value="{{ old('neighborhood') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="state">*Estado:</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="Estado"
                                       value="{{ old('state') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="city">*Cidade:</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade"
                                       value="{{ old('city') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Precificação e Valores</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="sale_price">Valor de Venda:</label>
                                <input type="text" class="form-control mask-money" id="sale_price"
                                       name="sale_price"
                                       placeholder="R$ 0,00" value="{{ old('sale_price') }}" disabled>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="rent_price">Valor de Locação:</label>
                                <input type="text" class="form-control mask-money" id="rent_price" name="rent_price"
                                       placeholder="R$ 0,00" value="{{ old('rent_price') }}" disabled>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tribute">*IPTU:</label>
                                <input type="text" class="form-control mask-money" id="tribute" name="tribute"
                                       placeholder="R$ 0,00" value="{{ old('tribute') }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="condominium">*Condomínio:</label>
                                <input type="text" class="form-control mask-money" id="condominium" name="condominium"
                                       placeholder="R$ 0,00" value="{{ old('condominium') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Características</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="description">*Descrição do Imóvel:</label>
                                <textarea name="description" cols="30" rows="10" class="mce"
                                          id="description">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="bedrooms">Dormitórios:</label>
                                <input type="text" class="form-control" id="bedrooms"
                                       name="bedrooms" placeholder="Quantidade de Dormitórios" value="{{ old('bedrooms') }}">
                            </div>

                            <div class="form-group col-lg-3">
                                <label for="suites">Suítes:</label>
                                <input type="text" class="form-control" id="suites"
                                       name="suites" placeholder="Quantidade de Suítes" value="{{ old('suites') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="bathrooms">Banheiros:</label>
                                <input type="text" class="form-control" id="bathrooms"
                                       name="bathrooms" placeholder="Quantidade de Banheiros" value="{{ old('bathrooms') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="rooms">Salas:</label>
                                <input type="text" class="form-control" id="rooms"
                                       name="rooms" placeholder="Quantidade de Salas" value="{{ old('rooms') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="garage">Garagem:</label>
                                <input type="text" class="form-control" id="garage"
                                       name="garage" placeholder="Quantidade de Garagem" value="{{ old('garage') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="garage_covered">Garagem Coberta:</label>
                                <input type="text" class="form-control" id="garage_covered"
                                       name="garage_covered"
                                       placeholder="Quantidade de Garagem Coberta" value="{{ old('garage_covered') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="area_total">*Área Total:</label>
                                <input type="text" class="form-control" id="area_total"
                                       name="area_total" placeholder="Quantidade de M&sup2;" value="{{ old('area_total') }}">
                            </div>
                            <div class="form-group col-lg-3">
                                <label for="area_util">*Área Útil:</label>
                                <input type="text" class="form-control" id="area_util" name="area_util"
                                       placeholder="Quantidade de M&sup2;" value="{{ old('area_util') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ESTRUTURA --}}
            <div class="mt-3 tab-pane fade" id="structure" role="tabpanel" aria-labelledby="structure-tab">
                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Estrutura</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="air_conditioning" {{ (old('air_conditioning') == 'on' || old('air_conditioning') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Ar Condicionado</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="bar" {{ (old('bar') == 'on' || old('bar') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Bar</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="library" {{ (old('library') == 'on' || old('library') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Biblioteca</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="barbecue_grill" {{ (old('barbecue_grill') == 'on' || old('barbecue_grill') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Churrasqueira</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="steam_room" {{ (old('steam_room') == 'on' || old('steam_room') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Sauna</label>
                                </div>
                            </div>

                            <div class="col-lg-4 d-flex flex-column">

                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="american_kitchen" {{ (old('american_kitchen') == 'on' || old('american_kitchen') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Cozinha Americana</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="fitted_kitchen" {{ (old('fitted_kitchen') == 'on' || old('fitted_kitchen') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Cozinha Planejada</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="pantry" {{ (old('pantry') == 'on' || old('pantry') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Despensa</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="edicule" {{ (old('edicule') == 'on' || old('edicule') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Edícula</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="office" {{ (old('office') == 'on' || old('office') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Escritório</label>
                                </div>
                            </div>

                            <div class="col-lg-4 d-flex flex-column">
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="bathtub" {{ (old('bathtub') == 'on' || old('bathtub') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Banheira</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="fireplace" {{ (old('fireplace') == 'on' || old('fireplace') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Lareira</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="lavatory" {{ (old('lavatory') == 'on' || old('lavatory') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Lavabo</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="furnished" {{ (old('furnished') == 'on' || old('furnished') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Mobiliado</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="lessor"
                                           name="pool" {{ (old('pool') == 'on' || old('pool') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="lessor">Piscina</label>
                                </div>
                                <div class="form-check form-check-inline mr-5">
                                    <input class="form-check-input" type="checkbox" id="view_of_the_sea"
                                           name="view_of_the_sea" {{ (old('view_of_the_sea') == 'on' || old('view_of_the_sea') == true ? 'checked' : '') }}>
                                    <label class="form-check-label" for="view_of_the_sea">Vista pro Mar</label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card card-default col-12">
                    <div class="card-header">
                        <h3 class="card-title">Informações do Site</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="zipcode">Titulo:</label>
                                <input type="text" class="form-control" id="zipcode"
                                       name="title"
                                       placeholder="Digite o Titulo" value="{{old('title')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="headline">Headline:</label>
                                <input type="text" class="form-control" id="headline"
                                       name="headline"
                                       placeholder="Digite o Titulo" value="{{old('headline')}}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="category">Experiência:</label>
                                <select name="experience" class="form-control">
                                    <option value="Cobertura" {{ (old('experience') == 'Cobertura' ? 'selected' : '') }}>Cobertura</option>
                                    <option value="Alto Padrão" {{ (old('experience') == 'Alto Padrão' ? 'selected' : '') }}>Alto Padrão</option>
                                    <option value="De Frente para o Mar" {{ (old('experience') == 'De Frente para o Mar' ? 'selected' : '') }}>De Frente para o Mar</option>
                                    <option value="Condomínio Fechado" {{ (old('experience') == 'Condomínio Fechado' ? 'selected' : '') }}>Condomínio Fechado</option>
                                    <option value="Compacto" {{ (old('experience') == 'Compacto' ? 'selected' : '') }}>Compacto</option>
                                    <option value="Lojas e Salas" {{ (old('experience') == 'Lojas e Salas' ? 'selected' : '') }}>Lojas e Salas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- IMAGEM --}}
            <div class="mt-3 tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Imagens</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="files">Imagens:</label>
                                <input type="file" name="files[]" multiple class="form-control">
                            </div>
                            <div class="col-lg-12">
                            <div class="content_image d-flex flex-wrap">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 btn-center">
            <button type="submit" class="col-4 btn btn-success"><i class="mr-2 fa fa-save"></i>Cadastrar</button>
        </div>
    </form>
@endsection
@section('js')
    <script>
        $(function () {
            $('input[name="files[]"]').change(function (files) {

                $('.content_image').text('');

                $.each(files.target.files, function (key, value) {
                    var reader = new FileReader();
                    reader.onload = function (value) {
                        $('.content_image').append(
                            '<div class="property_image_item mr-2 mb-2">' +
                            '<img style="width: 143px; height: 137px" src="'+value.target.result+'" alt="">'+
                            '</div>');
                    };
                    reader.readAsDataURL(value);
                });
            });
        });
    </script>
@endsection
