<section class="mail d-flex justify-content-center">
    <div class="col-lg-6">
        <h2>Quer receber notícias e ficar por dentro das novidades?</h2>
        <p>Deixe o seu nome e seu melhor e-mail nos campos abaixo e nós vamos lhe informar sobre os melhores
            negócios e
            todos os lançamentos</p>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="email" placeholder="Nome e sobrenome"
                       value="{{old('name') ?? ''}}">
            </div>
            <div class="form-group">
                <label for="email">E-Mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Melhor e-mail"
                       value="{{old('email') ?? ''}}">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success col-6 p-2">Enviar</button>
            </div>
        </form>
    </div>
</section>
