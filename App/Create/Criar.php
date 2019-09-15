<?php
    namespace App\Create;

    use DB\Conexao as DB;

    class Criar{
        private $tabela;
        private $banco;
        private $dados;

        public function __construct($nomeTabela, array $dados){
            $this->tabela = $nomeTabela;
            $this->banco = DB::getInstance();
            $this->dados = $dados;
        }

        public function criar(){
            $pdo = $this->banco;
            foreach ($this->dados as $chave => $valor){
                $campos[] = "{$chave}";
                $values[] = "'{$valor}'";
            }
            $campos = implode(", ", $campos);
            $values = implode(", ", $values);
            $sql = "INSERT INTO {$this->tabela} ({$campos}) VALUES({$values});";
            $consulta = $pdo->prepare($sql);
            $resultado = $consulta->execute();

            if ($resultado){
                return "Informações criadas.<br>";
            }
            return "Erro ao criar tabela.<br>";
            var_dump($sql);
        }

        public function __toString() {
            return $this->criar();
        }
    }


?>