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
				$stmt = $this->db->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail  LIMIT 1");
				$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
				if($stmt->rowCount() > 0)
				{
					if(password_verify($upass, $userRow['user_pass']))
					{
						$_SESSION['user_session'] = $userRow['user_id'];
						$user_id = $_SESSION['user_session'];
						$stmt = $this->db->prepare("UPDATE users set last_logged_in=NOW() where user_id=$user_id");
						$stmt->execute();
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
		public function update_code($html, $css, $js, $user_id,$code_id){
			try
			{
				
				
				$stmt = $this->db->prepare("UPDATE  codes set code_html=:html, code_css=:css,code_js=:js,user_id=:user_id where code_id=:code_id");
			                                               
													  
				$stmt->bindparam(":html", $html);
				$stmt->bindparam(":css", $css);
				$stmt->bindparam(":js", $js);										  
				$stmt->bindparam(":user_id", $user_id);	
				$stmt->bindparam(":code_id", $code_id);
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
		 function get_timeago( $ptime )
			{
			    $etime = time() - $ptime;

			    if( $etime < 1 )
			    {
			        return 'less than 1 second ago';
			    }

			    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
			                30 * 24 * 60 * 60       =>  'month',
			                24 * 60 * 60            =>  'day',
			                60 * 60             =>  'hour',
			                60                  =>  'minute',
			                1                   =>  'second'
			    );

			    foreach( $a as $secs => $str )
			    {
			        $d = $etime / $secs;

			        if( $d >= 1 )
			        {
			            $r = round( $d );
			            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
			        }
			    }
			}

		
	}

	
?>