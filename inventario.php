<?php 
	/*
		Plugin Name: Actualizar Inventario
		Plugin URI: www.eventaiser.com
		Description: Actualiza el numero de productos
		Author: R
		Version: 1
		Author URI: http://themepunch.com
	*/



	add_action('admin_menu','creaMenu');





	function creaMenu(){

		add_menu_page('Inventario','Inventario','manage_options',__FILE__,'adminScreen');
	
	}



	function wp_gear_manager_admin_scripts() {
			wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
	}

	function wp_gear_manager_admin_styles() {
		wp_enqueue_style('thickbox');
	}

	add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
	add_action('admin_print_styles', 'wp_gear_manager_admin_styles');

	function adminScreen(){
	
?>


		<script src="../wp-content/plugins/Inventario/ajaxFunction.js" type="text/javascript"></script>
		<script language="JavaScript">
			jQuery(document).ready(function() {
				jQuery('#upload_image_button').click(function() {
					formfield = jQuery('#upload_image').attr('name');
					tb_show('', 'media-upload.php?type=image&TB_iframe=true');
					return false;
				});

				window.send_to_editor = function(html) {
					imgurl = jQuery(html).attr('href');
					jQuery('#txt').val(imgurl);
					tb_remove();
				}

			});
	
		</script>	
<?
?>
		
	<div class="wrap" style='margin-top:10px;'>
	<div id="icon-tools" class="icon32"><br></div>
	<h2>Control de Inventario</h2>
	<div  class="welcome-panel">
		<div class="control-section" style='display:none; width:auto;' id='mensaje2'>
		</div>
		<br>
		
		<tr><h3 style='margin-left:20px'>Seleccion del Archivo</h3></tr>
		<tr valign="top">
			<td>
			<br>
			<br>
			<form action='../wp-content/plugins/Inventario/plugin.php' method='POST' style='margin-left:50px'>
				
				<label for="upload_image">
				<p class="about-description">Archivo </p>
				<input id="txt" type="text" size="36" name="upload_image" value="<?php echo $gearimage; ?>" />
				<input id="upload_image_button" type="button" value="Añadir archivo" class="button button-primary button-large"/>
				</label>
				<br><br><br>
				<input id='bAccion' type='submit' value='Actualizar' class="button button-primary button-large"/><br>
				<br>
			</form>
			</td>
		</tr>
		<div id='mensaje' class='control-section' style='display:none; width:auto;'>
				<h2>Productos Actualizados</h2>
				<table id='tbUp' class='wp-list-table widefat fixed pages'>
					<th>
						<td>ID</td>
						<td>Nombre</td>
						<td>Stock</td>
						<td></td>
					</th>
				</table>
				<h2>Productos no Actualizados</h2>
				<table id='tbError' class='wp-list-table widefat fixed pages'>
					<th>
						<td>ID</td>
						<td>Nombre</td>
						<td></td>
					</th>
				</table>			
			</div>
			<br>
		<br><br>

	</div>
	</div>
		</head>
		<body>
			
			<!---<table class="wp-list-table widefat fixed pages" cellspacing="0">-->
			
			
			
<?
	}
?>