<?php
    namespace App\Delete;

    use DB\Conexao as DB;

    class Excluir{
        private $tabela;
        private $banco;
        private $elemento;

        public function __construct($nomeTabela, $idElemento){
            $this->tabela = $nomeTabela;
            $this->banco = DB::getInstance();
            $this->elemento = $idElemento;

            
        }

        public function excluir(){
            $pdo = $this->banco;
            $sql  = "SET FOREIGN_KEY_CHECKS = 0;";
            $sql .= "DELETE FROM {$this->tabela} WHERE {$this->tabela}_id = {$this->elemento};";
            $sql .= "SET FOREIGN_KEY_CHECKS = 1;";
            $consulta = $pdo->prepare($sql);
            $resultado = $consulta->execute();

            if ($resultado){
                return "Tabela excluída.<br>";
            }
            return "Erro ao excluir tabela.<br>";
        }

        public function __toString() {
            return $this->excluir();
        }
    }


?>