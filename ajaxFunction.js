jQuery(document).ready(function() {
	jQuery('#bAccion').click(function (e) {
    	
    	e.preventDefault();
    	var file = jQuery('#txt').val();
    	jQuery.ajax({
	    	type:"POST",
    		data:{'doc': file },
    		async:false,
    		dataType:"JSON",
    		beforeSend:function(x){
    			console.log(x);
    		},
    		success: function(data, textStatus){  
    			var valor = data.success;
    			var tabla1 = document.getElementById('tbUp');
    			var tabla2 = document.getElementById('tbError');
    			if(valor){
    				document.getElementById('mensaje').style.display = 'block';
    				document.getElementById('mensaje2').className = "updated below-h2";
    				document.getElementById('mensaje2').style.display = 'block';
    				document.getElementById('mensaje2').innerHTML = '<p class="about-description">Archivo correctamente subido.</p>';
    				//document.getElementById('mensaje').innerHTML = document.getElementById('mensaje').innerHTML+'Su documento fue subido de forma correcta<br>';
    				for(i = (data.valores.length-1);i>=0; i--){
    					if(data.valores[i]==true){
    						//document.getElementById('tbUp').innerHTML = document.getElementById('tbUp').innerHTML+data.ids[i]+' '+data.productos[i]+'<br>';
    						var row = tabla1.insertRow(1);
    						var cell0 = row.insertCell(0);
							var cell1 = row.insertCell(1);
							var cell2 = row.insertCell(2);
							var cell3 = row.insertCell(3);
							cell0.innerHTML = '';
							cell1.innerHTML = data.ids[i]+' ';
							cell2.innerHTML = data.productos[i]+' ';
							cell3.innerHTML = data.stock[i]+' ';
    					}else{
    						//document.getElementById('tbError').innerHTML = document.getElementById('tbError').innerHTML+data.ids[i]+' '+data.productos[i]+'<br>';
    						var row = tabla2.insertRow(1);
    						var cell0 = row.insertCell(0);
							var cell1 = row.insertCell(1);
							var cell2 = row.insertCell(2);
							cell0.innerHTML = '';
							cell1.innerHTML = data.ids[i]+'';
							cell2.innerHTML = data.productos[i]+'';
    					}
    					
    				}
    				tabla1.style.width = 'auto';
    				tabla2.style.width = 'auto';
    				document.getElementById('mensaje').style.height = "auto";
    			}else {
    				document.getElementById('mensaje2').className = "updated below-h2";
    				document.getElementById('mensaje2').style.display = 'block';
    				document.getElementById('mensaje2').innerHTML = '<p class="about-description">No ha seleccionado un archivo, o es probable que el documento no cumpla con los requerimientos del sistema.</p>';
    			}
			},
    		url:"../wp-content/plugins/Inventario/plugin.php"
		});
	});		
});