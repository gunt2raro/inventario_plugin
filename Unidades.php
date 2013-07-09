<?php
	function unidades($line_of_text){
		$unidad = 'sinunidad';

		//el otro puto parche .l.
		$line = $line_of_text;
		$temp = explode('|',$line);
		if($temp[count($temp)-6] == 'PZ'){
			$unidad = 'PZ';
		}else if($temp[count($temp)-6] == 'CAJ'){
			$unidad = 'CAJ';
		}else if($temp[count($temp)-6] == 'PAR'){
			$unidad = 'PAR';
		}else if($temp[count($temp)-6] == 'JGO'){
			$unidad = 'JGO';
		}else if($temp[count($temp)-6] == 'ML'){
			$unidad = 'ML';
		}else if($temp[count($temp)-6] == 'KG'){
			$unidad = 'KG';
		}else if($temp[count($temp)-6] == 'NA'){
			$unidad = 'NA';
		}else if($temp[count($temp)-6] == 'M2'){
			$unidad = 'M2';
		}if($temp[count($temp)-6] == 'CTO'){
			$unidad = 'CTO';
		}
		else if($temp[count($temp)-6] == '  '){
			if($temp[1] != ' '){
				if(strpos($line, 'Almacen')==true){
					$unidad = 'sinunidad';
				}else if(strpos($line, 'Unidad utiliz')==true){
					$unidad = 'sinunidad';
				}else{
					$unidad = 'SU';
				}
			} else {
				$unidad = 'sinunidad';
			}
		}
		return $unidad;
	}
	function encontrarEnArray($val, $array){
		for($i = 0; $i<count($array); $i++){
			if($val == $array[$i]){
				return true;
			}
		}return false;
	}
	
	function get_product_by_sku( $sku ) {
  		global $wpdb;
  		$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );
  		if ( $product_id ) return new WC_Product( $product_id );
  		return null;
	}
	
	function get_post_id_by_meta_key_and_value($key, $value) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'");
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$meta = $meta[0];
		}
		if (is_object($meta)) {
			return $meta->post_id;
		}
		else {
			return false;
		}
	}
	function get_mid_by_key( $post_id, $meta_key ) {
  		global $wpdb;
  		$mid = $wpdb->get_var( $wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key) );
  		
  		if( $mid != '' ){
    		return (int)$mid;
 	 	}return false;
	}
	
?>