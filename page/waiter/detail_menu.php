<?php
	$dm                 = new Resto();
	$order                 = new Order();
	$getMenu            = $dm->selectWhere("tb_menu", "kd_menu", $_GET['kd']);
	$kd                 = $_GET['kd'];
	@$getKategori       = $dm->selectWhere("tb_kategori", "kd_kategori", $_GET['kategori']);
	@$kate              = $_GET['kategori'];
	$autokode           = $dm->autokode("tb_order", "kd_order", "TR");
	$autokodedetail     = $dm->autokode("tb_detail_order", "kd_detail", "DM");
	// $autokodedetailTemp = $dm->autokode("tb_detail_order_temporary", "kd_detail", "DM");
	$authPelanggan      = $dm->AuthPelanggan($_SESSION['username']);
	$authUser           = $dm->AuthUser($_SESSION['username']);
	
	$kd_order = $_GET['order'];
	$no_meja_cus = $_GET['meja'];
	$no_meja2           = $authPelanggan['no_meja'];

	//For view keranjang
	/*$sql3     = "SELECT kd_order FROM tb_order WHERE no_meja='$no_meja2'";
	$exe3     = mysqli_query($con, $sql3);
	$num3     = mysqli_num_rows($exe3);
	$dta3     = mysqli_fetch_assoc($exe3);
	$data_kd2 = $dta3['kd_order'];
	$kduser = $authUser['kd_user'];
	// $data = $dm->editWhere("detail_order", 'order_kd', $data_kd2, 'user_kd', $kduser);

	$data = $dm->getKeranjang("tb_detail_order", 'order_kd', $data_kd2, 'user_kd', $kduser);*/
	
	// var_dump($data);

	//Sum total
	// $sql   = "SELECT SUM(sub_total) as sub FROM tb_detail_order_temporary WHERE order_kd = '$data_kd2'";
	/*$sql   = "SELECT SUM(sub_total) as sub FROM tb_detail_order WHERE order_kd = '$data_kd2'";
	$exec  = mysqli_query($con, $sql);
	$assoc = mysqli_fetch_assoc($exec);*/


	// Cek if meja dah ada kode order
	$no_meja = $authPelanggan['no_meja'];
	$sql2    = "SELECT kd_order FROM tb_order WHERE no_meja='$no_meja'";
	$exe2    = mysqli_query($con, $sql2);
	$num2    = mysqli_num_rows($exe2);
	$dta2    = mysqli_fetch_assoc($exe2);
	$data_kd = $dta2['kd_order']; // Kode order



	/*Button Tambah pesanan*/
	/*if (isset($_POST['btnTambah'])) {
		// $nama_user     = $authUser['name'];
		// $kd_user       = $authUser['kd_user'];
		$status_detail = "pesan";
		$total         = $_POST['total'];
		$menu_kd       = $getMenu['kd_menu'];
		$sub_total     = $_POST['sub_total'];
		// $sql = "SELECT * FROM tb_detail_order_temporary WHERE menu_kd='$menu_kd' AND order_kd='$data_kd'";

		// Cek apakah sudah ada kode order, 

		if (!$kd_order) {
			$autokode = $dm->autokode("tb_order", "kd_order", "TR");
			$kd_order = $autokode;

			if (!$no_meja_cus) {
				$no_meja_cus = NULL;
			}

			$valueOrder = "'$kd_order', '$no_meja_cus', null, '$nama_user', '$kd_user', '', '$status', '$date'";
            $response   = $dm->insert("tb_order", $valueOrder,null);
		}

		$sql = "SELECT * FROM tb_detail_order WHERE menu_kd='$menu_kd' AND order_kd='$kd_order'";
			// var_dump($sql);
		$exe = mysqli_query($con, $sql);
		$num = mysqli_num_rows($exe);
		$dta = mysqli_fetch_assoc($exe);

		# Condition
		if ($num > 0) {
			// Jika sudah ada kode order
			$total     = $dta['total'] + $total;
			$sub_total = $dta['sub_total'] + $sub_total;
			$value     = "total='$total', sub_total='$sub_total'";
			$response  = $dm->update("tb_detail_order", $value, "menu_kd= '$menu_kd' AND order_kd", $data_kd, "?page=dashboard");
		} else {
			// JIka belum ada kode order
			$valueDetail = "'$autokodedetail', '$data_kd', '$kd_user', '$menu_kd', '', '$total', '$sub_total', '', '', '', '$status_detail'";
			var_dump($valueDetail);
			$response    = $dm->insert("tb_detail_order", $valueDetail, "?page=dashboard");
			$valueUp  = "status_order='belum_bayar'";
			$response = $dm->update("tb_order", $valueUp, "kd_order", $data_kd, "?page=dashboard");
		}
	}*/

	# btn tambah pesanan
	if (isset($_POST['btnTambah'])) {

		//declare var for input pesanan
		$status_detail = "pesan";
		$kd_menu       = $getMenu['kd_menu'];
		$harga_satuan	= $_POST['harga_satuan'];
		$sub_total     = $_POST['sub_total'];
		$jml_pesan         = $_POST['total'];

		//JIka jumlah pesan > 0
		if ($jml_pesan > 0) {

			//jika cust atau meja masih kosong
			if (!($_GET['meja']) || ! ($_GET['cust'])) {
				
				echo("<script>alert('belum input meja atau pelanggan')</script>");
				
			} else {
				$kd_order = $_SESSION['kd_order'];

				/*if order from customer page*/
	            	if ($_SESSION['kd_pelanggan']) {
	            		$kd_pelanggan= $_SESSION['kd_pelanggan'];
	            	} else {
	            		$kd_pelanggan=null;
	            	}
	            	
				// Jika belum ada kode order 
				if (!$kd_order) {
					// BUat order baru
					$new_kd_order = $dm->autokode("tb_order", "kd_order", "TR");
					$date = date('Y-m-d');
					$status_order = 'belum_beli';
					$kd_order = $autokode;
					$redirect     = "dashboard.php";

					$valueOrder = "'$kd_order', '$_GET[meja]', null, '$_GET[cust]', null, '', '$status_order', '$date','$kd_pelanggan'";
		            $response   = $order->new_order("tb_order", $valueOrder);

		            if ($response['response']=='positive') {
		            	//jika berhasil buat kode order
		            	$_SESSION['kd_order'] = $autokode;

		            	//insert item detail menu baru
		            	$autokodedetail     = $dm->autokode("tb_detail_order", "kd_detail", "DM");

		            	$valueDetail = "'$autokodedetail', '$new_kd_order', '', '$kd_menu', '', '$jml_pesan', '$sub_total', '', '', '', '$status_detail'";
		            	$response    = $order->new_order("tb_detail_order", $valueDetail);

		            }
				} else {
					// Jika sudah ada kode order 
					$sql = "SELECT * FROM tb_detail_order WHERE menu_kd='$kd_menu' AND order_kd='$kd_order'";
					$exe = mysqli_query($con, $sql);
					$num = mysqli_num_rows($exe);
					$dta = mysqli_fetch_assoc($exe);

					// var_dump($num);exit;

					if ($num > 0) {
						// Jika menu sudah ada di pesanan, tambah
						$jml_pesan     = $dta['total'] + $jml_pesan;
						$sub_total = $jml_pesan * $harga_satuan;
						$valueDetail     = "total='$jml_pesan', sub_total='$sub_total'";
						$response  = $order->update_order("tb_detail_order", $valueDetail, "menu_kd= '$kd_menu' AND order_kd", $kd_order);
					} else {
						// Jika menu belum ada di pesanan, insert
						$valueDetail = "'$autokodedetail', '$kd_order', '', '$kd_menu', '', '$jml_pesan', '$sub_total', '', '', '', '$status_detail'";
						$response    = $order->new_order("tb_detail_order", $valueDetail);
					}
					// unset($_SESSION['kd_order']);
				}
			}
		} else {
			//JIka jumlah pesan !> 0
			$response = array('response' => 'negative', 'alert' => 'Jumlah pesan kurang dari 1');
		}
	}




	// if (isset($_POST['kirimCatatan'])) {
	// $keterangan = $_POST['keterangan'];
	// if ($keterangan == "") {
	// $response = ['response' => 'negative', 'alert' => 'Lengkapi Field'];
	// } else {
	// $value    = "keterangan='$keterangan', status_keterangan='N'";
	// // $response = $dm->update("tb_detail_order_temporary", $value, "order_kd", $data_kd, "?page=detail_menu&kategori=$kate&kd=$kd");
	// $response = $dm->update("tb_detail_order", $value, "order_kd", $data_kd, "?page=detail_menu&kategori=$kate&kd=$kd");
	// }
	// }

	# Hapus item
	if (isset($_GET['hapus2'])) {
		$kd       = $_GET['kd'];
		$where    = "kd_detail";
		// $response = $dm->delete("tb_detail_order_temporary", $where, $kd, "?page=dashboard");
		$response = $dm->delete("tb_detail_order", $where, $kd, "?page=dashboard");
	}

