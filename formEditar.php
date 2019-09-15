<?php
    
    require_once __DIR__ . "/App/autoload.php";
    
    use App\Read\Selecionar;

    if(isset($_POST["editar_nome"]) && !empty($_POST["editar_nome"]) && isset($_POST["editar_nome"]) && !empty($_POST["editar_id"])){
        $lista = new Selecionar($_POST["editar_nome"], $_POST["editar_id"]);
        $tabela = $lista->selecionar();
        $pag_ini = $_POST["editar_nome"].'.php';
    }
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

        </style>
    </head>
    <body>
        <table>
            <caption><h3>Inserir Dados</h3></caption>
            <thead>
            <tr>
                <?php foreach($tabela as $k => $q){
                        foreach($q as $nome => $valor){ ?>  
                            <th><?= $nome ?></th>      
                <?php   } 
                } ?>
                <th>Funções</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                <form method="POST" action="<?php echo $pag_ini;?>">
                    <?php
                        foreach($tabela as $k => $q){
                            foreach($q as $nome => $valor){ ?>
                            <th><input type="text" value="<?= $valor ?>" name="<?= $nome ?>"></th>
                    <?php } } ?>
                
                    <th>
                        <button type="submit">Confirmar</button>
                        <input type="hidden" name="editar" value="editar">
                    </th>
                    </form>
                </tr>
            </tbody>
        </table>
    </body>
</html>