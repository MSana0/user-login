<!DOCTYPE html>
<html>
<head>
	<title>Login Action</title>
</head>
<body>
	<?php

            $username = $pw ="";
            $unameerr = $passerr ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['uname'])) {                    
                    $unameerr = "Please Fill up the Username!";
                }

                else if(empty($_POST['pw'])) {                    
                    $passerr = "Please Fill up the password!";
                }

                else {
                    $username = $_POST['uname'];
                    $password = $_POST['pass'];

                    $log_file = fopen("store.txt", "r");
                    
                    $data = fread($log_file, filesize("store.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $username && $json_decode['pw'] == $pw) 
                        {
                            session_start();
                            $_SESSION['user'] = $username;
                            header("Location: info.php");
                        }
                    }
                    echo "Wrong Password! Please Try Again.";
                }
            }
        ?>
</form>

</body>
</html>