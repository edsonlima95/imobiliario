@extends('web.layout')
@section('content')
    <div class="hero">
        <div class="action container">
            <div class="col-lg-7">
                <p class="text-title">ENCONTRE O <strong class="bg-red-title">IMÓVEL</strong> IDEAL PARA VOCÊ E SUA
                    FAMÍLIA MORAR!
                </p>
                <a href="{{route('web.propertyCategory',['type'=>'alugar'])}}"
                   class="btn btn-success btn-lg mr-3 bg-dark border-0">Quero <strong>Alugar</strong></a>
                <a href="{{route('web.propertyCategory',['type'=>'venda'])}}"
                   class="btn btn-success btn-lg bg-dark border-0">Quero <strong>Comprar</strong></a>
            </div>
        </div>
    </div>

    {{-- PESQUSIA--}}
    <section class="search-content container">
        <form action="{{route('web.filter')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Comprar ou Alugar?</label>
                        <select class="form-control selectpicker" name="filter_search" title="" data-index="1"
                                id="exampleFormControlSelect1" data-action="{{route('component.main-filter.search')}}">
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="buy">Comprar</option>
                            <option value="rent">Alugar</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="category">O que você quer?</label>
                        <select class="form-control selectpicker" id="category" name="filter_category"
                                title="Escolha..."
                                data-index="2" data-action="{{route('component.main-filter.category')}}">
                            <option disabled>Selecione o filtro anterior</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="type">Qual o tipo do imóvel?</label>
                        <select class="form-control selectpicker" id="type" name="filter_type" title="Escolha..."
                                data-index="3"
                                data-action="{{route('component.main-filter.type')}}" multiple>
                            <option disabled>Selecione o filtro anterior</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="neighborhood">Onde você quer?</label>
                        <select class="form-control selectpicker" name="filter_neighborhood" id="neighborhood"
                                title="Escolha..."
                                data-index="4" data-action="{{route('component.main-filter.neighborhood')}}" multiple>
                            <option disabled>Selecione o filtro anterior</option>
                        </select>
                    </div>
                </div>

                <div class="fade-filter row col-lg-12" style="display: none">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="bedrooms">Quartos</label>
                            <select class="form-control selectpicker" name="filter_bedrooms" data-index="5"
                                    id="bedrooms"
                                    data-action="{{route('component.main-filter.bedrooms')}}">
                                <option disabled>Selecione o filtro anterior</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Suites</label>
                            <select class="form-control selectpicker" name="filter_suites" id="suites"
                                    title="Escolha..."
                                    data-index="6" data-action="{{route('component.main-filter.suites')}}">
                                <option disabled>Selecione o filtro anterior</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="bathrooms">Banheiros</label>
                            <select class="form-control selectpicker" name="filter_bathrooms" id="bathrooms"
                                    title="Escolha..."
                                    data-index="7" data-action="{{route('component.main-filter.bathrooms')}}">
                                <option disabled>Selecione o filtro anterior</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="garage">Garagem</label>
                            <select class="form-control selectpicker" name="filter_garage" id="garage"
                                    title="Escolha..."
                                    data-index="8" data-action="{{route('component.main-filter.garage')}}">
                                <option disabled>Selecione o filtro anterior</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="base">Preço Base</label>
                            <select class="form-control selectpicker" name="filter_base" id="base" title="Escolha..."
                                    data-index="9"
                                    data-action="{{route('component.main-filter.priceBase')}}">
                                <option disabled>Selecione o filtro anterior</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="limit">Preço Limite</label>
                            <select class="form-control selectpicker" name="filter_limit" id="limit" title="Escolha..."
                                    data-index="10" data-action="{{route('component.main-filter.priceLimit')}}">
                                <option disabled>Selecione o filtro anterior</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-between">
                    <a href="" class="ml-4 advanced-filter">Filtro Avançado ↓</a>
                    <button class="mr-4 btn btn-danger"><i class="fa fa-search"></i> Pesquisar</button>
                </div>
            </div>
        </form>
    </section>

    <section class="category pb-3">
        <div class="container">
            <div class="category-content col-lg-12 text-center py-3">
                <h1>Imóveis sob demanda <span class="bg-red-title">no seu estilo</span></h1>
                <p>Encontre o imóvel ideal para você morar entre os mais diversos gostos e estilos!</p>
            </div>
            <div class="category-wrap">
                <div class="card-img-category-1">
                    <a href="{{route('web.experience',['slug'=>'regiao-central'])}}">
                        <div class="category-title col-12">
                            <p>Região Central</p>
                        </div>
                    </a>
                </div>
                <div class="card-img-category-2">
                    <a href="{{route('web.experience',['slug'=>'alto-padrao'])}}">
                        <div class="category-title col-12">
                            <p>Alto Padrão</p>
                        </div>
                    </a>
                </div>
                <div class="card-img-category-3">
                    <a href="{{route('web.experience',['slug'=>'medio-padrao'])}}">
                        <div class="category-title col-12">
                            <p>Médio Padrão</p>
                        </div>
                    </a>
                </div>
                <div class="card-img-category-4">
                    <a href="{{route('web.experience',['slug'=>'condominio-fechado'])}}">
                        <div class="category-title col-12">
                            <p>Condominio</p>
                        </div>
                    </a>
                </div>
                <div class="card-img-category-5">
                    <a href="{{route('web.experience',['slug'=>'chacara'])}}">
                        <div class="category-title col-12">
                            <p>Chácara</p>
                        </div>
                    </a>
                </div>
                <div class="card-img-category-6">
                    <a href="{{route('web.experience',['slug'=>'cobertura'])}}">
                        <div class="category-title col-12">
                            <p>Cobertura</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="rent">
        <div class="container">
            <div class="c-title col-lg-12 my-5 text-center">
                <h2>Para Vender</h2>
            </div>
            <div class="row">
                @foreach($forSale as $propertySale)
                    <div class="col-lg-4">
                        <div class="imovel-content">
                            <a href="{{route('web.buyProperty',['slug'=>$propertySale->slug])}}">
                                <img src="{{$propertySale->cover()}}" class="img-fluid" alt="">
                            </a>
                            <ul class="list-unstyled">
                                <li><h2>
                                        <a href="{{route('web.buyProperty',['slug'=>$propertySale->slug])}}">{{$propertySale->title}}</a>
                                    </h2></li>
                                <li><p>{{$propertySale->category}}</p></li>
                                <li><p>{{$propertySale->type}} - {{$propertySale->neighborhood}}</p></li>
                                <li><p>Visualizações: ( {{$propertySale->views}} )</p></li>
                                <li><p class="imovel-price">R$ {{$propertySale->sale_price}}</p></li>
                                <li>
                                    <a href="{{route('web.buyProperty',['slug'=>$propertySale->slug])}}">
                                        <button class="btn btn-danger col-12">Ver Imóvel</button>
                                    </a>
                                </li>
                                <li class="d-flex justify-content-around mt-3 text-center">
                                    <p>
                                        <i class="fa fa-bed fa-2x"></i><br><small>Dormitórios</small><br>{{$propertySale->bedrooms}}
                                    </p>
                                    <p>
                                        <i class="fas fa-warehouse fa-2x"></i><br><small>Garagem</small><br>{{$propertySale->garage}}
                                    </p>
                                    <p><i class="fa fa-chart-area fa-2x"></i><br><small>Area
                                            Útil</small><br>{{$propertySale->area_util}}m²</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                <div class="more col-lg-12 text-center mt-5 font-weight-bold">
                    <a style="font-size: 1.3em; color: #dc3545"
                       href="{{route('web.propertyCategory',['type'=>'venda'])}}">Ver mais...</a>
                </div>
            </div>
        </div>
    </section>

    <section class="sale">
        <div class="container">
            <div class="c-title col-lg-12 my-5 text-center">
                <h2>Para Alugar</h2>
            </div>
            <div class="row">
                @foreach($forRent as $propertyRent)
                    <div class="col-lg-4">
                        <div class="imovel-content">
                            <a href="{{route('web.rentProperty',['slug'=>$propertyRent->slug])}}">
                                <img src="{{$propertyRent->cover()}}" class="img-fluid" alt="">
                            </a>
                            <ul class="list-unstyled">
                                <li><h2>
                                        <a href="{{route('web.rentProperty',['slug'=>$propertyRent->slug])}}">{{$propertyRent->title}}</a>
                                    </h2></li>
                                <li><p>{{$propertyRent->category}}</p></li>
                                <li><p>{{$propertyRent->type}} - {{$propertyRent->neighborhood}}</p></li>
                                <li><p>Visualizações: ( {{$propertyRent->views}} )</p></li>
                                <li><p class="imovel-price">R$ {{$propertyRent->rent_price}}</p></li>
                                <li>
                                    <a href="{{route('web.rentProperty',['slug'=>$propertyRent->slug])}}">
                                        <button class="btn btn-danger col-12">Ver Imóvel</button>
                                    </a>
                                </li>
                                <li class="d-flex justify-content-around mt-3 text-center">
                                    <p>
                                        <i class="fa fa-bed fa-2x"></i><br><small>Dormitórios</small><br>{{$propertyRent->bedrooms}}
                                    </p>
                                    <p>
                                        <i class="fas fa-warehouse fa-2x"></i><br><small>Garagem</small><br>{{$propertyRent->garage}}
                                    </p>
                                    <p><i class="fa fa-chart-area fa-2x"></i><br><small>Area
                                            Útil</small><br>{{$propertyRent->area_util}}m²</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
                <div class="more col-lg-12 text-center my-5 font-weight-bold">
                    <a style="font-size: 1.3em; color: #dc3545"
                       href="{{route('web.propertyCategory',['type'=>'alugar'])}}">Ver mais...</a>
                </div>
            </div>
        </div>
    </section>

    @include('web.inc.mail')
@endsection

