<?php

	class Config{


		public function db_connect() {
			$con = new mysqli('localhost','root','','devscun');
			
			if ($con->connect_errno) {
					echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
			}
					
			/* change character set to utf8 */
			if (!$con->set_charset("utf8")) {
					echo "Error loading character set utf8: %s\n", $con->error;
					exit();
			}
			return $con;
		}


		public function executeQuery($string){
			$res = array();

			if ($string!="") {
				$con = self::db_connect();

					$stmt = $con->query($string);

					if ($stmt) {
						while ($exec = $stmt->fetch_assoc()) {
							$res[] = $exec;
						}
					}
			}
			return $res;
		}

	}

 ?>