?>
<!-- <div class="modal fade" id="keranjangModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form method="post">
				<div class="modal-header">
					<h3 class="modal-title" id="mediumModalLabel">Pesanan Anda</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Menu</th>
										<th>Jumlah</th>
										<th>Sub total</th>
										<th>Status Orderan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (count($data) > 0) {
									$no = 1;
									foreach ($data as $datas) {
									?>
									<tr>
										<td><?=$no;?></td>
										<td><?=$datas['name_menu']?></td>
										<td><?=$datas['total']?></td>
										<td>Rp. <?=$datas['sub_total']?></td>
										<td>
											<?php
											$status_d = $datas['status_detail'];
											if ($status_d == "pending") {
											?>
											<span style="padding: 10px;" class="badge badge-pill badge-dark"><?=$status_d?></span>
											<?php
											} elseif ($status_d == "dimasak") {
											?>
											<span style="padding: 10px;" class="badge badge-pill badge-info"><?=$status_d?></span>
											<?php
											} elseif ($status_d == "siap") {
											?>
											<span style="padding: 10px;" class="badge badge-pill badge-success"><?=$status_d?></span>
											<?php
											} elseif ($status_d == "diambil") {
											?>
											<span style="padding: 10px;" class="badge badge-pill badge-danger"><?=$status_d?></span>
											<?php
											}
											?>
										</td>
										<td>
											<button id="bthapus2<?=$no;?>" class="btn btn-danger btn-sm">Batal Beli</button>
										</td>
									</tr>
									<script src="../../vendor/jquery-3.2.1.min.js"></script>
									<script>
									$("#bthapus2<?php echo $no; ?>").click(function(){
									swal({
									title: "Hapus",
									text: "Yakin Hapus?",
									type: "warning",
									showCancelButton: true,
									confirmButtonText: "Yes",
									cancelButtonText: "Cancel",
									closeOnConfirm: false,
									closeOnCancel: true
									},function(isConfirm){
									if (isConfirm) {
									window.location.href="?page=detail_menu&hapus2&kd=<?=$datas['kd_detail'];?>";
									}
									})
									})
									</script>
									<?php $no++;}?>
									<td colspan="3" class="text-right">Total Bayar</td>
									<td>Rp. <?=$assoc['sub'];?></td>
									<td></td>
									<td></td>
									<?php } else {?>
									<br>
									<td colspan="6" class="text-center"><h3>Anda belum pernah order</h3></td>
									<?php }?>
								</tbody>
							</table>
						</div>
						<br>
						<div class="form-group" hidden>
							<label for="">Tambahkan catatan untuk koki (bagian dapur) (Opsional)</label>
							<h6 style="color: red;">Cat : Pastikan nama menu tercantum ketika ingin menambah catatan</h6>
							<br>
							<?php
							@$dk = $dkt;
							foreach ($data as $dk) {}
							?>
							<textarea class="form-control" name="keterangan" rows="3" placeholder="Contoh : Untuk gado gado ga pake mentimun, ayam serundeng banyakin bumbunya"><?=$dk['keterangan']?></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<?php
					$st = @$dk['status_keterangan'];
					if ($st == "S") {
					?>
					<span style="padding: 10px;" class="badge badge-pill badge-success"><i class="fa fa-check"></i> Catatan anda telah dikonfirmasi</span>
					<?php
					} elseif ($st == "T") {
					?>
					<span style="padding: 10px;" class="badge badge-pill badge-danger">Catatan anda tidak dikonfirmasi dikarenakan <span>Bumbu telah habis</span></span>
					<?php
					}
					?>
					<button name="kirimCatatan" class="btn btn-primary">Selesaikan Pesanan</button>
				</div>
			</form>
		</div>
	</div>
