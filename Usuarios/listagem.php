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
        <center>
            <h2>LISTAGEM - ARRAY PHP</h2>
        </center>
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

<?php
            echo "<div class='row justify-content-center mb-3 row-cols-2 row-cols-md3 text-center'>";
                echo "<div class='col-md-8'>";
                    echo "<div class='card mb-4 rounded-3 shadow-sw'>";
                        echo "<div class='card-header py-3'>";
                        echo "<h4 class='my-0 fw-normal'><b>LISTAGEM DE USUÁRIOS</b></h4>
                        <br>
                            <div class='pesquisarUsuario'>
                                <div class='formProcurar'>
                                    <form action='listagem.php' method='POST' style='display: flex; gap: 10px; align-items: center;'>
                                        <input class='form-control' type='text' name='pesquisar' placeholder='Insira o nome do usuário que deseja encontrar' value='" . (isset($_POST['pesquisar']) ? htmlspecialchars($_POST['pesquisar']) : "") . "' />
                                        <input type='submit' class='btn btn-success' value='BUSCAR'/>
                                        ";
                                        if ( isset($_POST['pesquisar']) && $_POST['pesquisar'] !== "" && !isset($_POST['limpar'])) {
                                            echo "<button type='submit' name='limpar' value='1' class='btn btn-secondary' title='Limpar pesquisa' style='font-weight:bold;'>X</button>";
                                        }
                                    echo "
                                    </form>
                                </div>
                            </div>
                            ";
                            echo "<br>";
                            echo "<h4 class='ordenarh4' style='float:left;'>ORDENAR USUÁRIOS </h4>";
                            echo "<form method='GET' action='listagem.php' style='display: flex; gap: 10px; align-items: center;'>";
                                echo "&nbsp;<select class='form-select' name='ordenar' style='width: auto;'>";
                                    echo "<option value=''>Selecione</option>";
                                    echo "<option value='nome'>Por Nome</option>";
                                    echo "<option value='email'>Por E-mail</option>";
                                    echo "<option value='genero'>Por Gênero</option>";
                                echo "</select>";
                                echo "<input type='submit' class='btn btn-primary' value='Ordenar'/>";
                            echo "</form>";
                            echo "<br>";
                            echo "<table class='table table-hover'>";
                                echo "<tr>
                                    <th>ID</th>
                                    <th>NOME</th>
                                    <th>E-MAIL</th>
                                    <th>GENERO</th>
                                    <th>AÇÕES</th>
                                </tr>";
                               $email = $_SESSION['emails'];
                               $nome = $_SESSION['nomes'];
                               $genero = $_SESSION['generos'];                                
                               $senha = $_SESSION['senhas'];
                               $contagem = count($email);

                                $usuarios = [];
                                $usuariosFiltrados = [];
                                for ($i = 0; $i < $contagem; $i++) {
                                    $usuariosFiltrados[] = [
                                        'id' => $i,
                                        'nome' => $nome[$i],
                                        'email' => $email[$i],
                                        'genero' => $genero[$i],
                                        'senha' => $senha[$i]
                                    ];
                                }
                                if (isset($_POST['limpar'])) {
                                    for ($i = 0; $i < $contagem; $i++) {
                                        $usuarios[] = $i;
                                    }
                                } elseif (isset($_POST['pesquisar']) && $_POST['pesquisar'] !== "") {
                                    $pesquisar = $_POST['pesquisar'];
                                    for ($i = 0; $i < $contagem; $i++){
                                           if (stripos($nome[$i], $pesquisar) !== false) {
                                            $usuarios[] = $i;
                                        }
                                    } 
                                } elseif (isset($_GET['ordenar']) && $_GET['ordenar']) {
                                    $ordenar = $_GET['ordenar'];
                                    if ($ordenar == '') {
                                        for ($i = 0; $i < $contagem; $i++) {
                                            $usuarios[] = $i;
                                        }
                                    } elseif ($ordenar == 'nome') {
                                        usort($usuariosFiltrados, function($a, $b) {
                                            return strcmp($a['nome'], $b['nome']);
                                        });
                                    } elseif ($ordenar == 'email'){
                                        usort($usuariosFiltrados, function($a, $b) {
                                            return strcmp($a['email'], $b['email']);
                                        });
                                    } else{
                                        usort($usuariosFiltrados, function($a, $b) {
                                            return strcmp($a['genero'], $b['genero']);
                                        });
                                    }
                                }
                                else{
                                    for ($i = 0; $i < $contagem; $i++) {
                                        $usuarios[] = $i;
                                    }
                                }
                                if ( (isset($_GET['ordenar']) && empty($usuariosFiltrados)) || (!isset($_GET['ordenar']) && empty($usuarios))) {
                                echo "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
                                }elseif (isset($_GET['ordenar']) && !empty($usuariosFiltrados)) {
                                    foreach ($usuariosFiltrados as $usuario) {
                                        $idx = $usuario['id']; 

                                        echo "<tr>";
                                        echo "<td>$idx</td>";
                                        echo "<td>" . htmlspecialchars($usuario['nome']) . "</td>";
                                        echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                                        echo "<td>" . htmlspecialchars($usuario['genero']) . "</td>";
                                        echo "<td>
                                                <a href='#' data-bs-toggle='modal' data-bs-target='#exampleModal$idx'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='blue' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                                    </svg>
                                                </a> |
                                                <a href='excluir.php?pos=$idx'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='red' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                                    </svg>
                                                </a>
                                            </td>";
                                        echo "</tr>";   
                                        echo "
                                        <div class='modal fade' id='exampleModal$idx' tabindex='-1' aria-labelledby='exampleModalLabel$idx' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                <h5 class='modal-title' id='exampleModalLabel$idx'>Editar Usuário</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                <form action='editar.php' method='post'>
                                                    <input type='hidden' name='id' value='$idx'/>
                                                    <input type='hidden' name='emailAntigo' value='" . htmlspecialchars($usuario['email']) . "'/>
                                                    <label class='form-label'>NOME</label>
                                                    <input value='" . htmlspecialchars($usuario['nome']) . "' class='form-control' type='text' name='nome' required/>
                                                    <br/>
                                                    <label class='form-label'>E-MAIL</label>
                                                    <input value='" . htmlspecialchars($usuario['email']) . "' class='form-control' type='email' name='email' required/>
                                                    <br/>
                                                    <label class='form-label'>GENERO</label>
                                                    <select class='form-select' name='genero' required>
                                                        <option " . ($usuario['genero'] == 'Masculino' ? 'selected' : '') . " value='Masculino'>Masculino</option>
                                                        <option " . ($usuario['genero'] == 'Feminino' ? 'selected' : '') . " value='Feminino'>Feminino</option>
                                                        <option " . ($usuario['genero'] == 'Outro' ? 'selected' : '') . " value='Outro'>Outro</option>
                                                    </select>
                                                    <br/>
                                                    <label class='form-label'>SENHA</label>
                                                    <input class='form-control' type='password' name='senha' value='" . htmlspecialchars($usuario['senha']) . "'/>
                                                    <br/>
                                                    <input type='submit' class='btn btn-success' value='SALVAR'/>
                                                </form>
                                                </div>
                                                <div class='modal-footer'>
                                                <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>FECHAR</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>";
                                    }
                                }  else {
                                    for ($i = 0; $i < count($usuarios); $i++) {
                                        $idx = $usuarios[$i];
                                        echo "<tr>";
                                        echo "<td>$idx</td>";
                                        echo "<td>" . htmlspecialchars($nome[$idx]) . "</td>";
                                        echo "<td>" . htmlspecialchars($email[$idx]) . "</td>";
                                        echo "<td>" . htmlspecialchars($genero[$idx]) . "</td>";
                                        echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#exampleModal$idx'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='blue' class='bi bi-pencil-square' viewBox='0 0 16 16'>
        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
        </svg></a> | <a href='excluir.php?pos=$idx'> <svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' fill='red' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                            </svg></td>";
                                        echo "</tr>";
                                        echo "
                                            <div class='modal fade' id='exampleModal$idx' tabindex='-1' aria-labelledby='exampleModalLabel$idx' aria-hidden='true'>
                                                <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                    <h5 class='modal-title' id='exampleModalLabel$idx'>Editar Usuário</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                    <form action='editar.php' method='post'>
                                                        <input type='hidden' name='id' value='$idx'/>
                                                        <input type='hidden' name='emailAntigo' value='" . htmlspecialchars($email[$idx]) . "'/>
                                                        <label class='form-label'>NOME</label>
                                                        <input value='" . htmlspecialchars($nome[$idx]) . "' class='form-control' type='text' name='nome' required/>
                                                        <br/>
                                                        <label class='form-label'>E-MAIL</label>
                                                        <input value='" . htmlspecialchars($email[$idx]) . "' class='form-control' type='email' name='email' required/>
                                                        <br/>
                                                        <label class='form-label'>GENERO</label>
                                                        <select class='form-select' name='genero' required>
                                                        <option " . ($genero[$idx] == 'Masculino' ? 'selected' : '') . " value='Masculino'>Masculino</option>
                                                        <option " . ($genero[$idx] == 'Feminino' ? 'selected' : '') . " value='Feminino'>Feminino</option>
                                                        <option " . ($genero[$idx] == 'Outro' ? 'selected' : '') . " value='Outro'>Outro</option>
                                                        </select>
                                                        <br/>
                                                        <label class='form-label'>SENHA</label>
                                                        <input class='form-control' type='password' name='senha' value='" . htmlspecialchars($senha[$idx]) . "'/>
                                                        <br/>
                                                        <input type='submit' class='btn btn-success' value='SALVAR'/>
                                                    </form>
                                                    </div>
                                                    <div class='modal-footer'>
                                                    <button type='button' class='btn btn-danger' data-bs-dismiss='modal'>FECHAR</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>";
                                    }
                                }
                            echo "</table>";
                        echo "</div>"; 
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        ?>
</body>

</html>