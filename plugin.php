<?php
	//Obtener el root del proyecto
	$docRoot = glob($_SERVER['DOCUMENT_ROOT']);
	#libreria de las funciones de wordpress para los metadatos etc.
	include('Unidades.php');
	#el domino del host
	$_SERVER[ 'HTTP_HOST' ] = 'localhost';
	#ubicacion del wp-load.php para accesar a la base de datos con el $wpdb
	$wp_load_loc = $docRoot[0].'/wp-load.php';
	#lo agrega como libreria
	require_once($wp_load_loc);

	if($_POST['doc']!=""){
		$file = $_POST['doc'];
		$file_handle = @fopen($file, 'r');
		
		$file = file_get_contents($file);
		//echo file_get_contents($resource_1);
		if($file_handle){
			$line_of_text = explode( "\n", $file );
			$i=0;
			$id_prods = array();
			$cant_prods = array();
			$uni_prods = array();
			$nom_prods = array();
			
			while($i<count($line_of_text)){
				$unidad = unidades($line_of_text[$i]);
				$line = $line_of_text[$i];
				$temp = explode('|',$line);
				if($unidad != 'sinunidad')	{
					$temp = explode('|',$line);
					$cantidad = $temp[count($temp)-8];
					$id = $temp[1];
					array_push($id_prods, $id);
					array_push($cant_prods, intval($cantidad));
					array_push($uni_prods, $unidad);
					array_push($nom_prods, $temp[3]);	
				}
				$i++;
			}
			//Variables de las listas final
			$final_sum = array();
			$final_id = array();
			$final_uni = array();
			$final_prods = array();
			for($i = 0; $i<count($id_prods); $i++){
				if(encontrarEnArray($id_prods[$i], $final_id)==false){
					$cont = $cant_prods[$i];
					for($j = ($i+1); $j<count($id_prods); $j++){
						if($id_prods[$i] == $id_prods[$j]){
							$cont = $cont + $cant_prods[$j];
						}	
					}
					//Agrega un producto no repetido a la lista final
    				array_push($final_id, $id_prods[$i]);
					array_push($final_sum, $cont);
					array_push($final_uni, $uni_prods[$i]);
					array_push($final_prods, $nom_prods[$i]);
				}
			}
			$msj = array();
			$ids = array();
			
			//For para hacer el update del metadata
			for($x = 0; $x<count($final_id); $x++){
				
				$post_id = get_post_id_by_meta_key_and_value('_sku', $final_id[$x]);
				update_post_meta( $post_id, '_stock', $final_sum[$x]);
				
				if($post_id == null){
					array_push($msj,false);
					//array_push($ids, );
				} else{
					array_push($msj,true);
					//array_push($ids, );
				}
			}//Fin del for para el metadata
			
		}//Fin de la condicion del file_handle
		fclose($file_handle);
		echo json_encode(array('success'=>true, 'valores'=>$msj, 'ids'=>$final_id, 'productos'=>$final_prods, 'stock'=>$final_sum));
	}else{
		echo json_encode(array('success'=>false));
	}
?>	