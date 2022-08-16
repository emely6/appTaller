<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM parcels where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
if($to_branch_id > 0 || $from_branch_id > 0){
	$to_branch_id = $to_branch_id  > 0 ? $to_branch_id  : '-1';
	$from_branch_id = $from_branch_id  > 0 ? $from_branch_id  : '-1';
$branch = array();
 $branches = $conn->query("SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id in ($to_branch_id,$from_branch_id)");
    while($row = $branches->fetch_assoc()):
    	$branch[$row['id']] = $row['address'];
	endwhile;
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="callout callout-info">
					<dl>
						<dt>Numero de referencia:</dt>
						<dd> <h4><b><?php echo $reference_number ?></b></h4></dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Informacion Mecanico</b>
					<dl>
						<dt>Nombre:</dt>
						<dd><?php echo ucwords($sender_name) ?></dd>
						<dt>Detalle de reparacion a realizar</dt>
						<dd><?php echo ucwords($sender_address) ?></dd>
						<dt>No. Telefono:</dt>
						<dd><?php echo ucwords($sender_contact) ?></dd>
					</dl>
				</div>
				<div class="callout callout-info">
					<b class="border-bottom border-primary">Informacion del Cliente</b>
					<dl>
						<dt>Nombre:</dt>
						<dd><?php echo ucwords($recipient_name) ?></dd>
						<dt>Direccion:</dt>
						<dd><?php echo ucwords($recipient_address) ?></dd>
						<dt>Numero de telefono:</dt>
						<dd><?php echo ucwords($recipient_contact) ?></dd>
					</dl>
				</div>
			</div>
	
						<dt>Estado:</dt>
						<dd>
							<?php 
							switch ($status) {
								case '1':
									echo "<span class='badge badge-pill badge-info'> Ingreso al taller mecanico</span>";
									break;
								case '2':
									echo "<span class='badge badge-pill badge-info'> Asignado a mecanico</span>";
									break;
								case '3':
									echo "<span class='badge badge-pill badge-primary'> En reparacion </span>";
									break;
								case '4':
									echo "<span class='badge badge-pill badge-primary'> Cambio de Repuesto</span>";
									break;
								case '5':
									echo "<span class='badge badge-pill badge-primary'> Terminado</span>";
									break;
								case '6':
									echo "<span class='badge badge-pill badge-primary'> Entregado</span>";
									break;
							}

							?>
							<span class="btn badge badge-primary bg-gradient-primary" id='update_status'><i class="fa fa-edit"></i> Actualizar Estado </span>
						</dd>

					</dl>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>
<noscript>
	<style>
		table.table{
			width:100%;
			border-collapse: collapse;
		}
		table.table tr,table.table th, table.table td{
			border:1px solid;
		}
		.text-cnter{
			text-align: center;
		}
	</style>
	<h3 class="text-center"><b>Student Result</b></h3>
</noscript>
<script>
	$('#update_status').click(function(){
		uni_modal("Actualizar Estado: <?php echo $reference_number ?>","manage_parcel_status.php?id=<?php echo $id ?>&cs=<?php echo $status ?>","")
	})
</script>