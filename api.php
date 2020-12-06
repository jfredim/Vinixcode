<?php

$curl = curl_init();

$headers = [
	"Content-Type: application/json"
];

	//API URL ( la da el proveedor)
	$url = 'https://petstore.swagger.io/v2/pet';

	//create a new cURL resource
	$ch = curl_init($url);

	$campos_enviados="";
	switch ($proceso) {
		case "crear":
			$categoria = array(
				'id' => $category,
				'name' => $name_cat
			);
		
			$eti= array($etiquetas = array(
				'id' => $tags,
				'name' => $name_tag
			)); 
			
			$photo= array($photourl);  
			//setup request to send json via POST
			$campos_enviados = array(
				'id' => $id,
				'category' => $categoria,
				'name' => $name,
				 'photoUrls' =>$photo,
				'tags' => $eti,
				'status' => $nom_status 
			);	
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
		break;
		case "editar":
			$categoria = array(
				'id' => $category,
				'name' => $name_cat
			);
		
			$eti= array($etiquetas = array(
				'id' => $tags,
				'name' => $name_tag
			)); 
			
			$photo= array($photourl);  
			//setup request to send json via POST
			$campos_enviados = array(
				'id' => $id,
				'category' => $categoria,
				'name' => $name,
				 'photoUrls' =>$photo,
				'tags' => $eti,
				'status' => $nom_status 
			);	
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "PUT");
			break;
		case "busca_estado":
			   $url.="/findByStatus?status=";
			   $url.=$nombre_estados;
			   curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
			break;
		case "busca_id":
				$url.="/$id_buscar";	
				curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "GET");
			break;
		case "editar_parcial":
   			    $campos_enviados ="name=$name&status=$nom_status";	
				$url.="/$id";	
				curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
				$headers = [
					"Content-Type: application/x-www-form-urlencoded"
				];
				
			break;
		case "borrar_id":
			$url.="/$id_borrar";	
			curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "DELETE");
			break;
			}
	

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_ENCODING, "");
    curl_setopt($ch,CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch,CURLOPT_TIMEOUT, 0);
	curl_setopt($ch,CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	if ($campos_enviados){
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($campos_enviados));
	}
	
    curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);


	//attach encoded JSON string to the POST fields


	$resultado = curl_exec($ch);
	$error = curl_error($ch);
	$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	
	switch ($http_status) {
		case 200:
			$respuesta_enviada="";
			$key="";
			$valor="";
	
			$respuesta_enviada=(json_decode($resultado,TRUE,512, JSON_BIGINT_AS_STRING));
				   
			if ($respuesta_enviada) {         
				foreach ($respuesta_enviada as $key => $valor)  { 
					switch ($key) {        	
						case "id":   
							 $id_recibido=($valor);
							 break; 
						case "message":   
							 $id_recibido=($valor);
							 break; 
						}    
				}  	
			}
				break;
		case 400:
			echo  "El ID no fue Encontrado... ";
			  break;
		case 404:
			echo  "Mascota no fue Encontrada... ";
			break;
		case 405:
			echo  "Excepción de validación... ";
			break;
	}
	

	curl_close($ch);
	

?>