<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ;
        $senha = $_POST['senha'] ;
        $nome = $_POST['nome'] ;
        $genero = $_POST['genero'];
        $id = $_POST['id'] ?? '';
        if ($_SESSION['usuario'] === $_SESSION['emails'][$id]){
            $_SESSION['usuario'] = $email;
        }
        $_SESSION['nomes'][$id] = $nome;
        $_SESSION['emails'][$id] = $email;
        $_SESSION['generos'][$id] = $genero;
        $_SESSION['senhas'][$id] = $senha;
        echo "<script>alert('Usuário editado com sucesso!');</script>";
        echo "<script>window.location.href='listagem.php';</script>";
    }

?>