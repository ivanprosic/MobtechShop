<?php
            
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mobtech";

        $connect = mysqli_connect($servername, $username, $password, $dbname);
        if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
        }
        $email = '';
        $password = '';
        $passwordsql = '';
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];

        $provera = "SELECT password FROM administratori WHERE email = '$email'";
        $rezultat = mysqli_query($connect, $provera);
        if (mysqli_num_rows($rezultat) == true) {

        //vraca tacan odgovor
        while($row = mysqli_fetch_assoc($rezultat)) {
            $passwordsql =  $row["password"];
        }

        }
        else {
            echo "";
        }

        if($password == $passwordsql)
        {
            $_SESSION['user'] = $email;
            $_SESSION['pass'] = $password;
            header('location:adminpanel.php');
        }
        else
        {
            header('location:losasifra.html');
        }

        mysqli_close($connect);
?>