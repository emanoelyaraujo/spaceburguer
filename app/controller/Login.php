<?php

require_once 'app/model/ModelUsuario.php';
require_once 'app/model/ModelMinhaConta.php';

$model = new Usuario();
$minhaConta = new MinhaConta();

$post           = $_POST;
$aDados['acao'] = $acao;

switch ($metodo)
{
    case "index":
        require_once "app/view/login.php";

        break;

    case 'login':

        // super usário

        $superUser = $model->criaSuperUser();

        if ($superUser > 0)
        {          // 1=Falhou criação do super user; 2=sucesso na criação do super user
            Redirect::page("Login/index");
        }

        // Buscar usuário na base de dados

        $aUsuario = $model->getUserEmail($post['email']);

        if (count($aUsuario) > 0)
        {

            // validar a senha

            if (!password_verify(trim($post["senha"]), $aUsuario['senha']))
            {
                $_SESSION["msgError"] = 'Usuário e ou senha inválido.';
                Redirect::page("Login/index");
            }

            // validar o status do usuário

            if ($aUsuario['status'] == 2)
            {
                $_SESSION["msgError"] = "Usuário Inativo, não será possível prosseguir !";
                Redirect::page("Login/index");
            }

            //  Criar flag's de usuário logado no sistema

            $_SESSION["userId"] = $aUsuario['id'];
            $_SESSION["userNome"]  = $aUsuario['nome'];
            $_SESSION["userEmail"]  = $aUsuario['email'];
            $_SESSION["userNivel"]  = $aUsuario['nivel'];
            $_SESSION["userSenha"]  = $aUsuario['senha'];
            $_SESSION["userTelefone"]  = $aUsuario['telefone'];
            $_SESSION["userImagem"]  = $aUsuario['imagem'];

            // Direcionar o usuário para página home
            Redirect::page("Home/index");
        }
        else
        {
            $_SESSION['msgError'] = 'E-mail informado não está cadastrado.';
            Redirect::page("Login/cadastrar");
        }

        break;

    case 'register':

        // caso o usuario tenha solicitado a troca de senha, da um unset do código que foi gerado
        unset($_SESSION["codigo"]);
        $aUsuario = $model->getUserEmail($post['email']);

        // verifica se o email informado já existe na base de dados
        if (!empty($aUsuario) && $aUsuario["email"] == $post["email"])
        {
            $_SESSION["msgError"] = "Este e-mail já foi cadastrado";
            Redirect::page("Login/index");
            break;
        }
        else
        {
            $rscUser = $model->insert($post);
        }

        if ($rscUser > 0)
        {
            $_SESSION["msgSucesso"] = "Usuário criado com sucesso!";
            Redirect::page("Login/index");
        }
        else
        {
            $_SESSION["msgError"] = "Falha ao criar usuário";
            Redirect::page("Login/cadastrar");
        }

        break;

    case "cadastrar":
        // caso o usuário deseja se cadastrar, envia essas informações
        $configs = [
            "titulo" => "Entrar com e-mail",
            "view" => "cadastrar"
        ];
        require_once "app/view/verificaEmail.php";
        break;

    case "esqueciMinhaSenha":
        // caso o usuário deseja trocar a senha, envia essas informações
        $configs = [
            "titulo" => "Esqueci minha Senha",
            "view" => "esqueciMinhaSenha"
        ];
        require_once "app/view/verificaEmail.php";
        break;

    case "verificaEmail":
        // verifica se o usuario esta cadastrado no banco
        $user = $model->getUserEmail($post["email"]);
        // gera um código aleatório para a verificação
        $codigo = substr(uniqid(rand()), 0, 6);

        $mail = EnviaEmail::create();
        $mail->setFrom("deliveryspaceburguer@gmail.com", "SpaceBurger");

        // se está cadastrado no banco
        if (!empty($user))
        {
            if ($post["view"] == "esqueciMinhaSenha")
            {
                // salva o código gerado no banco
                $salvaCodigo = $model->updateCodigo($codigo, $user["id"]);

                // se foi salvo, envia o email e seta a view de destino, que é a login
                if ($salvaCodigo)
                {
                    $mail->addAddress($user["email"], $user["nome"]);
                    $mail->Subject = "Alterar Senha";
                    $mail->Body    = EnviaEmail::bodyEnvioEmail($codigo, $user["nome"]);
                    $view = "login";
                }
                else
                {
                    $_SESSION["msgError"] = "Erro. Tente mais tarde.";
                    Redirect::page("Login/email");
                }
            }
            // se a view de destino escolhida foi cadastrar e o usuário ja esta cadastrado
            else
            {
                // se houver a variavel global $SESSION, significa que o usuario esta tentando alterar seu email
                $flag = $_SESSION['userEmail'] == $post['email'];

                // verifica se o e-mail não é igual ao da $SESSION e se está cadastrado no banco
                if (!$flag)
                {
                    $_SESSION["msgError"] = "Usuário já está cadastrado.";
                    Redirect::page(($post['view'] == 'cadastrar') ? "Login/index" : "MinhaConta/index");
                }
                else
                {
                    // se o email informado é o mesmo que esta no cadastro do usuario
                    $_SESSION['msgError'] = "Você já está cadastrado<br>com o e-mail informado.";
                    Redirect::page("MinhaConta/index");
                }
            }
        }
        else
        {
            // verifica em qual view esta
            if ($post["view"] == "cadastrar")
            {
                // seta na sessão o código gerado, envia o email e seta a view de destino, cadastrar
                $_SESSION["codigo"] = $codigo;
                $mail->addAddress($post["email"]);
                $mail->Subject = "Código de Verificação";
                $mail->Body    = EnviaEmail::bodyEnvioEmail($codigo);
                $view = "cadastrar";
            }
            // se a view de destino escolhida foi esqueci minha senha e o usuário não esta cadastrado
            else
            {
                if ($post['view'] == "alteraEmail")
                {
                    // salva o código gerado no banco
                    $salvaCodigo = $model->updateCodigo($codigo, $_SESSION["userId"]);

                    // se foi salvo, envia o email e seta a view de destino, que é a login
                    if ($salvaCodigo)
                    {
                        $mail->addAddress($post['email'], $_SESSION['userNome']);
                        $mail->Subject = "Alterar E-mal";
                        $mail->Body    = EnviaEmail::bodyEnvioEmail($codigo, $_SESSION['userNome']);
                        $view = "alteraEmail";
                    }
                    else
                    {
                        $_SESSION["msgError"] = "Erro. Tente mais tarde.";
                        Redirect::page("MinhaConta/index");
                    }
                }
            }
        }

        EnviaEmail::send($mail);

        // envia o email informado para a view para ser armazenado em um input hidden
        $email["emailUser"] = $post["email"];
        require_once "app/view/verificaCodigo.php";
        break;

    case "verificaCodigo":

        // pega o email, ou da sessão ou o que o usuario informou esqueci minha senha
        $email = (isset($_SESSION['userEmail']) ? $_SESSION['userEmail'] : $post['email']);
        // pega os dados do usuario a partir do e-mail informado, caso ja esteja cadastrado
        $user = $model->getUserEmail($email);
        // caso exista o código na sessão salva ele em uma variável e logo depois da um unset
        $codigo = (isset($_SESSION["codigo"]) ? $_SESSION["codigo"] : "");

        unset($_SESSION["codigo"]);

        /* unset nessa mensagem pois não há necessidade de falar 
        que o email foi enviado pois isso esta escrito na view de inserir o código*/
        unset($_SESSION["msgSucesso"]);

        // se o codigo informado é igual ao que foi gerado 
        if (@$user["codVerificacao"] == $post["codigo"] || $post["codigo"] == $codigo)
        {
            // se o usuario estiver logado
            if (isset($_SESSION['userId']))
            {
                // seta como nulo o campo do banco que estava com o código
                $model->updateCodigo(null, $user['id']);
                $_SESSION['userEmail'] = $post["email"];
                Redirect::page("MinhaConta/alterarEmail");
            }
            // se o código estiver salvo na sessão
            if (!empty($codigo))
            {
                $dados["email"] = $post["email"];
                require_once "app/view/cadastrar.php";
            }
            // se o código estiver salvo no banco
            else
            {
                // seta como nulo o campo do banco que estava com o código
                $model->updateCodigo(null, $user['id']);
                $dados["usuario"] = $user;
                require_once "app/view/formEsqueciSenha.php";
            }
        }

        else
        {
            /* mesmo se o usuario errar o codigo quando 
            estiver esquecido a senha o campo será setado como nulo*/
            if (empty($codigo))
            {
                $model->updateCodigo(null, $user['id']);
            }

            $_SESSION["msgError"] = "Código incorreto!";
            Redirect::page("Login/esqueciMinhaSenha");
        }

        break;

    case "updateSenha":

        // busca os dados do usuário
        $user = $model->getId("usuario", $post["id"]);

        if ($minhaConta->updateSenha($post, $user["id"]))
        {
            $_SESSION['msgSucesso'] = 'Senha atualizada com sucesso.';
        }
        else
        {
            $_SESSION['msgError'] = 'Falha ao tentar atualizar a senha.';
        }

        Redirect::Page("Login/index");

        break;

    case 'logout':

        unset($_SESSION['userId']);
        unset($_SESSION['userNome']);
        unset($_SESSION['userEmail']);
        unset($_SESSION['userNivel']);
        unset($_SESSION['userSenha']);
        unset($_SESSION['userTelefone']);
        unset($_SESSION["userImagem"]);
        unset($_SESSION['pill']);

        Redirect::Page("Home/index");
        break;
}
