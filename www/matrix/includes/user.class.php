<?php

	class User extends Dbh {

		protected function getAllUsers(){
			
			$sql = "SELECT * FROM contas";
			$results = $this->connect()->query($sql);
			$numRows = $results->num_rows;
			if($numRows > 0){
				while ($row = $results->fetch_assoc()){
					$data[] = $row;
				}
				return $data;
			}
		}



	}

?>