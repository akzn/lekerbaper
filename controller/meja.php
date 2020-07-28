<?php 

	class Meja extends koneksi{

		public function getMeja()
	    {
	        global $con;
	        $sql   = "SELECT * FROM tb_meja";
	        $query = mysqli_query($con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	}