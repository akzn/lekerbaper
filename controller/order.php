
<?php 

	class Order extends koneksi{

		public function new_order($table, $values){
			global $con;
			$sql = "INSERT INTO $table VALUES($values)";
			// var_dump($sql);
			$query = mysqli_query($this->con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Menambahkan Data'];
			}else{
				var_dump(mysqli_error($con));
				return ['response'=>'negative', 'alert'=>'Gagal Menambahkan Data'];
			}
		}

		public function update_order($table, $value, $where, $whereValues){
			global $con;
			$sql = "UPDATE $table SET $value WHERE $where='$whereValues'";
			$query = mysqli_query($this->con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Update Data'];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Update Data'];
			}
		}

		public function getOrderData($kd_order)
	    {
	        global $con;
	        $sql   = "SELECT
						  *
						FROM
						  tb_detail_order
						  JOIN tb_order ON `tb_detail_order`.`order_kd` = tb_order.`kd_order`
						  JOIN tb_menu ON `tb_detail_order`.`menu_kd` = tb_menu.`kd_menu`
						WHERE order_kd = '$kd_order'";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	    public function getOrderDataByTrx($kd_trx)
	    {
	        global $con;
	        $sql   = "SELECT
						  *
						FROM
						  tb_detail_order
						  JOIN tb_order ON `tb_detail_order`.`order_kd` = tb_order.`kd_order`
						  JOIN tb_menu ON `tb_detail_order`.`menu_kd` = tb_menu.`kd_menu`
						WHERE transaksi_kd = '$kd_trx'";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	    public function getUnfinishedOrderByPelanggan($kd_pelanggan){
	    	global $con;
	        $sql   = "SELECT
						  *
						FROM
						  tb_order
						WHERE
							kd_pelanggan = '$kd_pelanggan' 
						And 
							(status_order = 'belum_beli' or status_order = 'belum_bayar')
						";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	    public function getUnfinishedOrderByMeja($no_meja){
	    	global $con;
	        $sql   = "SELECT
						  *
						FROM
						  tb_order
						WHERE
							no_meja = '$no_meja' 
						And 
							(status_order = 'belum_beli' or status_order = 'belum_bayar')
						";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }


		public function getKeranjang($table, $where, $whereValues)
	    {
	        global $con;
	        // $sql   = "SELECT * FROM $table Join $table2 On WHERE $where = '$whereValues' AND $where2 = '$whereValues2'";
	        $sql 	= " SELECT * from tb_detail_order t1 join tb_menu t2 on t1.menu_kd = t2.kd_menu WHERE $where = '$whereValues'";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	}
