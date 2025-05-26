<?php
    session_start();
    if (!isset($_SESSION['usuario'])){
        header('Location: index.php');
    }
    $emails = $_SESSION['emails'];
    $id = array_search($_SESSION['usuario'], $emails);
    $nomes = $_SESSION['nomes'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-language" content="pt-br">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <title>MENU - PHP ARRAY</title>
    <style>
        body {
            background-color: #4682B4;
            color: white;
            font-family: Calibri
        }

        .logout-btn {
            margin-top: 2rem;
        }

        .user {
            float: right;
        }

        .totalUsuariosBtn {
            color: #000;
        }

        .comunidade {
            padding: 2rem;
        }

        .genero {
            padding: 2rem;
        }
        h2{
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <hr />
        <nav>
            &nbsp;&nbsp;<a href="inicial.php" style="color: white; text-decoration: none">MENU |</a>
            <a href="listagem.php" style="color: white; text-decoration: none">LISTAGEM DE USUÁRIOS |</a>
            <a href="gravar.php" style="color: white; text-decoration: none">SALVAR</a>
            <div class="user">
                <?php echo isset($nomes[$id]) ? $nomes[$id] : 'Usuário'; ?> | <a href="sair.php" style="color: white; text-decoration: none"> SAIR</a>&nbsp;&nbsp;
            </div>
        </nav>
        <br /><br />
        <div class="row justify-content-center mb-3 row-cols-2 row-cols-md3 text-center">
            <div class="col-md-8">
                <div class="card mb-4 rounded-3 shadow-sw">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-floppy2-fill" viewBox="0 0 16 16">
  <path d="M12 2h-2v3h2z"/>
  <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v13A1.5 1.5 0 0 0 1.5 16h13a1.5 1.5 0 0 0 1.5-1.5V2.914a1.5 1.5 0 0 0-.44-1.06L14.147.439A1.5 1.5 0 0 0 13.086 0zM4 6a1 1 0 0 1-1-1V1h10v4a1 1 0 0 1-1 1zM3 9h10a1 1 0 0 1 1 1v5H2v-5a1 1 0 0 1 1-1"/>
</svg>&nbsp;&nbsp;<b>SALVAMENTO DE DADOS</b></h4><br><hr>
                        <div class="card-body">
                            <?php
                                $port = 0;
                                $dados = $_SESSION['nomes'];
                                $conteudo = json_encode($dados, JSON_PRETTY_PRINT);
                                file_put_contents("nome.json", $conteudo);
                                $port = 25;
                                $dados = $_SESSION['emails'];
                                $conteudo = json_encode($dados, JSON_PRETTY_PRINT);
                                file_put_contents("email.json", $conteudo);
                                $port = 50;
                                $dados = $_SESSION['generos'];
                                $conteudo = json_encode($dados, JSON_PRETTY_PRINT);
                                file_put_contents("genero.json", $conteudo);
                                $port = 75;
                                $dados = $_SESSION['senhas'];
                                $conteudo = json_encode($dados, JSON_PRETTY_PRINT);
                                file_put_contents("senha.json", $conteudo);
                                $port = 100;
                                echo "<div class='progress'>";
                                    echo "<div class='progress-bar progress-bar-striped progress-bar-animated' role='progressbar' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100' style='width:$port%'></div>";
                                echo "</div>";
                                if ($port == 100){
                                    echo "<h2 style='margin-top: 10px;'>DADOS GRAVADOS COM SUCESSO!</h2>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>