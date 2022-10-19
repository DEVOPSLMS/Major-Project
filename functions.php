<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
	
		$query = "select * from user where user_id = '$id' limit 1";
	
		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}
	else{
		if(isset($_COOKIE['key'])){
			$token= $_COOKIE['key'];
			$query = "select * from user where check_token = '$token' limit 1";
			
			$result = mysqli_query($con,$query);
			if($result && mysqli_num_rows($result) > 0)
			{
				
				$data = mysqli_fetch_assoc($result);
				$_SESSION['user_id'] = $data['user_id'];
				return $data;
			}
		}
		else{
			header("Location: login.php");
			die;
		}
		
	}

	//redirect to login
	
}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}
function check_remmeber()
{

	if(isset($_COOKIE['key']))
	{
	
		header("Location:index.php");
		
	}

	//redirect to login
	header("Location: login.php");
	die;

}
?>