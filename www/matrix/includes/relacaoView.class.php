<?php
	class ViewRelacao extends Relacao {

		public function showRelacaoItens($idOs, $dadoTabela){
			
			$dadosRelacaoItens = $this->getRelacaoItens($idOs, $dadoTabela);
			foreach ( $dadosRelacaoItens as $dadosRelacaoItens){
				echo $dadosRelacaoItens[$dadoTabela]."<br>";
			}
		}
	}

?>