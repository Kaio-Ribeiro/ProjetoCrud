<?php
    require_once __DIR__ . "/App/autoload.php";
    use App\Read\Visualizar;
    use App\Delete\Excluir;
    use App\Edit\Editar;
    use App\Create\Criar;

    if(isset($_POST["criar"]) && !empty($_POST["criar"])){
        unset($_POST["criar"]);
        $criar = new Criar("inventario", $_POST);
        $x = $criar->criar();
        echo $criar;
    }

    if(isset($_POST["editar"]) && !empty($_POST["editar"])){
        unset($_POST["editar"]);
        $editar = new Editar("inventario", $_POST, $_POST["inventario_id"]);
        $tab = $editar->editar();
        echo $editar;
    }

    if(isset($_POST["excluir"]) && !empty($_POST["excluir"])){
        $apagar = new Excluir("inventario", $_POST["excluir"]);
        $table = $apagar->excluir();
        echo $apagar;
    }

    $lista = new Visualizar("inventario");
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
                <h3>Tabela Aluguel</h3>
                <form method="POST" action="formCriar.php">
                    <button>Criar Novo +</button>
                    <input name="criar" type="hidden" value="inventario">
                </form>
            </caption>
            <thead>
                <tr>
                    <th>Inventario_Id</th>
                    <th>Filme_Id</th>
                    <th>Loja_Id</th>
                    <th>Ultima_Atualização</th>
                    <th>Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($tabela as $valor) {
                ?>
                    <tr>
                        <td><?= $valor["inventario_id"]?></td>
                        <td><?= $valor["filme_id"]?></td>
                        <td><?= $valor["loja_id"]?></td>
                        <td><?= $valor["ultima_atualizacao"]?></td>
                        <td>
                            <form method="POST" action="formEditar.php">
                                <button type="submit">Editar</button>
                                <input name="editar_id" type="hidden" value="<?= $valor["inventario_id"]?>">
                                <input name="editar_nome" type="hidden" value="<?= "inventario"?>">
                            </form>
                            <form method="POST" action="inventario.php">
                                <button type="submit">Excluir</button>
                                <input name="excluir" type="hidden" value="<?= $valor["inventario_id"]?>">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </body>
</html>