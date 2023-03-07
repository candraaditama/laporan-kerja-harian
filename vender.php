<?php
session_start();
include_once "encabezado.php";
include_once "base_de_datos.php";
if (!isset($_SESSION["carrito"])) $_SESSION["carrito"] = [];
$granTotal = 0;
?>
<div class="col-xs-12">
	<div class="col mb-3">
		<div class="page-pretitle">
			Halaman
		</div>
		<h2 class="page-title">
			Input Laporan
		</h2>
	</div> <?php
			if (isset($_GET["status"])) {
				if ($_GET["status"] === "1") {
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<h3 class="mb-1">Berhasil !</h3>
				<p>Terima kasih, data telah tersimpan</p>
				<div class="btn-list">
					<a href="./ventas.php" class="btn btn-success">Lihat Laporan</a>
					<a href="#" class="btn" data-bs-dismiss="alert" aria-label="close">Tutup</a>
				</div>
				<a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>

			</div>

		<?php
				} else if ($_GET["status"] === "2") {
		?>
			<div class="alert alert-info">
				<strong>Venta cancelada</strong>
			</div>
		<?php
				} else if ($_GET["status"] === "3") {
		?>
			<div class="alert alert-info">
				<strong>Ok</strong> Producto quitado de la lista
			</div>
		<?php
				} else if ($_GET["status"] === "4") {
		?>
			<div class="alert alert-warning">
				<strong>Error:</strong> El producto que buscas no existe
			</div>
		<?php
				} else if ($_GET["status"] === "5") {
		?>
			<div class="alert alert-danger">
				<strong>Error: </strong>El producto está agotado
			</div>
		<?php
				} else {
		?>
			<div class="alert alert-danger">
				<strong>Error:</strong> Algo salió mal mientras se realizaba la venta
			</div>
	<?php
				}
			}
	?>
	<br>
	<form method="post" action="agregarAlCarrito.php">
		<label for="codigo">Pilih Layanan:</label>
		<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
	</form>

	<?php
	$smt = $base_de_datos->prepare('select * from productos where descripcion like "%Tatap Muka%"');
	$smt->execute();
	$data = $smt->fetchAll();
	?>
	<div class="row mt-3">
		<div class="col form-group mb-3 ">
			<label class="form-label">Layanan Tatap Muka</label>
			<form method="post" action="agregarAlCarrito.php">
				<select name="codigo" id="codigo" class="form-select pilih-tatap-muka form-select-lg" onchange="this.form.submit()">
				<option disabled selected>Pilih layanan tatap muka</option>
					<?php foreach ($data as $row) : ?>
						<option value="<?=$row->codigo ?>"><?= $row->descripcion ?></option>
					<?php endforeach ?>
				</select>
			</form>

		</div>
		<?php
		$smt = $base_de_datos->prepare('select * from productos where descripcion like "%Online%"');
		$smt->execute();
		$data = $smt->fetchAll();
		?>
		<div class="col form-group mb-3 ">
			<label class="form-label">Layanan Online/Back Office</label>
			<select name="lst_exam2" id="lst_exam2" class="form-select pilih-tatap-online form-select-lg" onchange="this.form.submit()">
				<?php foreach ($data as $row) : ?>
					<option value="$row->codigo"><?= $row->descripcion ?></option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	<br><br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Descripción</th>
				<th>Precio de venta</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Quitar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION["carrito"] as $indice => $producto) {
				$granTotal += $producto->total;
			?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td>
						<form action="cambiar_cantidad.php" method="post" id="dbJumlah">
							<input name="indice" type="hidden" value="<?php echo $indice; ?>">
							<input min="1" name="cantidad" class="form-control" required type="number" step="1" onChange="this.form.submit();" value="<?php echo $producto->cantidad; ?>">
						</form>
					</td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo "quitarDelCarrito.php?indice=" . $indice ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<h3>Total: <?php echo $granTotal; ?></h3>
	<form action="./terminarVenta.php" method="POST">
		<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
		<button type="submit" class="btn btn-success">Simpan</button>
		<a href="./cancelarVenta.php" class="btn btn-danger">Batalkan</a>
	</form>
</div>

<script>
	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		$('.pilih-tatap-muka').select2();
		$('.pilih-tatap-online').select2();

	});

	$(document).ready(function() {});
</script>

<?php include_once "pie.php" ?>