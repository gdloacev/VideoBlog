<?php 
	class Index
	{
		//--------------Encryption Key-------------->>
		public $CryptKey = 'index!secure$key';
		//----------------Properties---------------->>
		public $UserId;
		public $UserName;
		public $FirstName;
		public $LastName;
		public $FullName;
		public $Mail;
		public $Status;
		public $DateFrom;
		//----------------Functions----------------->>
		public function ConnectDB()
		{
			$DB_Server = 'localhost';
			$DB_Database = 'martinvi_indexvideoblog';
			$DB_User = 'martinvi_dbUser';
			$DB_Password = 'dbPa$$';
			
			$DBConnection = mysql_connect($DB_Server,$DB_User,$DB_Password);
			
			if($DBConnection)
			{
				mysql_select_db($DB_Database,$DBConnection) or die(mysql_error());
				return $DBConnection;
			}
			else
			{
				return mysql_error($DBConnection);
			}
		} //Database Connection
		public function ValidateUser($User,$Password)
		{
			$DBConn = $this -> ConnectDB();
			
			$Query = 
			'select
				id,
				FirstName,
				LastName,
				concat_ws(\' \',FirstName, LastName) as \'FullName\',
				UserName,
				Mail,
				DateFrom,
				case
					when Active = 1 then \'Activo\'
					else \'Suspendido\'
				end as \'Status\'
			from 
				udtuser
			where
				UserName =  \'' . $User . '\'
				and Passwrd = aes_encrypt(\'' . $Password . '\',\'' . $this -> CryptKey . '\')';
			
			$Results = @mysql_query($Query,$DBConn) or die (mysql_error());
			
			if(@mysql_num_rows($Results) > 0)
			{
				$Record = @mysql_fetch_array($Results);
				$this -> UserID = $Record['id'];
				$this -> UserName = $Record['UserName'];
				$this -> FirstName = $Record['FirstName'];
				$this -> LastName = $Record['LastName'];
				$this -> FullName = $Record['FullName'];
				$this -> Mail = $Record['Mail'];
				$this -> Status = $Record['Status'];
				$this -> DateFrom = $Record['DateFrom'];				
				$_SESSION['Token_A'] = substr(session_id(),10,7);
				$_SESSION['Token_B'] = substr(session_id(),5,14);
				@mysql_free_result($Results);
				mysql_close($DBConn);
				return true; 
			}
			else
			{
				@mysql_free_result($Results);
				mysql_close($DBConn);
				return false;
			}
		}
	}
?>