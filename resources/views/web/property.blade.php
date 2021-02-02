@extends('web.layout')
@section('content')
    <div class="hero-property">
        <div class="container text-capitalize">
            <h1 class="mb-3">{{\Illuminate\Support\Str::words($property->title,7,'...')}}</h1>
            <p>{{$property->category}} - {{$property->type}} - {{$property->neighborhood}}</p>
        </div>
    </div>
    <section class="property">
        <div class="container d-flex">
            <div class="col-lg-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($property->images()->get() as $images)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration}}"
                                class="active"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($property->images()->get() as $images)
                            <div class="carousel-item {{$loop->iteration == 1 ? 'active' : ''}}">
                                <a data-lightbox="roadtrip" href="{{\Illuminate\Support\Facades\Storage::url(\App\Support\Cropper::thumb($images->path,735,500))}}" >
                                <img class="d-block w-100 img-fluid"
                                     src="{{\Illuminate\Support\Facades\Storage::url(\App\Support\Cropper::thumb($images->path,735,500))}}"
                                     alt="First slide">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="price mt-3">
                    <p><small>{{$property->tribute ? "IPTU: R$ {$property->tribute}" : ''}}  {{$property->condominium != 0 ? "| Condomínio: R$ {$property->condominium}" : ''}}</small></p>
                    <p class="property-price">{{$property->sale == 1 ? "Valor do Imóvel: R$ {$property->sale_price}" : "Aluguel do Imóvel: R$ {$property->rent_price}"}}</p>
                </div>
                <div class="description">
                    <h2 class="mb-4">Conheça mais o imóvel</h2>
                    <p>{!! $property->description !!}</p>
                </div>
                <div class="caracterists">
                    <h2 class="mb-4">Características</h2>
                    <table class="table table-striped" style="margin-bottom: 40px;">
                        <tbody>
                        <tr>
                            <td>Domitórios</td>
                            <td>{{$property->bedrooms}}</td>
                        </tr>
                        <tr>
                            <td>Suítes</td>
                            <td>{{$property->suites}}</td>
                        </tr>
                        <tr>
                            <td>Banheiros</td>
                            <td>{{$property->bathrooms}}</td>
                        </tr>
                        <tr>
                            <td>Salas</td>
                            <td>{{$property->rooms}}</td>
                        </tr>
                        <tr>
                            <td>Garagem</td>
                            <td>{{$property->garage}}</td>
                        </tr>
                        <tr>
                            <td>Garagem Coberta</td>
                            <td>{{$property->garage_covered}}</td>
                        </tr>
                        <tr>
                            <td>Área Total</td>
                            <td>{{$property->area_total}} m²</td>
                        </tr>
                        <tr>
                            <td>Área Útil</td>
                            <td>{{$property->area_util}} m²</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="structure mb-4">
                    <h2 class="mb-4">Estrutura</h2>
                    @if($property->air_conditioning == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Ar Condicionado</span>
                    @endif

                    @if($property->bar == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Bar</span>
                    @endif

                    @if($property->library == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Biblioteca</span>
                    @endif

                    @if($property->barbecue_grill == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Churrasqueira</span>
                    @endif

                    @if($property->american_kitchen == 1)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Cozinha Americana</span>
                    @endif

                    @if($property->fitted_kitchen == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Cozinha Planejada</span>
                    @endif

                    @if($property->pantry == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Despensa</span>
                    @endif

                    @if($property->edicule == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Edicula</span>
                    @endif

                    @if($property->office == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Escritório</span>
                    @endif

                    @if($property->bathtub == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Banheira</span>
                    @endif

                    @if($property->fireplace == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Lareira</span>
                    @endif

                    @if($property->lavatory == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Lavabo</span>
                    @endif

                    @if($property->furnished == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Mobiliado</span>
                    @endif

                    @if($property->pool == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Piscina</span>
                    @endif

                    @if($property->steam_room == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Sauna</span>
                    @endif

                    @if($property->view_of_the_sea == true)
                        <span class="btn btn-success mb-2"><i class="fa fa-check"></i> Vista para o Mar</span>
                    @endif

                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-danger">
                    <div class="card-header">
                        Entre em contato
                    </div>
                    <div class="card-body">
                        <form action="{{route('web.sendEmail')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome completo</label>
                                <input type="text" class="form-control" name="name" aria-describedby="emailHelp"
                                       placeholder="Nome completo">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" aria-describedby="emailHelp"
                                       placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="cell">Telefone</label>
                                <input type="number" class="form-control" name="cell" aria-describedby="emailHelp"
                                       placeholder="Celular">
                            </div>
                            <div class="form-group">
                                <label for="message">Sua mensagem</label>
                                <textarea name="message" class="form-control" id="message" aria-describedby="emailHelp"
                                          placeholder="Mensagem">Olá, preciso de mais informações sobre o imóvel.</textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg col-12">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.inc.mail')
@endsection
