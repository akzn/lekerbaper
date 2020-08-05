<?php 

	class Koki extends koneksi{

		public function getJob()
	    {
	        global $con;
	        $sql   = "SELECT * FROM tb_order where status_order = 'belum_bayar' order by waktu desc";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	    public function getJobDetail($kd_order)
	    {
	        global $con;
	        $sql   = "SELECT
						  *
						FROM
						  tb_detail_order
						  JOIN tb_order ON `tb_detail_order`.`order_kd` = tb_order.`kd_order`
						  JOIN tb_menu ON `tb_detail_order`.`menu_kd` = tb_menu.`kd_menu`
						WHERE order_kd = '$kd_order'";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	}