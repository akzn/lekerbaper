<?php
$op = new Resto();

$query = "SELECT
  `tb_detail_order`.`kd_detail`          AS `kd_detail`,
  `tb_detail_order`.`order_kd`           AS `order_kd`,
  `tb_detail_order`.`user_kd`            AS `user_kd`,
  `tb_detail_order`.`menu_kd`            AS `menu_kd`,
  `tb_detail_order`.`transaksi_kd`       AS `transaksi_kd`,
  `tb_detail_order`.`total`              AS `total`,
  `tb_detail_order`.`sub_total`          AS `sub_total`,
  `tb_detail_order`.`keterangan`         AS `keterangan`,
  `tb_detail_order`.`status_keterangan`  AS `status_keterangan`,
  `tb_detail_order`.`balasan_keterangan` AS `balasan_keterangan`,
  `tb_detail_order`.`status_detail`      AS `status_detail`,
  `tb_menu`.`kd_menu`                    AS `kd_menu`,
  `tb_menu`.`name_menu`                  AS `name_menu`,
  `tb_menu`.`harga`                      AS `harga`,
  `tb_menu`.`status`                     AS `status`,
  `tb_user`.`name`                       AS `name`,
  `tb_user`.`level`                      AS `level`,
  `tb_order`.`no_meja`                   AS `no_meja`,
  `tb_order`.`tanggal`                   AS `tanggal`,
  `tb_order`.`nama_user`                 AS `nama_user`,
  `tb_order`.`status_order`              AS `status_order`
FROM (((`tb_detail_order`
     JOIN `tb_menu`
       ON (`tb_detail_order`.`menu_kd` = `tb_menu`.`kd_menu`))
    JOIN `tb_user`
      ON (`tb_detail_order`.`user_kd` = `tb_user`.`kd_user`))
   JOIN `tb_order`
     ON (`tb_detail_order`.`order_kd` = `tb_order`.`kd_order`))";

$awal  = @$_POST['dateAwal'];
$akhir = @$_POST['dateAkhir'];
// $data  = $op->selectBetween("detail_order", "tanggal", $awal, $akhir);
$data = $op->getQuery($query);

if (isset($_POST['btnSearch'])) {
	$awal  = $_POST['dateAwal'];
	$akhir = $_POST['dateAkhir'];
	// $data  = $op->selectBetween("tb_detail_order", "tanggal", $awal, $akhir);

	$query = "SELECT
			  *,
			  b.no_meja,b.tanggal
			FROM
			   tb_order b
			  -- Left JOIN tb_pelanggan c
			    -- ON b.kd_pelanggan = c.kd_pelanggan
			    JOIN `tb_transaksi` d
			    ON b.kd_order = d.order_kd
				WHERE b.tanggal BETWEEN '$awal'
				  AND '$akhir' ORDER BY CONVERT(SUBSTR(kd_transaksi,3),SIGNED INTEGER) desc";
	$data = $op->getQuery($query);
}
?>
<div class="main-content" style="margin-top: 20px;">
	<div class="section__content section__content--p30">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<form method="post">
							<div class="card-header">
								<h3>Periode</h3>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<label for="#">Dari Tanggal</label>
										<input value="<?= @$_POST['dateAwal']?>" class="form-control" type="date" placeholder="Select Date" name="dateAwal" required>
									</div>
									<div class="col-sm-4">
										<label for="#">Ke Tanggal</label>
										<input value="<?= @$_POST['dateAkhir']?>" class="form-control" type="date" placeholder="Select Date" name="dateAkhir" required>
									</div>
								</div>
								<br>
								<button class="btn btn-primary" name="btnSearch"><i class="fa fa-search"></i> Search</button>
								<a href="?page=order_periode" class="btn btn-danger">Reload</a>
								<br><br>
								<?php if (isset($_POST['dateAwal'])): ?>
								<!-- <a target="_blank" href="page/admin/laporan/order_periode_print.php?dateAwal=<?php echo $awal ?>&dateAkhir=<?php echo $akhir ?>" style="color: white;" class="btn btn-primary"><i class="fa fa-print"></i> Print</a> -->

								<a target="_blank" href="?page=order_periode_print&dateAwal=<?php echo $awal ?>&dateAkhir=<?php echo $akhir ?>" style="color: white;" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>

								<?php endif?>
								<br><br>
								<div class="table-responsive ">
									<table class="table table-striped table-hover table-bordered dttb">
										<thead>
											<tr>
												<th>Kode Transaksi</th>
												<th>Pelanggan</th>
												<th>No Meja</th>
												<!-- <th>Nama Menu</th> -->
												<!-- <th>Jumlah</th> -->
												<!-- <th>Sub total</th> -->
												<th>Harga</th>
												<th>Tanggal</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											foreach (@$data as $ds) {?>
											<tr>
												<td><?=$ds['kd_transaksi']?></td>
												<td><?=$ds['nama_user']?></td>
												<td><?=$ds['no_meja']?></td>
												<!-- <td><?=$ds['name_menu']?></td> -->
												<!-- <td><?=$ds['total']?></td> -->
												<!-- <td><?=$ds['sub_total']?></td> -->
												<td><?=number_format($ds['total_harga'])?></td>
												<td><?=$ds['tanggal']?></td>
												<?php $no++;}?>
											</tbody>
										</table>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
      $(function(){
            $('.dttb').DataTable({
            	"order": []
            });
      })
</script>