<?php 

	include "config/koneksi.php";

	class Resto extends koneksi{

		public function __construct(){
			$this->con = mysqli_connect($this->hostname, $this->username, $this->password, $this->database) or die("Connection corrupt");
		}

		public function connect() {
			$this->con = mysqli_connect($this->hostname, $this->username, $this->password, $this->database) or die("Connection corrupt");
			return $this->con;
		}

		public function select($table)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

		public function selectWhere($table, $where, $whereValues){
			global $con;
			$whereValues = mysqli_real_escape_string($this->con,$whereValues);
			$sql 			= "SELECT * FROM $table WHERE $where='$whereValues'";
			// var_dump($sql);
			$query 			= mysqli_query($this->con, $sql);
			return $data 	= mysqli_fetch_assoc($query);
		} 

		public function selectSumWhere($table, $namaField, $where)
	    {
	        global $con;
	        $where = mysqli_real_escape_string($this->con,$where);
	        $sql         = "SELECT SUM($namaField) as sum FROM $table WHERE $where";
	        $query       = mysqli_query($this->con, $sql);

	        if (mysqli_num_rows($query)>0) {
	        	return $data = mysqli_fetch_assoc($query);
	        } else return 0;
	        
	        // return $data = mysqli_fetch_assoc($query);
	    }

		public function selectOrderBy($table, $field){
			global $con;
	        $sql   = "SELECT * FROM $table ORDER BY $field DESC";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
		}

		public function getQuery($query){
			global $con;
			$sql = $query;
			$query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
		}

		public function edit($table, $where, $whereValues)
	    {
	        global $con;
	        $whereValues = mysqli_real_escape_string($this->con,$whereValues);
	        $sql   = "SELECT * FROM $table WHERE $where = '$whereValues'";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

		public function insert($table, $values, $redirect){
			global $con;
			$sql = "INSERT INTO $table VALUES($values)";
			// var_dump($sql);
			$query = mysqli_query($this->con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Menambahkan Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Menambahkan Data'];
			}
		}

		public function update($table, $value, $where, $whereValues, $redirect){
			global $con;
			$whereValues = mysqli_real_escape_string($this->con,$whereValues);
			$sql = "UPDATE $table SET $value WHERE $where='$whereValues'";
			$query = mysqli_query($this->con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Update Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Update Data'];
			}
		}

		public function sqlQuery($query,$redirect=null){
			global $con;
			$sql = $query;
			$query = mysqli_query($this->con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Update Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Update Data'];
			}
		}

		public function delete($table, $where, $whereValues, $redirect){
			global $con;
			$whereValues = mysqli_real_escape_string($this->con,$whereValues);
			$sql = "DELETE FROM $table WHERE $where='$whereValues'";
			$query = mysqli_query($this->con, $sql);
			if($query){
				return ['response'=>'positive', 'alert'=>'Berhasil Hapus Data',  'redirect'=>$redirect];
			}else{
				return ['response'=>'negative', 'alert'=>'Gagal Hapus Data'];
			}
		}

		public function logout()
	    {
	        session_destroy();
	        // header("Location:loginMulti.php");
	        header("Location:login.php");
	        return ['response' => 'positive', 'alert' => 'Logout Berhasil'];
	    }

	    public function logoutCrew()
	    {
	        session_destroy();
	        // header("Location:loginMulti.php");
	        header("Location:login.php?page=crew");
	        return ['response' => 'positive', 'alert' => 'Logout Berhasil'];
	    }

		public function logout2()
	    {
	        session_destroy();
	        header("Location:index.php");
	        return ['response' => 'positive', 'alert' => 'Logout Berhasil'];
	    }

		public function login($username, $password)
	    {
	        global $con;
	        $username = mysqli_real_escape_string($this->con,$username);
	        $password = mysqli_real_escape_string($this->con,$password);

	        $sql   = "SELECT * FROM tb_user WHERE username ='$username'";
	        $query = mysqli_query($this->con, $sql);
	        $rows  = mysqli_num_rows($query);
	        $assoc = mysqli_fetch_assoc($query);
	        if ($rows > 0) {
	            if (base64_decode($assoc['password']) == $password) {
	                return ['response' => 'positive', 'alert' => 'Berhasil Login', 'level' => $assoc['level'], 'kd_user' => $assoc['kd_user']];
	            } else {
	                return ['response' => 'negative', 'alert' => 'Password Salah'];
	            }
	        } else {

	            return ['response' => 'negative', 'alert' => 'Username atau Password Salah'];
	        }
	    }

	    public function loginCustomer($username,$password){
	    	global $con;
	    	$username = mysqli_real_escape_string($this->con,$username);
	        $password = mysqli_real_escape_string($this->con,$password);
	        $sql   = "SELECT * FROM tb_pelanggan WHERE username ='$username'";
	        $query = mysqli_query($this->con, $sql);
	        $rows  = mysqli_num_rows($query);
	        $assoc = mysqli_fetch_assoc($query);
	        if ($rows > 0) {
	            if (base64_decode($assoc['password']) == $password) {
	                return [
	                	'response' => 'positive', 
	                	'alert' => 'Berhasil Login', 
	                	'level' => $assoc['level'], 
	                	'kd_pelanggan' => $assoc['kd_pelanggan'],
	                	'nama_pelanggan' => $assoc['name_pelanggan']
	            	];
	            } else {
	                return ['response' => 'negative', 'alert' => 'Password Salah'];
	            }
	        } else {

	            return ['response' => 'negative', 'alert' => 'Username atau Password Salah'];
	        }
	    }

	    public function register($kd_user, $name, $email, $username, $password, $confirm, $level, $redirect)
	    {
	    	global $con;
	        global $rg;

	        $username = mysqli_real_escape_string($this->con,$username);
	        $password = mysqli_real_escape_string($this->con,$password);
	        $sql   = "SELECT * FROM tb_user WHERE username = '$username'";
	        $query = mysqli_query($this->con, $sql);

	        $rows = mysqli_num_rows($query);

	        if (strlen($username) < 6) {
	            return ['response' => 'negative', 'alert' => 'username minimal 6 Huruf'];
	        }

	        if ($rows == 0) {

	            $name = htmlspecialchars($name);

	            $username = strtolower(htmlspecialchars($username));
	            $password = htmlspecialchars($password);
	            $confirm  = htmlspecialchars($confirm);

	            if ($password == $confirm) {
	                $password = base64_encode($password);
	                $sql      = "INSERT INTO tb_user VALUES('$kd_user','$name','$email','$username','$password','$level')";
	                $query    = mysqli_query($this->con, $sql);
	                if ($query) {
	                    return ['response' => 'positive', 'alert' => 'Registrasi Berhasil', 'redirect' => $redirect];
	                } else {

	                    return ['response' => 'negative', 'alert' => 'Registrasi Error'];
	                }
	            } else {

	                return ['response' => 'negative', 'alert' => 'Password Tidak Cocok'];
	            }

	        } else if ($rows == 1) {

	            return ['response' => 'negative', 'alert' => 'Username telah digunakan'];
	        }

    	}

		public function registerCustomer($kd_user, $name, $email, $username, $password, $confirm, $redirect)
	    {
	    	global $con;
	        global $rg;
	        // mysqli_close($con);

	        $username = mysqli_real_escape_string($this->con,$username);
	        $password = mysqli_real_escape_string($this->con,$password);

	        $sql   = "SELECT * FROM tb_pelanggan WHERE username = '$username'";
	        $query = mysqli_query($this->con, $sql);

	        $rows = mysqli_num_rows($query);
	        echo $rows;

	        if (strlen($username) < 6) {
	            return ['response' => 'negative', 'alert' => 'username minimal 6 Huruf'];
	        }

	        if ($rows == 0) {

	            $name = htmlspecialchars($name);

	            $username = strtolower(htmlspecialchars($username));
	            $password = htmlspecialchars($password);
	            $confirm  = htmlspecialchars($confirm);

	            if ($password == $confirm) {
	                $password = base64_encode($password);
	                $sql      = "INSERT INTO tb_pelanggan(kd_pelanggan,name_pelanggan,email,username,password) VALUES('$kd_user','$name','$email','$username','$password')";
	                $query    = mysqli_query($this->con, $sql);
	                if ($query) {
	                    return ['response' => 'positive', 'alert' => 'Registrasi Berhasil', 'redirect' => $redirect];
	                } else {
	                	$err = mysqli_error($con);
	                	// var_dump($err);
	                	$err = 'Register error';
	                    return ['response' => 'negative', 'alert' => $err];
	                }
	            } else {

	                return ['response' => 'negative', 'alert' => 'Password Tidak Cocok'];
	            }

	        } else if ($rows == 1) {

	            return ['response' => 'negative', 'alert' => 'Username telah digunakan'];
	        }

    	}    	

    	#should be unused
    	public function register_pelanggan($kd_user, $name, $email, $username, $password, $level, $redirect)
	    {

	    	$username = mysqli_real_escape_string($this->con,$username);
	        $password = mysqli_real_escape_string($this->con,$password);

	        global $con;
	        global $rg;

	        $sql   = "SELECT * FROM tb_user WHERE username = '$username'";
	        $query = mysqli_query($this->con, $sql);

	        $rows = mysqli_num_rows($query);

	        /*if (strlen($username) < 6) {
	            return ['response' => 'negative', 'alert' => 'username minimal 6 Huruf'];
	            exit;
	        }*/

	        if ($rows == 0) {

	            $name = htmlspecialchars($name);

	            $username = strtolower(htmlspecialchars($username));
	            $password = htmlspecialchars($password);

	            $password = base64_encode($password);
	            $sql      = "INSERT INTO tb_user VALUES('$kd_user','$name','$email','$username','$password','$level')";
	            $query    = mysqli_query($this->con, $sql);
	            if ($query) {
	                return ['response' => 'positive', 'alert' => 'Registrasi Berhasil', 'redirect' => $redirect];
	            } else {

	                return ['response' => 'negative', 'alert' => 'Registrasi Error'];
	            }

	        } else if ($rows == 1) {

	            return ['response' => 'negative', 'alert' => 'Username telah digunakan'];
	        }

	    }



    	public function autokode($table, $field, $pre)
    	{
	        global $con;
	        $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
	        $querys = mysqli_query($this->con, $sqlc);
	        $number = mysqli_fetch_assoc($querys);
	        if ($number['jumlah'] > 0) {
	            // $sql    = "SELECT MAX($field) as kode FROM $table";
	            $sql    = "SELECT MAX(CONVERT(SUBSTR($field,3),SIGNED INTEGER)) as kode FROM $table";
	            // var_dump($sql);
	            $query  = mysqli_query($this->con, $sql);
	            $number = mysqli_fetch_assoc($query);
	            // var_dump($number);
	            // $strnum = substr($number['kode'], 2, 3);
	            $strnum = $number['kode'];
	            $strnum = $strnum + 1;
	            // var_dump($strnum);
	            if (strlen($strnum) == 3) {
	                $kode = $pre . $strnum;
	            } else if (strlen($strnum) == 2) {
	                $kode = $pre . "0" . $strnum;
	            } else if (strlen($strnum) == 1) {
	                $kode = $pre . "00" . $strnum;
	            } else {
	            	$kode = $pre . $strnum;
	            }
	        } else {
	            $kode = $pre . "001";
	        }

	        return $kode;
    	}

    	public function sessionCheck(){
    		if(!isset($_SESSION['username'])){
    			return "false"; 
    		}else{
    			return "true";
    		}
    	}

    	public function AuthUser($sessionUser)
    	{
    		global $con;
    		$sessionUser = mysqli_real_escape_string($this->con,$sessionUser);
    		$sql = "SELECT * FROM tb_user WHERE username = '$sessionUser'";
    		$query = mysqli_query($this->con, $sql);
    		$bigData = mysqli_fetch_assoc($query);
    		return $bigData;
    	}

    	public function redirect($redirect)
	    {
	        return ['response' => 'positive', 'alert' => 'Login Berhasil', 'redirect' => $redirect];
	    }

	    public function getCountRows($table){
	    	global $con;
	    	$sql = "SELECT * FROM $table";
	    	$query = mysqli_query($this->con, $sql);
	    	$rows = mysqli_num_rows($query);
	    	return $rows;
	    }

	    public function validateHtml($field){
	    	$field = htmlspecialchars($field);
	    	return $field;
	    }

	    public function validateImage(){
	    	global $con;
	    	$name 		= $_FILES['foto']['name'];
	    	$ukuranFile = $_FILES['foto']['size'];
	    	$error 		= $_FILES['foto']['error'];
	    	$tmpName 	= $_FILES['foto']['tmp_name'];
	    	$folder = 'img/';
	    	$extensiGambar 		= explode('.', $name);
	    	$namaGambar 		= $extensiGambar[0];
	    	$ekstensiBelakang 	= strtolower(end($extensiGambar));
	    	$ekstensi 			= ['jpg','jpeg','png','gif'];
	    	$error 				= array();

	    	if (in_array($ekstensiBelakang, $ekstensi) === false) {
	            return ['response' => 'negative', 'alert' => 'Gambar hanya boleh menggunakan ekstensi jpg,jpeg,png'];
	        }

	        if ($ukuranFile > 4000000) {
	            return ['response' => 'negative', 'alert' => 'Ukuran gambar terlalu besar'];
	        }

	        if (empty($errors)) {
	            if (!file_exists('img')) {
	                mkdir('img', 0563);
	            }

	        }
	        $name = random_int(1, 999);
	        $name = time() . $name . "." . $ekstensiBelakang;
	        move_uploaded_file($tmpName, $folder . $name);

	        return ['types' => 'true', 'image' => $name];
	    }

	    public function AuthPelanggan($sessionUser){
	    	global $con;
	    	$sql 		= "SELECT * FROM tb_pelanggan WHERE name_pelanggan = '$sessionUser'";
	    	// $query 		= mysqli_query($this->con, $sql);
	    	// $bigData 	= mysqli_fetch_assoc($query);
	    	// return $bigData;
	    }

	    public function editWhere($table, $where, $whereValues, $where2, $whereValues2)
	    {
	        global $con;
	        $whereValues = mysqli_real_escape_string($this->con,$whereValues);
	        $whereValues2 = mysqli_real_escape_string($this->con,$whereValues2);
	        $sql   = "SELECT * FROM $table WHERE $where = '$whereValues' AND $where2 = '$whereValues2'";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }


	    public function selectOrderDate($table, $where, $whereValues, $field){
	    	global $con;
	    	$whereValues = mysqli_real_escape_string($this->con,$whereValues);
	    	$sql = "SELECT * FROM $table WHERE $where ='$whereValues' ORDER BY $field DESC";
	    	$query = mysqli_query($this->con, $sql);
	    	$data = [];
	    	while($bigData = mysqli_fetch_assoc($query)){
	    		$data[] = $bigData;
	    	}
	    	return $data;
	    }

	    public function selectOrderDate2($table, $field)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table ORDER BY $field DESC";
	        $query = mysqli_query($this->con, $sql);
	        $data  = [];
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	    public function selectSum($table, $namaField)
	    {
	        global $con;
	        $sql         = "SELECT SUM($namaField) as sum FROM $table";
	        $query       = mysqli_query($this->con, $sql);
	        if (mysqli_num_rows($query)>0) {
	        	return $data = mysqli_fetch_assoc($query);
	        } else return 0;
	        // return $data = mysqli_fetch_assoc($query);
	    }

	    public function selectBetween($table, $whereparam, $param, $param1)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
	        $query = mysqli_query($this->con, $sql);
	        $data   = [];
	        // var_dump($sql);
	        while ($bigData = mysqli_fetch_assoc($query)) {
	            $data[] = $bigData;
	        }
	        return $data;
	    }

	    public function selectWhere2($table, $where, $whereValues, $where2, $whereValues2)
	    {
	        global $con;
	        $sql   = "SELECT * FROM $table WHERE $where = '$whereValues' AND $where2 = '$whereValues2'";
	        $query = mysqli_query($this->con, $sql);

	        return $data = mysqli_num_rows($query);
	    }


	}

		// $hostname = "localhost";
		// $username = "root";
		// $password = "";
		// $database = "lekerbaper";

		// $con = mysqli_connect($hostname, $username, $password, $database) or die("Connection corrupt");

 ?>