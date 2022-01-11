<?php 

/**
 * Login 
 */
class Login extends db
{
	private $username;
	private $password;

	public function signin($username, $password){
		$this->username = mysqli_real_escape_string($this->conn(), $username);
		$this->password = mysqli_real_escape_string($this->conn(), md5($password));

		$sql = "SELECT * FROM employe_action WHERE username = '$this->username' AND password = '$this->password'";
		$query = mysqli_query($this->conn(), $sql);

		if(mysqli_num_rows($query)== 1){
			$sqli = mysqli_fetch_assoc($query);
			$id = $sqli['id'];
			$_SESSION['id']= $id;
			header('location: office/home.php');

		}else{
			$msg = "Username or Password Incorect";
			return $msg;
		}
	}

}