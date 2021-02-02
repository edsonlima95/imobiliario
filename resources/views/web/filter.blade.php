@extends('web.layout')
@section('content')
    <div class="main-filter bg-light">

            <div class="container d-flex">
                <div class="col-4">
                    <section class="search-content container filter-aside">
                        <form action="{{route('web.filter')}}" method="post" class="col-12">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Comprar ou Alugar?</label>
                                        <select class="form-control selectpicker" name="filter_search" title="Escolha..." data-index="1"
                                                id="exampleFormControlSelect1" data-action="{{route('component.main-filter.search')}}">
                                            <option value="" disabled selected>Selecione uma opção</option>
                                            <option value="buy">Comprar</option>
                                            <option value="rent">Alugar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="category">O que você quer?</label>
                                        <select class="form-control selectpicker" id="category" name="filter_category" title="Escolha..."
                                                data-index="2" data-action="{{route('component.main-filter.category')}}">
                                            <option disabled>Selecione o filtro anterior</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="type">Qual o tipo do imóvel?</label>
                                        <select class="form-control selectpicker" id="type" name="filter_type" title="Escolha..." data-index="3"
                                                data-action="{{route('component.main-filter.type')}}" multiple>
                                            <option disabled>Selecione o filtro anterior</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="neighborhood">Onde você quer?</label>
                                        <select class="form-control selectpicker" name="filter_neighborhood" id="neighborhood" title="Escolha..."
                                                data-index="4" data-action="{{route('component.main-filter.neighborhood')}}" multiple>
                                            <option disabled>Selecione o filtro anterior</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="fade-filter row col-lg-12" style="display: none">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="bedrooms">Quartos</label>
                                            <select class="form-control selectpicker" name="filter_bedrooms" data-index="5" title="Escolha..." id="bedrooms"
                                                    data-action="{{route('component.main-filter.bedrooms')}}">
                                                <option disabled>Selecione o filtro anterior</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Suites</label>
                                            <select class="form-control selectpicker" name="filter_suites" id="suites" title="Escolha..."
                                                    data-index="6" data-action="{{route('component.main-filter.suites')}}">
                                                <option disabled>Selecione o filtro anterior</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="bathrooms">Banheiros</label>
                                            <select class="form-control selectpicker" name="filter_bathrooms" id="bathrooms" title="Escolha..."
                                                    data-index="7" data-action="{{route('component.main-filter.bathrooms')}}">
                                                <option disabled>Selecione o filtro anterior</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="garage">Garagem</label>
                                            <select class="form-control selectpicker" name="filter_garage" id="garage" title="Escolha..."
                                                    data-index="8" data-action="{{route('component.main-filter.garage')}}">
                                                <option disabled>Selecione o filtro anterior</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="base">Preço Base</label>
                                            <select class="form-control selectpicker" name="filter_base" id="base" title="Escolha..." data-index="9"
                                                    data-action="{{route('component.main-filter.priceBase')}}">
                                                <option disabled>Selecione o filtro anterior</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
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
                </div>

                <div class="col-lg-8">
                    <section class="imovel-filter">
                        <div class="container">
                            <div class="c-title col-lg-12 my-5 text-center">
                                <h2>{{$properties[0]->sale == 1 ? 'Para Comprar' : 'Para Alugar'}}</h2>
                            </div>
                            <div class="row">
                                @foreach($properties as $property)
                                    <div class="col-lg-6">
                                        <div class="imovel-content">
                                            <a href="{{route(session('sale') == true ? 'web.buyProperty' : 'web.rentProperty',['slug' => $property->slug])}}">
                                                <img src="{{$property->cover()}}" alt="">
                                            </a>
                                            <ul class="list-unstyled">
                                                <li><h2><a href="">{{$property->title}}</a></h2></li>
                                                <li><p>{{$property->category}}</p></li>
                                                <li><p>{{$property->type}} - {{$property->neighborhood}}</p></li>
                                                <li><p class="imovel-price">
                                                        R$ {{$property->sale == 1 ? $property->sale_price : $property->rent_price}}</p>
                                                </li>
                                                <li>
                                                    <button class="btn btn-danger col-12">Ver Imóvel</button>
                                                </li>
                                                <li class="d-flex justify-content-around mt-3 text-center">
                                                    <p><i class="fa fa-bed fa-2x"></i><br>2</p>
                                                    <p><i class="fas fa-warehouse fa-2x"></i><br>1</p>
                                                    <p><i class="fa fa-chart-area fa-2x"></i><br>3</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>

    </div>
    @include('web.inc.mail')
@endsection
