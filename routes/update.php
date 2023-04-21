<?php 

require("../config.php");

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'put'){
	
	parse_str(file_get_contents('php://input'), $input);

	// $id = (!empty($input['id'])) ? $input['id'] : null; //caso abaixo nao funcione, usa assim
	$id = filter_var($input['id'] ?? null); //essa forma assim só funciona do php 7.4 pra lá 
	$title = filter_var($input['title'] ?? null);
	$body = filter_var($input['body'] ?? null);

	if($title && $body && $id){
		$sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$sql = $pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":title", $title);
			$sql->bindValue(":body", $body);
			$sql->execute();

			$array['result'] = [
				'id' => $id,
				'title' => $title,
				'body' => $body
			];
		}else{
			$array['error'] = "Id inexistente";
		}

	}else{
		$array['error'] = 'Campos não enviados';
	}
}else{
	$array['error'] = 'Metódo não permitido';
}


require("../return.php");