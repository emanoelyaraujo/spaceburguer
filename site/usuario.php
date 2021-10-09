<?php

require_once 'modelUsuario.php';    

$model = new Usuario();            

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo) {

    // case 'signIn' :

    //     // super usário
        
    //     $superUser = $model->criaSuperUser();

    //     if ($superUser > 0) {          // 1=Falhou criação do super user; 2=sucesso na criação do super user
    //         Redirect::page("login");
    //     }

    //     // Buscar usuário na base de dados

    //     $aUsuario = $model->getUserEmail($post['email']);

    //     if (count($aUsuario) > 0 ) {

    //         // validar a senha
            
    //         if (!password_verify(trim($post["senha"]), $aUsuario['senha']) ) {
    //             $_SESSION["msgError"] = 'Usuário e ou senha inválido.';
    //             Redirect::page("login");
    //         }
            
    //         // validar o status do usuário
            
    //         if ($aUsuario['statusRegistro'] == 2 ) {
    //             $_SESSION["msgError"] = "Usuário Inativo, não será possível prosseguir !";
    //             Redirect::page("login");
    //         }

    //         //  Criar flag's de usuário logado no sistema
            
    //         $_SESSION["userCodigo"] = $aUsuario['id'];
    //         $_SESSION["userLogin"]  = $aUsuario['nome'];
    //         $_SESSION["userEmail"]  = $aUsuario['email'];
    //         $_SESSION["userNivel"]  = $aUsuario['nivel'];
    //         $_SESSION["userSenha"]  = $aUsuario['senha'];
            
    //         // Direcionar o usuário para página home
            
    //         Redirect::page("homeAdmin");

    //         //

    //     } else {
    //         $_SESSION['msgError'] = 'Usuário e ou senha inválido.';
    //         Redirect::page("login");
    //     }

    //     break;

    // case 'signOut' :

    //     unset($_SESSION['userCodigo']);
    //     unset($_SESSION['userLogin']);
    //     unset($_SESSION['userEmail']);
    //     unset($_SESSION['userNivel']);
    //     unset($_SESSION['userSenha']);
        
    //     Redirect::Page("home");
    //     break;

    // case 'lista':

    //     $aDados['data'] = $model->getLista("usuario");

    //     require_once "site/admin/listaUsuario.php";

    //     break;

    // case 'form':

    //     if ($acao != 'insert') {
    //         $aDados['data'] = $model->getId("usuario", $id);
    //     }

    //     require_once "site/admin/formUsuario.php";
    //     break;

    // case 'insert':

    //     if ($model->insert($_POST)) {
    //         $_SESSION['msgSucesso'] = 'Registro inserido com sucesso.';
    //     } else {
    //         $_SESSION['msgError'] = 'Falha ao tentar inserir o registro na base de dados.';
    //     }

    //     Redirect::Page("usuario/lista");
    //     break;

    // case 'update':

    //     if ($model->update($_POST)) {
    //         $_SESSION['msgSucesso'] = 'Registro atualizado com sucesso.';
    //     } else {
    //         $_SESSION['msgError'] = 'Falha ao tentar atualizar o registro na base de dados.';
    //     }

    //     Redirect::Page("usuario/lista");
    //     break;

    // case 'delete':

    //     if ($model->delete($_POST['id'])) {
    //         $_SESSION['msgSucesso'] = 'Registro excluído com sucesso.';
    //     } else {
    //         $_SESSION['msgError'] = 'Falha ao tentar excluir o registro na base de dados.';
    //     }

    //     Redirect::Page("usuario/lista");
    //     break;
}