<!DOCTYPE HTML>
<html lang=pt-br>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bem-vindo a Loucademia!</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="/Loucademia/css/main.css" />
    </head>

    <body>
        <section class="min-vh-100 form-login" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">

                                        <div class="text-center">
                                            <img src="/Loucademia/assets/loucacademia-icon.png" style="width: 150px;" alt="logo">
                                            <h4 class="mt-1 mb-5 pb-1">Bem-vindo a Loucademia</h4>
                                        </div>

                                        <form action="executa_login.php" method="POST" role="form">
                                            <p>Por favor, entre com seu login</p>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="login">Nome de usuário</label>
                                                <input type="text" id="login" class="form-control" name="login" placeholder="Digite seu nome de usuário" required/>
                                            </div>

                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="senha">Senha</label>
                                                <input type="password" id="senha" class="form-control" name="senha" required/>
                                            </div>

                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg btn-cor-primaria mb-3" type="submit">Login</button></br>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex align-items-center bg-radial">
                                    <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                        <h4 class="mb-4">É hora de ficar loucamente saudável</h4>
                                        <p class="small mb-0">Venha cuidar do seu corpo e da sua mente com a gente. A Loucademia tem os melhores profissionais e equipamentos para te ajudar. Venha nos fazer uma visita e veja como podemos te ajudar a cuidar de você!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>