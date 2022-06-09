<?php
function query($sql){
	$sql = trim($sql);
	//echo $sql;
	global $db;

	$ret = [];

	try {
    	$prep = $db->prepare($sql);
		$prep->execute();

	} catch (PDOException $e) {
        echo $e->getCode()." - ".$e->getMessage();
	}

    //Retornos diferentes conforme a operação.
	$op = strtoupper(strstr(trim($sql)," ",true));
		if($op=="UPDATE"||$op=="DELETE"){
			$ret = $prep->rowCount();
		}elseif($op=="INSERT"){
			$ret = $db->lastInsertId();
		}else{
			//print_r($sql);
			$ret = $prep->fetchAll(PDO::FETCH_ASSOC);
		}		

	return $ret;
	
}