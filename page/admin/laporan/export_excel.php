<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php

			include "../../../config/for_excel.php";
			$ee = new Resto();
			$date = date('Y-m-d');
			// $dataTrans = $ee->selectOrderBy("transaksi", "waktu");

			$dataTrans = $ee->getQuery("SELECT kd_transaksi,kd_order,tb_user.name,tb_pelanggan.name_pelanggan,tb_transaksi.tanggal,tb_transaksi.total_harga 
                  from  tb_transaksi 
                  join tb_order on tb_order.kd_order = tb_transaksi.order_kd 
                  join tb_user on tb_user.kd_user = tb_transaksi.user_kd
                  left join tb_pelanggan on tb_pelanggan.kd_pelanggan = tb_order.kd_pelanggan
                  order by tb_transaksi.waktu desc
                  ");

			$grand     = $ee->selectSum("transaksi", "total_harga");
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=Laporan Transaksi - ".$date.".xls");
		?>
		
		<center>
		<h2>Laporan Semua Data Transaksi</h2>
		<table class="table table-hover table-bordered" width="100%;" align="center" border="1px" cellpadding="5">
			<thead>
                                                      <tr>
                                                            <td>Kode Transaksi</td>
                                                            <td>Nama Kasir</td>
                                                            <td>Pelanggan</td>
                                                            <td>Tanggal Beli</td>
                                                            <td>Total Harga</td>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php foreach ($dataTrans as $dts): ?>
                                                      <tr>
                                                            <td><?=$dts['kd_transaksi']?></td>
                                                            <td><?=$dts['name']?></td>
                                                            <!-- <td><?=$dts['name_pelanggan']?></td> -->
                                                            <td><?=$dts['tanggal']?></td>
                                                            <td><?="Rp." . number_format($dts['total_harga']) . ",-"?></td>
                                                      </tr>
                                                      <?php endforeach?>
                                                      <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <!-- <td></td> -->
                                                            <td>Total</td>
                                                            <td><?php echo "Rp." . number_format($grand['sum']) . ",-" ?></td>
                                                      </tr>
                                                </tbody>
		</table>
		</center>
	</body>
</html>