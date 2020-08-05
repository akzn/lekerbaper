<?php 

	class Listing extends koneksi{

		public function getMenuList()
	    {
	        global $con;
	        $sql   = "SELECT * FROM tb_menu Join tb_kategori on tb_menu.kategori_id = tb_kategori.kd_kategori";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	}