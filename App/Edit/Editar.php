<?php
    namespace App\Edit;

    use DB\Conexao as DB;

    class Editar{
        private $tabela;
        private $banco;
        private $condicao;
        private $dados;

        public function __construct($nomeTabela, array $dados, $condicao){
            $this->tabela = $nomeTabela;
            $this->banco = DB::getInstance();
            $this->condicao = $condicao;
            $this->dados = $dados;
        }

        public function editar(){
            $pdo = $this->banco;
            foreach ($this->dados as $chave => $valor){
                $campos[] = "{$chave} = '{$valor}'";
            }
            $campos = implode(", ", $campos);
            $sql = "UPDATE {$this->tabela} SET {$campos} WHERE {$this->tabela}_id = {$this->condicao};";
            $consulta = $pdo->prepare($sql);
            $resultado = $consulta->execute();

            if ($resultado){
                return "Tabela editada.<br>";
            }
            return "Erro ao editar tabela.<br>";
        }

        public function __toString() {
            return $this->editar();
        }
    }


?>