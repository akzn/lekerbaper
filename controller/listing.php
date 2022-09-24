<?php 

	class Listing extends koneksi{

		public function __construct(){
			$this->con = mysqli_connect($this->hostname, $this->username, $this->password, $this->database) or die("Connection corrupt");
		}

		public function getMenuList()
	    {
	        global $con;
	        $sql   = "SELECT * FROM tb_menu Join tb_kategori on tb_menu.kategori_id = tb_kategori.kd_kategori order by kd_menu desc";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	}