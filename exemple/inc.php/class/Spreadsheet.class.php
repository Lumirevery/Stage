<?php
    class Spreadsheet{
        private $header = Array();
        private $identifier = Array();
        private $row = Array();
        private $column = Array();
        private $cells = Array();
        private $bddtable = "step2";
        private $bddbase = "step1";

        public function __construct($file){
            $this->headerSet($file);
            $this->dataSet($file, $this->header);
            $this->idSet($this->cells);
            $this->rowSet($this->identifier, $this->header, $this->cells);
            $this->colSet($this->header, $this->identifier, $this->cells);
        }

        public function headerSet($file){
			$filehead = array_shift($file);
            for($j=0;$j<count($filehead);$j++){
                $this->header[$j] = new Header($filehead[$j], $j);
            }
        }
        public function setHeader(){
            $this->header = $header;
        }
        public function getHeader(){
            return $this->header;
        }

        public function dataSet($file, $header){
            $row=0;
            for($j=0;$j<count($header);$j++){
                $this->cells[$j] = Array();
            }
            foreach ($file as $col) {
                for($j=0;$j<count($header);$j++){
                    $this->cells[$j][$row] = new Cell($col[$j], $row, $j);
                }
                $row++;
            }
        }
        public function setCell(){
            $this->header = $header;
        }
        public function getCell(){
            return $this->cells;
        }

        public function idSet($cells){
            for($j=0;$j<count($cells[0]);$j++){
                $this->identifier[$j] = new Identifier($cells[0][$j], $j);
            }
        }
        public function setId(){
            $this->header = $header;
        }
        public function getId(){
            return $this->identifier;
        }

        public function rowSet($identifier, $header, $cells){
            for($j=0;$j<count($identifier);$j++){
                for($i=0;$i<count($header);$i++){
                    $tempcells[$j] = $cells[$i][$j];
                }
                $this->row[$j] = new Row($identifier[$j], $j, $tempcells);
            }
        }
        public function setRow(){
            $this->header = $header;
        }
        public function getRow(){
            return $this->row;
        }

        public function colSet($header, $identifier, $cells){
            for($j=0;$j<count($header);$j++){
                for($i=0;$i<count($identifier);$i++){
                    $tempcells[$j] = $cells[$j][$i];
                }
                $this->column[$j] = new Column($header[$j]->getValue(), $j, $tempcells);
            }
        }
        public function setCol(){
            $this->header = $header;
        }
        public function getCol(){
            return $this->column;
        }

        public function setBdTab($bddtable){
            $this->bddtable = $bddtable;
        }
        public function getBdTab(){
            return $this->bddtable;
        }

        public function setBdB($bddbase){
            $this->bddbase = $bddbase;
        }
        public function getBdB(){
            return $this->bddbase;
        }

        public function createTable($pdo){
            $query = 'CREATE TABLE IF NOT EXISTS '.$this->bddtable.' LIKE '.$this->bddbase.';';
            $pdo->exec($query);
        }
        public function addData($file, $pdo){
            
			$infotable = $pdo->prepare('SELECT * FROM INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = "step2";');
			$infotable->execute();
			while($infos = $infotable->fetch(PDO::FETCH_ASSOC)){
				$column[$i] = $infos["COLUMN_NAME"];
				$coltype[$i] = $infos["COLUMN_TYPE"];
				$charlength[$column[$i]] = $infos["CHARACTER_MAXIMUM_LENGTH"];
				$i++;
			}
			
			if(count($header) >= count($column)){
				$rightcol = Array();
				for($i=0;$i<count($column);$i++){
					
					if($header[$i] != $column[$i]){
						$matching = 50;
						$overflow = 0;
							$type[$i] = preg_replace("/[^A-Za-z]/", "", $coltype[$i]);
							$len[$i] = $string = preg_replace("/[^0-9]/", "", $coltype[$i]);
						for($k=0;$k<count($header);$k++){
							$datatype[$k] = "";
							$datalength[$k] = 0;
							for($j=0;$j<$row;$j++){
								$occupied = false;
								if(!empty($array[$nbcol[$k]][$j])){
									$datatype[$k] = datatype($array[$nbcol[$k]][$j], $datatype[$k], $datalength[$k]);
									$datalength[$k] = datalength($array[$nbcol[$k]][$j], $datatype[$k], $datalength[$k]);
								}
							}
							
				
							if($datatype[$k] == $type[$i]){
								similar_text($header[$k], $column[$i], $perc);
								if($matching < $perc){
									for($r=0;$r<count($header);$r++){
										if(isset($rightcol[$r]) && $rightcol[$r] == $k){
											$occupied = true;
										}
									}
									
									if($occupied == false){
										$rightcol[$i] = $k;
										$matching = $perc;
									}
						
								}
							}
						}
						
					}else{
						$rightcol[$i] = $i;
					}
				}
				for($i=0;$i<count($header);$i++){
					if(isset($rightcol[$i])){
						$header[$rightcol[$i]] = $column[$i];
					}else{
						$overflow++;
						$rightcol[$i] = count($column)-1 + $overflow;
						for($k=count($column);$k<count($header);$k++){
							$datatype[$k] = "";
							$datalength[$k] = 0;
							for($l=0;$l<$row;$l++){
								if(!empty($array[$nbcol[$i]][$l])){
									$datatype[$k] = datatype($array[$nbcol[$i]][$l], $datatype[$k], $datalength[$k]);
									$datalength[$k] = datalength($array[$nbcol[$i]][$l], $datatype[$k], $datalength[$k]);
								}
							}
                            $req = $pdo->prepare('ALTER TABLE step2 ADD '.$header[$k].' '.$datatype[$k].' ('.$datalength[$k].');');
                            $req->execute();
						}
						$column[$i] = $header[$rightcol[$i]];
					}
					
				}
				
				
                $infotable = $pdo->prepare('SELECT * FROM INFORMATION_SCHEMA.COLUMNS where TABLE_NAME = "step2";');
                $infotable->execute();
				while($infos = $infotable->fetch(PDO::FETCH_ASSOC)){
                    //print_r($infos);
					$coltype[$i] = $infos["COLUMN_TYPE"];
					$charlength[$column[$i]] = $infos["CHARACTER_MAXIMUM_LENGTH"];
					$i++;					
				}
			}else if(count($header) <= count($column)){
				
				$rightcol = Array();
				for($i=0;$i<count($header);$i++){
					if($header[$i] != $column[$i]){
						$matching = 0;
						for($k=0;$k<count($column);$k++){
							$type[$k] = preg_replace("/[^A-Za-z]/", "", $coltype[$k]);
							$len[$k] = $string = preg_replace("/[^0-9]/", "", $coltype[$k]);
							$datatype[$i] = "";
							$datalength[$i] = 0;
							for($j=0;$j<$row;$j++){
									$occupied = false;
								
								if(!empty($array[$nbcol[$i]][$j])){
									$datatype[$i] = datatype($array[$nbcol[$i]][$j], $datatype[$i], $datalength[$i]);
									$datalength[$i] = datalength($array[$nbcol[$i]][$j], $datatype[$i], $datalength[$i]);
								}
							}
							if($datatype[$i] == $type[$k]){
								similar_text($header[$i], $column[$k], $perc);
								if($matching < $perc){
									for($r=0;$r<count($header);$r++){
										if(isset($rightcol[$r]) && $rightcol[$r] == $k){
							
											$occupied = true;
										}
										
									}
									
									if($occupied == false){
										$rightcol[$i] = $k;
										
										$matching = $perc;
									}
						
								}
							}
							
							
						}
						if(isset($rightcol[$i])){
							$header[$i] = $column[$rightcol[$i]];
						}
					}
				}				
			}
			
			for($j=0;$j<$row;$j++){
				$querydata[$j] = "INSERT INTO step2 (";
				for($i=0;$i<count($header);$i++){
					if($header[$i] != ""){
						$querydata[$j] .= $header[$i].", ";
					}else{
						$querydata[$j] .= "colonne".$i.", ";						
					}
				}
				$querydata[$j][strlen($querydata[$j])-2] = " ";
				$querydata[$j][strlen($querydata[$j])-1] = " ";
				$querydata[$j] = rtrim($querydata[$j]);
				$querydata[$j] .= ") VALUES (";
				for($i=0;$i<count($header);$i++){
					$type[$i] = preg_replace("/[^A-Za-z]/", "", $coltype[$rightcol[$i]]);
					$len[$i] = $string = preg_replace("/[^0-9]/", "", $coltype[$rightcol[$i]]);
					$datatype[$i] = datatype($array[$nbcol[$i]][$j], $type[$i], $len[$i]);
					$datalength[$i] = datalength($array[$nbcol[$i]][$j], $type[$i], $len[$i]);
					if($datatype[$i] == "date"){
						$array[$nbcol[$i]][$j] = date_format(date_create_from_format($datalength[$i], $array[$nbcol[$i]][$j]), "Y-m-d");
					}
					if(!empty($charlength[$header[$i]]) && $datalength[$i] > $charlength[$header[$i]]){
                        $req = $pdo->prepare('ALTER TABLE step2 MODIFY '.$header[$i].' '.$datatype[$i].' ('.$datalength[$i].');');
                        $req->execute();
					}
				}
				for($i=0;$i<count($header);$i++){
					if($datatype[$i] == "boolean"){
						$array[$nbcol[$i]][$j] = str_replace("oui", "1", $array[$nbcol[$i]][$j]);	
						$array[$nbcol[$i]][$j] = str_replace("non", "0", $array[$nbcol[$i]][$j]);	
						if(empty($array[$nbcol[$i]][$j])){
							$array[$nbcol[$i]][$j] = "0";
						}
					}
					if($datatype[$i] == "date"){
						if(!empty($array[$nbcol[$i]][$j])){
							$querydata[$j] .= "'".$array[$nbcol[$i]][$j]."', ";	
						}
					}else{
						if(!empty($array[$nbcol[$i]][$j])){
							$querydata[$j] .= "'".$array[$nbcol[$i]][$j]."', ";	
						}else{
							$querydata[$j] .= "NULL, ";
						}
					}
				}
				$querydata[$j] .= ");";
				for($i=1;$i<=3;$i++){
					$querydata[$j][strlen($querydata[$j])-$i] = " ";
				}
				$querydata[$j][strlen($querydata[$j])-3] = ";";
				$querydata[$j][strlen($querydata[$j])-4] = ")";
				
				$identifier = $header[0];
				$idvalue = $array[$nbcol[0]][$j];
				$simi = similar_text($header[0], $header[0]);
				for($i=0;$i<count($header);$i++){
					if(similar_text($header[$i], $header[0] > $simi)){
						$simi = similar_text($header[$i], $header[0]);
						$identifier = $header[$i];
						$idvalue = $array[$nbcol[$i]][$j];
					}
				}
				echo $querydata[$j];
                $req = $pdo->prepare($querydata[$j]);
                $req->execute();
			}
            echo $querydata[0];
        }
    }
?>