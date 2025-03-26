<?php
	class ViewOs extends OrdemServico {

		public function showOs($idOs, $dadoTabela){
			
			$dadosOs = $this->getOs($idOs, $dadoTabela);
			foreach ( $dadosOs as $dadosOs){
				echo $dadosOs[$dadoTabela]."<br>";
			}
		}



	}

?>