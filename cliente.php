<?php
    require_once __DIR__ . "/App/autoload.php";
    use App\Read\Visualizar;
    use App\Delete\Excluir;
    use App\Edit\Editar;
    use App\Create\Criar;

    if(isset($_POST["criar"]) && !empty($_POST["criar"])){
        unset($_POST["criar"]);
        $criar = new Criar("cliente", $_POST);
        $x = $criar->criar();
        echo $criar;
    }

    if(isset($_POST["editar"]) && !empty($_POST["editar"])){
        unset($_POST["editar"]);
        $editar = new Editar("cliente", $_POST, $_POST["cliente_id"]);
        $tab = $editar->editar();
        echo $editar;
    }

    if(isset($_POST["excluir"]) && !empty($_POST["excluir"])){
        $apagar = new Excluir("cliente", $_POST["excluir"]);
        $table = $apagar->excluir();
        echo $apagar;
    }

    $lista = new Visualizar("cliente");
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
                <h3>Tabela Cliente</h3>
                <form method="POST" action="formCriar.php">
                    <button>Criar Novo +</button>
                    <input name="criar" type="hidden" value="cliente">
                </form>
            </caption>
            <thead>
                <tr>
                    <th>Cliente_Id</th>
                    <th>Loja_Id</th>
                    <th>Primeiro_Nome</th>
                    <th>Ultimo_Nome</th>
                    <th>Email</th>
                    <th>Endereco_Id</th>
                    <th>Ativo</th>
                    <th>Data_Criacao</th>
                    <th>Ultima_Atualizacao</th>
                    <th>Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($tabela as $valor) {
                ?>
                    <tr>
                        <td><?= $valor["cliente_id"]?></td>
                        <td><?= $valor["loja_id"]?></td>
                        <td><?= $valor["primeiro_nome"]?></td>
                        <td><?= $valor["ultimo_nome"]?></td>
                        <td><?= $valor["email"]?></td>
                        <td><?= $valor["endereco_id"]?></td>
                        <td><?= $valor["ativo"]?></td>
                        <td><?= $valor["data_criacao"]?></td>
                        <td><?= $valor["ultima_atualizacao"]?></td>
                        <td>
                            <form method="POST" action="formEditar.php">
                                <button type="submit">Editar</button>
                                <input name="editar_id" type="hidden" value="<?= $valor["cliente_id"]?>">
                                <input name="editar_nome" type="hidden" value="<?= "cliente"?>">
                            </form>
                            <form method="POST" action="cliente.php">
                                <button type="submit">Excluir</button>
                                <input name="excluir" type="hidden" value="<?= $valor["cliente_id"]?>">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </body>
</html>