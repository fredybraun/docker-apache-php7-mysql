<?php

	class Relacao extends Dbh {

		public function getRelacaoItens($idOs){
			
			$sql = "SELECT * FROM relacao_itens WHERE id_os = ?";
            $stmt = $this->connect()->prepare($sql);    
            $stmt->execute([$idOs]);
            
            $dadosRelacao = $stmt->fetchAll();

            return $dadosRelacao;
		}

		public function getRelacaoCobranca($idOs){
			
			$sql = "SELECT * FROM relacao_cobranca WHERE id_os = ?";
            $stmt = $this->connect()->prepare($sql);    
            $stmt->execute([$idOs]);
            
            $dadosRelacaoCobranca = $stmt->fetchAll();

            return $dadosRelacaoCobranca;
		}



	}

?>