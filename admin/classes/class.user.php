<?php 
	class USER{
		private $db;
		function __construct($DB_con){
			$this->db = $DB_con;
		}

		public function register($fname,$lname,$uname,$umail,$upass,$reg_date, $confirm, $active, $avatar,$user_level){
			try{
				$new_password = password_hash($upass, PASSWORD_DEFAULT);
				
				$stmt = $this->db->prepare("INSERT INTO users(fname,lname, user_name,user_email,user_pass,reg_date,confirm,active,avatar,user_level) 
			                                               VALUES(:fname,:lname,:uname, :umail, :upass,:reg_date, :confirm, :active,:avatar,:user_level)");
													  
				$stmt->bindparam(":uname", $uname);
				$stmt->bindparam(":umail", $umail);
				$stmt->bindparam(":upass", $new_password);										  
				$stmt->bindparam(":fname", $fname);
				$stmt->bindparam(":lname", $lname);
				$stmt->bindparam(":reg_date", $reg_date);	
				$stmt->bindparam(":confirm", $confirm);
				$stmt->bindparam(":active", $active);
				$stmt->bindparam(":avatar", $avatar);
				$stmt->bindparam(":user_level", $user_level);
				$stmt->execute();	
				
				return $stmt;	
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}				
		}
	
		public function login($uname,$umail,$upass)
		{
			try
			{
				$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail LIMIT 1");
				$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
				if($stmt->rowCount() > 0)
				{
					if(password_verify($upass, $userRow['user_pass']))
					{
						$_SESSION['user_session'] = $userRow['user_id'];
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	
		public function is_loggedin(){
			if(isset($_SESSION['user_session'])){
				return true;
			}
		}
		
		public function redirect($url){
			header("Location: $url");
		}
	
		public function logout(){
			session_destroy();
			unset($_SESSION['user_session']);
			return true;
		}
		public function post_code($html, $css, $js, $user_id,$code_name){
			try
			{
				
				
				$stmt = $this->db->prepare("INSERT INTO codes(code_html, code_css,code_js,user_id,code_name) 
			                                               VALUES(:html,:css,:js,:user_id,:code_name)");
													  
				$stmt->bindparam(":html", $html);
				$stmt->bindparam(":css", $css);
				$stmt->bindparam(":js", $js);										  
				$stmt->bindparam(":user_id", $user_id);	
					$stmt->bindparam(":code_name", $code_name);	
				$stmt->execute();	
				
				return $stmt;	
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}				
		}
		public function generateRandomString($length = 10){
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    	$charactersLength = strlen($characters);
	    	$randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
	    	return $randomString;
		}
		
	}

	
?>