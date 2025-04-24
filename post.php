<?php 
include("connection.php"); 
include("php/config.php");  

// getting post variables
$message = $_POST['post']; 
$user_id = $_POST['user_id']; 
$username = $_POST['username'];  

// Initialize image name variable as null
$imagename = null;

if($_FILES['postimage']['error'] != 4){
    $imagename = $_FILES['postimage']['name'];
    $imagetmpname = $_FILES['postimage']['tmp_name'];
    
    // assigning new name to the image file
    $imageparts = explode(".", $imagename);
    $imageext = strtolower(end($imageparts));
    $imagename = uniqid().".".$imageext;
    
    $folder = "uploads/". $imagename;
    move_uploaded_file($imagetmpname, $folder);
}

// Set redirect if provided
if(isset($_POST['redirect'])){
    $redirect = $_POST['redirect']; 
}

// Check if message is empty and no image provided
if($message=="" && $_FILES['postimage']['error'] == 4){
    echo "<script>
        alert('Message Empty');
        window.location='".$home_page."account.php?username=".$username."';
    </script>";
    exit(); 
}

// storing post in database
if($imagename != null){
    $sql = "INSERT INTO `posts` (`uid`, `msg`, `image`, `type`, `dop`) VALUES (?, ?, ?, 'p', current_timestamp());";
    
    // prepare statements
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "iss", $user_id, $message, $imagename);
} else {
    $sql = "INSERT INTO `posts` (`uid`, `msg`, `type`, `dop`) VALUES (?, ?, 'p', current_timestamp());";
    
    // prepare statements
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "is", $user_id, $message);
}

// execute
$stmt->execute();

// displaying message and redirecting user back
if(isset($_POST['redirect'])){
    echo "<script>
        alert('Successfully! posted');
        window.location='".$redirect."';
    </script>"; 
} else {
    echo "<script>
        alert('Successfully! posted');
        window.location='".$home_page."account.php?username=".$username."';
    </script>";
}
?>