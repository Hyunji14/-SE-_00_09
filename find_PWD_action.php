<?php
        $conn = mysqli_connect("127.0.0.1", "root", "1q2w3e4r", "blackit");

        if( mysqli_connect_errno()){
                        echo "MySQL Database connect Failed : " . mysqli_connect_error();
        }

        $user_Name = $_POST['user_Name'];
        $user_ID = $_POST['user_ID'];
        $user_Email = $_POST['user_Email'];

        $check_ID_query = "select user_passwd from user where user_Name='$user_Name' and user_Email='$user_Email' and user_ID = '$user_ID'";
        $check_result = mysqli_query($conn, $check_ID_query);
        $exist_passwd = mysqli_fetch_row($check_result);


        if( $exist_passwd[0] == null){
                echo "<script>alert('ID is not exist.');</script>";
                echo "<script>location.href='find_PWD.html';</script>";
        }
        else{
                echo "<script>alert('Your Password is \"$exist_passwd[0]\".');</script>";
                echo "<script>location.href='login.html';</script>";
        }
?>

