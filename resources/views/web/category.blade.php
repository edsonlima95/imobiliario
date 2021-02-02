@extends('web.layout')

@section('content')
    <div class="hero-property">
        <div class="container text-capitalize">
            <h1>{{$propertyCategory[0]->sale == true ? 'Imóveis para venda' : 'Imóveis para locação'}}</h1>
            <p>Encontre aqui uma variedade de imóveis para você ou sua família</p>
        </div>
    </div>
    <section class="property-category">
        <div class="container">
            <div class="row">
                @foreach($propertyCategory as $category)
                    <div class="col-lg-3">
                        <div class="imovel-content">
                            <a href="{{route('web.buyProperty',['slug'=>$category->slug])}}">
                                <img src="{{$category->cover()}}" class="img-fluid" alt="">
                            </a>
                            <ul class="list-unstyled">
                                <li><h2>
                                        <a href="{{route('web.buyProperty',['slug'=>$category->slug])}}">{{$category->title}}</a>
                                    </h2></li>
                                <li><p>{{$category->category}}</p></li>
                                <li><p>{{$category->type}} - {{$category->neighborhood}}</p></li>
                                <li><p>Visualizações: ( {{$category->views}} )</p></li>
                                <li>
                                    @if($category->sale == 1)
                                        <p class="imovel-price">
                                            R$ {{$category->sale_price ? $category->sale_price : ''}}
                                        </p>
                                    @endif

                                    @if($category->rent == 1)
                                        <p class="imovel-price">
                                            R$ {{$category->rent_price ? $category->rent_price : ''}}
                                        </p>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{route('web.buyProperty',['slug'=>$category->slug])}}">
                                        <button class="btn btn-danger col-12">Ver Imóvel</button>
                                    </a>
                                </li>
                                <li class="d-flex justify-content-around mt-3 text-center">
                                    <p>
                                        <i class="fa fa-bed fa-2x"></i><br><small>Dormitórios</small><br>{{$category->bedrooms}}
                                    </p>
                                    <p>
                                        <i class="fas fa-warehouse fa-2x"></i><br><small>Garagem</small><br>{{$category->garage}}
                                    </p>
                                    <p><i class="fa fa-chart-area fa-2x"></i><br><small>Area
                                            Útil</small><br>{{$category->area_util}}m²</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('web.inc.mail')
@endsection
