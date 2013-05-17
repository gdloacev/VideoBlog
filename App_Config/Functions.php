<?php 
	function Value($Name, $Type)
	{
		if($Type == 'S')
		{
			if(isset($_SESSION[$Name]))
			{
				return $_SESSION[$Name];
			}
		}
		if($Type == 'P')
		{
			if(isset($_POST[$Name]))
			{
				return $_POST[$Name];
			}
		}
	}
?>
