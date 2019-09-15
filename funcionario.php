<?php
    require_once __DIR__ . "/App/autoload.php";
    use App\Read\Visualizar;
    use App\Delete\Excluir;
    use App\Edit\Editar;
    use App\Create\Criar;

    if(isset($_POST["criar"]) && !empty($_POST["criar"])){
        unset($_POST["criar"]);
        $criar = new Criar("funcionario", $_POST);
        $x = $criar->criar();
        echo $criar;
    }

    if(isset($_POST["editar"]) && !empty($_POST["editar"])){
        unset($_POST["editar"]);
        $editar = new Editar("funcionario", $_POST, $_POST["funcionario_id"]);
        $tab = $editar->editar();
        echo $editar;
    }

    if(isset($_POST["excluir"]) && !empty($_POST["excluir"])){
        $apagar = new Excluir("funcionario", $_POST["excluir"]);
        $table = $apagar->excluir();
        echo $apagar;
    }

    $lista = new Visualizar("funcionario");
    $tabela = $lista->buscar(1);
?>

<html>
    <head>
        <style>
            table{
                margin: 0 auto;
                border: solid 1px;
            }
            tr, th{
                border: solid 1px;
                height:50px;
                width: 100px;
            }
            td{
                border: solid 1px;
                height:50px;
                width: 100px;
                text-align: center;
            }
            caption button{
                height:30px;
                width: 100px;
                float: right;
            }

        </style>
    </head>
    <body>
        <table>
            <caption>
                <h3>Tabela Endereço</h3>
                <form method="POST" action="formCriar.php">
                    <button>Criar Novo +</button>
                    <input name="criar" type="hidden" value="funcionario">
                </form>
            </caption>
            <thead>
                <tr>
                    <th>Funcionario_Id</th>
                    <th>Primeiro_Nome</th>
                    <th>Ultimo_Nome</th>
                    <th>Endereco_Id</th>
                    <th>Foto</th>
                    <th>Email</th>
                    <th>Loja_Id</th>
                    <th>Senha</th>
                    <th>Usuario</th>
                    <th>Senha</th>
                    <th>Ultima_Atualizacao</th>
                    <th>Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($tabela as $valor) {
                ?>
                    <tr>
                        <td><?= $valor["funcionario_id"]?></td>
                        <td><?= $valor["primeiro_nome"]?></td>
                        <td><?= $valor["ultimo_nome"]?></td>
                        <td><?= $valor["endereco_id"]?></td>
                        <td><?= $valor["foto"]?></td>
                        <td><?= $valor["email"]?></td>
                        <td><?= $valor["loja_id"]?></td>
                        <td><?= $valor["ativo"]?></td>
                        <td><?= $valor["usuario"]?></td>
                        <td><?= $valor["senha"]?></td>
                        <td><?= $valor["ultima_atualizacao"]?></td>
                        <td>
                            <form method="POST" action="formEditar.php">
                                <button type="submit">Editar</button>
                                <input name="editar_id" type="hidden" value="<?= $valor["funcionario_id"]?>">
                                <input name="editar_nome" type="hidden" value="<?= "funcionario"?>">
                            </form>
                            <form method="POST" action="funcionario.php">
                                <button type="submit">Excluir</button>
                                <input name="excluir" type="hidden" value="<?= $valor["funcionario_id"]?>">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </body>
</html>