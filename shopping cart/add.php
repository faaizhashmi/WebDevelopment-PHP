<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<html>
<head>
	<title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("connection.php");

$target_dir = "uploads/";
$uploadName = $_FILES["fileToUpload"]["name"];
$uploadOk = 1;
$uploadArray = explode('.', $uploadName);
$fileName=$uploadArray[0];
$fileExt=$uploadArray[1];
$newFile=$fileName."_".time().".".$fileExt;
$target_file = $target_dir . $newFile;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
	$qty = $_POST['qty'];
	$price = $_POST['price'];
	$loginId = $_SESSION['id'];


    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

	// checking empty fields
	if(empty($name) || empty($qty) || empty($price) || $uploadOk == 0) {
				
		if(empty($name)) {
			echo "Name field is empty.<br/>";
		}
		
		if(empty($qty)) {
			echo "Quantity field is empty.<br/>";
		}
		
		if(empty($price)) {
			echo "Price field is empty.<br/>";
		}
		if($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br/>";
		}

		//link to the previous page
		echo "<br/><a href='view.php'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		if($con->query("INSERT INTO products(name, qty, price,image, login_id) VALUES('$name','$qty','$price','$newFile' , '$loginId')")==true){
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                header("location:view.php");
                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
		}
		else
            echo "Error in uploading product";
	}
}
?>
</body>
</html>
