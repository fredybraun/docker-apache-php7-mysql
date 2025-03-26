<?php

	class OrdemServico extends Dbh {

		public function getOs($id_os){
			
			$sql = "SELECT * FROM ordem_serv WHERE id_os = ?";
            $stmt = $this->connect()->prepare($sql);    
            $stmt->execute([$id_os]);
            
            $dados_os = $stmt->fetchAll();

            return $dados_os;
		}

	}

?>