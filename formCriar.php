<?php
    require_once __DIR__ . "/App/autoload.php";

    if(isset($_POST["criar"]) && !empty($_POST["criar"])){
        $pag_ini = $_POST["criar"].'.php';
    }

    use App\Read\Visualizar;

    $lista = new Visualizar($_POST["criar"]);
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
                <?php  } 
                break;} ?>
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
                        <?php } break;} ?>
                    
                        <th>
                            <button type="submit">Confirmar</button>
                            <input type="hidden" name="criar"  value="criar">
                        </th>
                    </form>
                </tr>
            </tbody>
        </table>
    </body>
</html>