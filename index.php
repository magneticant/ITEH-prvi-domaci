<?php

require "DBBroker.php";
require "model/korisnik.php";

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $upass = $_POST['password'];
    $user_id = 1;
 
    $korisnik = new Korisnik ($user_id, $uname, $upass);
    $broker = DBBroker::instance('localhost', $korisnik->kor_ime, $korisnik->sifra, 'itehprvidomaci');
    $conn = $broker->conn;
    $odgUpita = Korisnik::prijavi_korisnika($korisnik, $conn);


    if ($odgUpita->num_rows == 1) {
        $_SESSION['user_id'] = $korisnik->sifra;
        header('Location: home.php');
    
        exit();
    }else{
        echo('
        <script>
            window.alert("Neispravan login!");
            console.log("Niste se ulogovali");
        </script> ');
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Prijava doktorskog pregleda</title>

</head>

<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnik</label>
                    <input type="text" name="username" class="form-control" required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavite se</button>
                </div>

            </form>
        </div>


    </div>
</body>

</html>