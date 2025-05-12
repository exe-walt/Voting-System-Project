<?php 
<?php
	$studentID = $_POST['studentID'];
	$studentPin = $_POST['studentPin'];


	// Database connection
	$conn = new mysqli('localhost','root','','onlinevoting');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into login(studentId, studentPin) values(?, ?)");
		$stmt->bind_param("sssssi", $studentID, $studentPin);
		$execval = $stmt->execute();
		echo $execval;
		echo "Login successfully...";
		$stmt->close();
		$conn->close();
	}
?>