</div> -->
<div class="section__content section__content--p30 m-t-40">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="au-breadcrumb-content">
					<div class="au-breadcrumb-left">
						<ul class="list-unstyled list-inline au-breadcrumb__list">
							<li class="list-inline-item"><a href="?page=dashboard&meja=<?=$_GET['meja']?>&cust=<?=$_GET['cust']?>">Beranda</a></li>
							<li class="list-inline-item"><span><i class="zmdi zmdi-chevron-right"></i></span></li>
							<li class="list-inline-item"><a href="">Menu Detail</a></li>
							<li class="list-inline-item"><span><i class="zmdi zmdi-chevron-right"></i></span></li>
							<li class="list-inline-item">
								<a href="?page=order_menu&kategori&menu&kd=<?=$getKategori['kd_kategori']?>&meja=<?=$_GET['meja']?>&cust=<?=$_GET['cust']?>"><?=$getKategori['name_kategori']?></a>
							</li>
							<li class="list-inline-item"><span><i class="zmdi zmdi-chevron-right"></i></span></li>
							<li class="list-inline-item active">
								<a href="">
									<?=$getMenu['name_menu']?>
								</a>
							</li>
						</ul>
					</div>
					<div class="au-breadcrumb-right" hidden>
						<button data-toggle="modal" data-target="#keranjangModal" class="btn btn-lg btn-success btn-fab">
							<i class="fa fa-shopping-basket">
							</i>
						</button>
					</div>
				</div>
				<a href="?page=dashboard&meja=<?=$_GET['meja']?>&cust=<?=$_GET['cust']?>" class="btn btn-danger float-right">Kembali ke kategori</a>
			</div>
		</div>
	</div>
