 <?php session_start(); ?>   
<?php


    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mobtech";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error){
        die("Konekcija nije uspela:".$conn->connect_error);
    }
   
    $Ime = ""; 
    $Telefon = "";
    $Adresa = "";
    $Paket = "";
    
    
    
    $Ime =   $_REQUEST["Ime_i_Prezime"];
    $Telefon =  $_REQUEST["Telefon"];
    $Adresa =  $_REQUEST["Adresa"];
    $Paket =  $_REQUEST["Paket"];
  

    
    $zamena = "INSERT INTO kupac (Ime_i_Prezime, Telefon, Adresa, Paket)
    VALUES ( '$Ime', '$Telefon', '$Adresa','$Paket')";
        if ($conn->query($zamena) === TRUE) {
        header("Location: uredjaji.html");
    } else {
        echo "Error: " . $zamena . "<br>" . $conn->error;
    }


    $sql_read =  "SELECT Ime_i_Prezime, Telefon, Adresa, Paket, FROM kupac";
        $result = $conn->query($sql_read);
        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
            //echo "id: " . $row["pitanje"]. " - Name: " . $row["odgovori1"]. " " . $row["odgovori2"]. "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();

?>