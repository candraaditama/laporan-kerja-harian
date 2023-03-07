<?php include_once "encabezado.php" ?>
<?php
include_once "base_de_datos.php";
$sentencia = $base_de_datos->query("SELECT ventas.total, ventas.fecha, ventas.id, GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos FROM ventas INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id INNER JOIN productos ON productos.id = productos_vendidos.id_producto GROUP BY ventas.id ORDER BY ventas.id;");
$ventas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="col-xs-12">

	<div class="page-header">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
					Halaman
				</div>
				<h2 class="page-title">
					Laporan
				</h2>
			</div>
			<div class="col-auto ms-auto">
				<div class="btn-list">
					
					
					<a href="./vender.php" class="btn btn-success">
			<!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-rounded-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<path d="M9 12h6"></path>
				<path d="M12 9v6"></path>
				<path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z"></path>
			</svg>
			Tambah Pelayanan
		</a>
				</div>
			</div>
		</div>
	</div>

	<br>
	<table class="table table-vcenter card-table">
		<thead>
			<tr>
				<th>Nomor</th>
				<th>Tanggal</th>
				<th>Detail Pelayanan</th>
				<th>Total</th>
				<th>Ticket</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ventas as $venta) { ?>
				<tr>
					<td><?php echo $venta->id ?></td>
					<td><?php echo $venta->fecha ?></td>
					<td>
						<table class="table table-bordered border-light">
							<thead>
								<tr>
									<th>Nomor</th>
									<th>Deskripsi</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach (explode("__", $venta->productos) as $productosConcatenados) {
									$producto = explode("..", $productosConcatenados)
								?>
									<tr>
										<td><?php echo $producto[0] ?></td>
										<td><?php echo $producto[1] ?></td>
										<td><?php echo $producto[2] ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</td>
					<td><?php echo $venta->total ?></td>
					<td><a class="btn btn-info" href="<?php echo "imprimirTicket.php?id=" . $venta->id ?>"><i class="fa fa-print"></i></a></td>
					<td><a class="btn btn-danger" href="<?php echo "eliminarVenta.php?id=" . $venta->id ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<?php include_once "pie.php" ?>