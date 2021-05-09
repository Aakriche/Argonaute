<?php
if(isset($_POST["add-submit"])){
    
    $servername = "localhost";
    $dBUsername = "root";
    $dBPassword = "";
    $dBName = "wild";
    $conn = new PDO("mysql: host={$servername}; dbname={$dBName}",$dBUsername, $dBPassword);

    if(!$conn) {
        die("Connection Failed".mysqli_connect_error());
    }

    $nom = $_POST["name"];
    $princ = $_POST["princ"];
    $sec = $_POST["sec"];


    if(empty($nom) || !preg_match("/^[a-zA-Z0-9]*$/", $nom)){
        header("Location: ../Index.php?error=invalidnom");
        exit();
    } else if ( empty($princ) || !preg_match('/^[a-zA-Z0-9éèùàï]*$/', $princ)){
        header("Location: ../Index.php?error=invalidqualit");
        exit();
    }else if (!preg_match('/^[a-zA-Z0-9Ü-üéèùàï]*$/', $sec)){
        header("Location: ../Index.php?error=invalidqualit");
        exit();
    }else{
        $sql = "SELECT * FROM argonautes;";
        $res = $conn->query($sql);
        $resultCheck = $res->rowCount();
        if($resultCheck === 50){
            header("Location: ../Index.php?error=fullargo");
            exit();
        }else{
            $sql = "SELECT nom FROM argonautes WHERE nom='".$nom."';";
            $res = $conn->query($sql);
            if(!$res){
                header("Location: ../Index.php?error=sqlerrora");
                exit(); 
            }else{
                $resultCheck = $res->rowCount();

                if($resultCheck > 0){
                    header("Location: ../Index.php?error=usernametaken");
                    exit();
                }else{
                    $sql = "INSERT INTO argonautes(nom,qualite_princ,qualite_sec) VALUES ('".$nom."','".$princ."','".$sec."');";
                    $res = $conn->query($sql);

                    if(!$res){
                        header("Location: ../Index.php?error=sqlerror");
                        exit(); 
                    }else{
                        header("Location: ../msg/AddMembre.msg.php?signup=success");
                        exit();
                    }


                }
            }


        }

    }
    $conn ->close();



}else{
    header("Location: ./Index.php");
    exit();
}