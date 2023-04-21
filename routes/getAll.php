<?php 

require("../config.php");

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){
	$sql = $pdo->query("SELECT * FROM notes");
	if($sql->rowCount() > 0){
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $item){
			$array['result'][] = [
				'id' => $item['id'],
				'title' => $item['title'],
				'body' => $item['body'],
				'created_at' => $item['created_at']
			];
		}
	}
}else{
	$array['error'] = 'Metódo não permitido';
}


require("../return.php");