</div>
<div class="main-content" style="margin-top: -70px;">
	<div class="section__content section__content--p30">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="row">
							<div class="col-md-6">
								<div class="card-body">
									<img class="img-responsive" height="200" src="img/<?=$getMenu['photo']?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="card-body">
									<form action="" method="post">
										<h1><?=$getMenu['name_menu']?></h1>
										<hr>
										<h2 style="color: red;">Rp. <span id="harba"><?=$getMenu['harga']?></span></h2>
										<hr>
										<p><?=$getMenu['description']?></p>
										<hr>
										<div class="col-12">
											<div class="form-group">
												<label for="" style="display: none;"><b>Jumlah</b></label>
												<div class="input-counter input-group">
													<div class="input-group-append">
														<button id="btnMinus" type="button" class="btn-subtract btn btn-primary">
														<i class="fa fa-minus"></i>
														</button>
													</div>
													<!-- <input type="number" name="total" class="form-control counter" data-min="1" id="
													jumjum" data-default="0"> -->
													<input type="number" id="jumjum" name="total" class="form-control val-num" value="0">
													<div class="input-group-prepend">
														<button id="btnPlus" type="button" class="btn-add btn btn-primary">
														<i class="fa fa-plus"></i>
														</button>
													</div>
												</div>
												<!-- <div class="form-group">
													<label for="">Jumlah</label>
													<input type="number" id="jumjum" name="total" class="form-control">
												</div> -->
												<div class="form-group">
													<label for="">Harga</label>
													<input class="form-control" id="hargas" type="text"  name="harga_satuan" value="<?=$getMenu['harga']?>" hidden>
													<input class="form-control"  type="text" name="harga" value="<?=number_format($getMenu['harga'],2,",",".");?>" disabled>
												</div>
												<div class="form-group">
													<label for=""><b>Sub Total</b></label>
													<input type="text" name="sub_total" class="form-control val-num" id="totals" value="0" disabled>
												</div>
												<br>
												<button name="btnTambah" class="btn btn-success float-right">Tambahkan ke pesanan</button>
												<br>
												<br>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?=BASE_URL?>/vendor/jquery-3.2.1.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#btnPlus").click(function(){
				var jumlah  = parseInt($('#jumjum').val());
				jumlah = jumlah + 1;
				 $('#jumjum').val(jumlah);
				var harba   = parseInt($('#hargas').val());
				var kali    = harba * jumlah;
				console.log($('#jumjum').val());
				$("#totals").val(kali);
			});

			$("#btnMinus").click(function(){
				var jumlah  = parseInt($('#jumjum').val());
				if (jumlah > 0) {
					jumlah = jumlah - 1;
				}
				
				 $('#jumjum').val(jumlah);
				var harba   = parseInt($('#hargas').val());
				var kali    = harba * jumlah;
				console.log($('#jumjum').val());
				$("#totals").val(kali);
			});
			
			$('#jumjum').keyup(function(){
				var jumlah  = $(this).val();
				var harba   = $('#hargas').val();
				var kali    = harba * jumlah;
				$("#totals").val(kali);
			});	

		});
	</script>
	<style>
		.fixed {
				position: fixed;
				padding: 3px 10px;
			}
	</style>