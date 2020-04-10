<?php
class Auth{
	const LoginPageURL = 'Login.php';
	const SuccessPageURL = 'AdminMenu.php';

	public static function Login($username, $password){
		if (Auth::checkPassword($username, $password) == 1) {
			session_start();
			$_SESSION['username'] = $username;
			session_write_close();
			header('Location: ' . self::SuccessPageURL);
			exit;
		}
		else{
			return false;
		}
	}

	public static function checkPassword($username, $password) {
		$password = Auth::HashPassword($password);
		$dbServer = 'localhost';
		$dbDatabase = 'sportgear';
		$dbUsername = 'root';
		$dbPassword = '';

		$conn = new PDO("mysql:dbname=$dbDatabase; host=$dbServer; charset=utf8", $dbUsername, $dbPassword);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

		try{
			$sql = "select COUNT(*) from staffuser
					where username = :username and password = :password";
		
			$statement = $conn->prepare($sql);
			$statement->bindValue(':username', $username, PDO::PARAM_STR);
			$statement->bindValue(':password', $password, PDO::PARAM_STR);	
			$statement->execute();
			$result = $statement->fetchColumn();	
		}

		catch(PDOException $ex){
			echo "There was a problem accessing the database: " . $ex->getMessage();
			return 0;
		}
		return $result;
	}

	public static function changePassword($username, $password){
		$password = Auth::HashPassword($password);

		$dbServer = 'localhost';
		$dbDatabase = 'sportgear';
		$dbUsername = 'root';
		$dbPassword = '';

		$conn = new PDO("mysql:dbname=$dbDatabase; host=$dbServer; charset=utf8", $dbUsername, $dbPassword);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );

		try{
			$sql = "update staffuser set password = :password
					where username = :username";
		
			$statement = $conn->prepare($sql);
			$statement->bindValue(':username', $username, PDO::PARAM_STR);
			$statement->bindValue(':password', $password, PDO::PARAM_STR);	
			$statement->execute();
			
		}

		catch(PDOException $ex){
			echo "There was a problem accessing the database: " . $ex->getMessage();
		}
	}

	public static function Logout(){
		session_start();
		unset($_SESSION['username']);
		session_write_close();
		header('Location: ' . self::LoginPageURL);
		exit;
	}

	public static function IsLoggedIn(){
		session_start();
		$loggedIn = isset($_SESSION['username']);
		session_write_close();
		return $loggedIn;
	}

	public static function Protect(){
		if(!self::IsLoggedIn()){
			header('Location: ' . self::LoginPageURL);	
			exit;	
		}
	}

	public static function HashPassword($password){
		$salt = '^kjsdHH8cX0';
		$hash =  sha1(sha1($password . $salt) . $salt);
		return $hash;
	}
}

?>