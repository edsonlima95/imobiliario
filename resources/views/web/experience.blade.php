@extends('web.layout')

@section('content')
    <div class="hero-property">
        <div class="container text-capitalize">
            <h1>{{$propertyExperience[0]->experience}}</h1>
            <p>Encontre aqui uma variedade de imóveis para você ou sua família</p>
        </div>
    </div>
    <section class="property-category">
        <div class="container">
            <div class="row">
                @foreach($propertyExperience as $experience)
                    <div class="col-lg-4">
                        <div class="imovel-content">
                            <a href="{{route('web.buyProperty',['slug'=>$experience->slug])}}">
                                <img src="{{$experience->cover()}}" class="img-fluid" alt="">
                            </a>
                            <ul class="list-unstyled">
                                <li><h2>
                                        <a href="{{route('web.buyProperty',['slug'=>$experience->slug])}}">{{$experience->title}}</a>
                                    </h2></li>
                                <li><p>{{$experience->category}}</p></li>
                                <li><p>{{$experience->type}} - {{$experience->neighborhood}}</p></li>
                                <li><p>Visualizações: ( {{$experience->views}} )</p></li>

                                <li>
                                    @if($experience->sale == 1)
                                    <p class="imovel-price">
                                        R$ {{$experience->sale_price ? $experience->sale_price : ''}}
                                    </p>
                                    @endif

                                    @if($experience->rent == 1)
                                        <p class="imovel-price">
                                            R$ {{$experience->rent_price ? $experience->rent_price : ''}}
                                        </p>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{route('web.buyProperty',['slug'=>$experience->slug])}}">
                                        <button class="btn btn-danger col-12">Ver Imóvel</button>
                                    </a>
                                </li>
                                <li class="d-flex justify-content-around mt-3 text-center">
                                    <p>
                                        <i class="fa fa-bed fa-2x"></i><br><small>Dormitórios</small><br>{{$experience->bedrooms}}
                                    </p>
                                    <p>
                                        <i class="fas fa-warehouse fa-2x"></i><br><small>Garagem</small><br>{{$experience->garage}}
                                    </p>
                                    <p><i class="fa fa-chart-area fa-2x"></i><br><small>Area
                                            Útil</small><br>{{$experience->area_util}}m²</p>
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
