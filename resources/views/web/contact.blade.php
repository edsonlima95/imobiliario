@extends('web.layout')
@section('content')
    <div class="hero-property">
        <div class="container text-capitalize">
            <h1 class="mb-3">Entre em contato com nossa equipe</h1>
            <p>Em breve nós retornaremos o seu e-mail, aguarde um periodo de 24h.</p>
        </div>
    </div>
    <section class="contact">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card card-default">
                    <div class="card-header text-center">
                        <i class="fa fa-envelope fa-3x" style="color: #807e7e"></i>
                    </div>
                    <div class="card-body">
                        <form action="{{route('web.sendEmail')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label style="color: #807e7e" for="exampleInputEmail1">Nome completo</label>
                                <input type="text" class="form-control py-4" name="name" aria-describedby="emailHelp"
                                       placeholder="Nome completo">
                            </div>
                            <div class="form-group">
                                <label style="color: #807e7e" for="email">Email</label>
                                <input type="email" class="form-control py-4" name="email" aria-describedby="emailHelp"
                                       placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label style="color: #807e7e" for="cell">Telefone</label>
                                <input type="number" class="form-control py-4" name="cell" aria-describedby="emailHelp"
                                       placeholder="Celular">
                            </div>
                            <div class="form-group">
                                <label style="color: #807e7e" for="message">Sua mensagem</label>
                                <textarea name="message" class="form-control" id="message" aria-describedby="emailHelp"
                                          placeholder="Mensagem">Olá, preciso de mais informações sobre o imóvel.</textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg col-12" style="border: 0; background-color: #807e7e">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contacts">
        <div class="contactd-colum d-flex">
            <div class="email col-lg-4 d-flex text-center flex-column">
                <h2><i class="fa fa-envelope"></i> E-mail</h2>
                <p>Nossa equipe irá entrar contato em breve</p>
                <small>imobiliariasuporte@gmail.com</small>
            </div>
            <div class="phone col-lg-4 d-flex text-center flex-column">
                <h2><i class="fa fa-phone"></i> Telefone</h2>
                <p>Nossa equipe está 24h por dia pronta para lhes atender</p>
                <small>(88) 99999-9999</small>
            </div>
            <div class="media col-lg-4 d-flex text-center flex-column align-items-center">
                <h2><i class="fa fa-share-alt"></i> Redes Sociais</h2>
                <p>Ou se preferir entre em contato pelas nossas redes</p>
                <small>
                    <a href=""><i class="fab fa-facebook-f mr-3"></i></a>
                    <a href=""><i class="fab fa-instagram mr-3"></i></a>
                    <a href=""><i class="fab fa-whatsapp"></i></a>
                </small>
            </div>
        </div>
    </section>
@endsection
