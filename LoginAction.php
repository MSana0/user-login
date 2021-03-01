<?php
session_start()
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Action</title>
</head>
<body>
	<?php
	$_SESSION['username']=$uname;
	$_SESSION['pass']=$pass;
	?>

</body>
</html>