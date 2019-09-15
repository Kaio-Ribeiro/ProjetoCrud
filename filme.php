<?php
    require_once __DIR__ . "/App/autoload.php";
    use App\Read\Visualizar;
    use App\Delete\Excluir;
    use App\Edit\Editar;
    use App\Create\Criar;

    if(isset($_POST["criar"]) && !empty($_POST["criar"])){
        unset($_POST["criar"]);
        $criar = new Criar("filme", $_POST);
        $x = $criar->criar();
        echo $criar;
    }

    if(isset($_POST["editar"]) && !empty($_POST["editar"])){
        unset($_POST["editar"]);
        $editar = new Editar("filme", $_POST, $_POST["filme_id"]);
        $tab = $editar->editar();
        echo $editar;
    }

    if(isset($_POST["excluir"]) && !empty($_POST["excluir"])){
        $apagar = new Excluir("filme", $_POST["excluir"]);
        $table = $apagar->excluir();
        echo $apagar;
    }

    $lista = new Visualizar("filme");
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
                <h3>Tabela Filme</h3>
                <form method="POST" action="formCriar.php">
                    <button>Criar Novo +</button>
                    <input name="criar" type="hidden" value="filme">
                </form>
            </caption>
            <thead>
                <tr>
                    <th>Filme_Id</th>
                    <th>Titulo</th>
                    <th>Descricao</th>
                    <th>Ano_de_Lancamento</th>
                    <th>Idioma_Id</th>
                    <th>Idioma_Original_Id</th>
                    <th>Duracao_da_Locacao</th>
                    <th>Preco_da_Locacao</th>
                    <th>Duracao_do_Filme</th>
                    <th>Custo_de_Substituicao</th>
                    <th>Classificacao</th>
                    <th>Recursos_Especiais</th>
                    <th>Ultima_Atualizacao</th>
                    <th>Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($tabela as $valor) {
                ?>
                    <tr>
                        <td><?= $valor["filme_id"]?></td>
                        <td><?= $valor["titulo"]?></td>
                        <td><?= $valor["descricao"]?></td>
                        <td><?= $valor["ano_de_lancamento"]?></td>
                        <td><?= $valor["idioma_id"]?></td>
                        <td><?= $valor["idioma_original_id"]?></td>
                        <td><?= $valor["duracao_da_locacao"]?></td>
                        <td><?= $valor["preco_da_locacao"]?></td>
                        <td><?= $valor["duracao_do_filme"]?></td>
                        <td><?= $valor["custo_de_substituicao"]?></td>
                        <td><?= $valor["classificacao"]?></td>
                        <td><?= $valor["recursos_especiais"]?></td>
                        <td><?= $valor["ultima_atualizacao"]?></td>
                        <td>
                            <form method="POST" action="formEditar.php">
                                <button type="submit">Editar</button>
                                <input name="editar_id" type="hidden" value="<?= $valor["filme_id"]?>">
                                <input name="editar_nome" type="hidden" value="<?= "filme"?>">
                            </form>
                            <form method="POST" action="filme.php">
                                <button type="submit">Excluir</button>
                                <input name="excluir" type="hidden" value="<?= $valor["filme_id"]?>">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </body>
</html>