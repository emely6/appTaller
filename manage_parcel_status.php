<div class="container-fluid">
	<form action="" id="update_status">
		<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
		<div class="form-group">
			<label for="">Actualizar Estado</label>
			<?php $status_arr = array("Ingreso al taller","Asignado a mecanico","En reparacion","Cambio de repuesto","Terminado","Entregado"); ?>
			<select name="Estado" id="" class="custom-select custom-select-sm">
				<?php foreach($status_arr as $k => $v): ?>
					<option value="<?php echo $k ?>" <?php echo $_GET['cs'] == $k ? "selected" :'' ?>><?php echo $v; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</form>
</div>

<div class="modal-footer display p-0 m-0">
        <button class="btn btn-primary" form="update_status">Actualizar</button>
        <button type="button" class="btn btn-secondary" onclick="uni_modal('Parcel\'s Details','view_parcel.php?id=<?php echo $_GET['id'] ?>','large')">Cerrar</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<script>
	$('#update_status').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=update_parcel',
			method:'POST',
			data:$(this).serialize(),
			error:(err)=>{
				console.log(err)
				alert_toast('Ocurrio un error',"error")
				end_load()
			},
			success:function(resp){
				if(resp==1){
					alert_toast("Estado Actualizado con exito",'success');
					setTimeout(function(){
						location.reload()
					},750)
				}
			}
		})
	})
</script>