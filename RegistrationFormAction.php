<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>

	<h1>Registration Form</h1>

	<?php 
	$firstname=$lastname=$gender=$email=$uname=$pass=$re="";
    $fnameerr=$lnameerr=$gendererr=$emailerr=$unameerr=$passerr=$reerr=$notavailable="";

	if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['firstname']) && empty($_POST['lastname']) && empty($_POST['male']) && empty($_POST['email']) && empty($_POST['female']) && empty($_POST['uname']) && empty($_POST['pass']) && empty($_POST['re'])) {
				echo "Please fill up the form properly";
			} 
			else {
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$gender = $_POST['gender'];
				$mail = $_POST['mail'];
				$username = $_POST['username'];
				$pw = $_POST['pw'];
				$email = $_POST['email'];
				echo "Client name is: $fname $lname";

				$f=fopen("store.txt", "a");
				fwrite($f, $fname." ".$lname." ".$gender." ".$mail." ".$username." ".$pw." ".$email);
        

                    $log_file = fopen("store.txt", "r");
                    
                    $data = fread($log_file, filesize("store.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);

                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);

                        if( $json_decode['username'] == $username ) 
                        {
                            $notavailable = "Username not available!";
                        }
                        else {                       
                            $details = array('fname' => $fname, 'lname' => $lname, 'gender' => $gender, 'email' => $email, 'username' => $username, 'pw' => $pw, 're' => $re);
                            $details_encoded = json_encode($details);

                            $filepath = "Reg.txt";

                            $reg_file = fopen($filepath, "a");
                            fwrite($reg_file, $details_encoded . "\n");	
                            fclose($reg_file);

                            $usertable = array('username' => $username, 'pw' => $pw);
                            $usertable_encoded = json_encode($usertable);

                            $log_filepath = "store.txt";

                            $log_file = fopen($log_filepath, "a");
                            fwrite($log_file, $usertable_encoded . "\n");
                            fclose($log_file);

                            $_SESSION['message'] = "You have clicked on button successfully";

                            header('Location: LoginAction.php');
                            }
                        }
                    }
            }
        ?>

</body>
</html>