    <?php
    require "DBBroker.php";
    require "model/korisnik.php";
    require "model/prijava.php";
    require "model/doktor.php";

    session_start();
    
    $user_id = (int)$_COOKIE['userSpecificID'];
    // $user_id = (int)$_SESSION['user_id'];
    $broker = DBBroker::instance('localhost', 'root', '', 'itehprvidomaci');
    $conn = $broker->conn;
    $rezultat = Prijava::selectAll($conn, $user_id);
    
if (!$rezultat) {
    echo('<script> alert("Nemate nijednu prijavu.");</script>');
    die();
}
if ($rezultat->num_rows == 0) {
    echo('<script> alert("Nemate nijednu prijavu.");</script>');
}
   // die();
// } else { 
    
    ?>
    

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <title>Zakazivanje doktorskog pregleda</title>

    </head>

    <body>


        <div class="naslov" style="color: black;">
            <h1>Doktorska ordinacija</h1>
        </div>
        <br>
        
        <div class="row" style="background-color: rgba(50, 205, 50, 0.5);">
             <div class="col-md-4">
                <button id="dugmeOsvezi" class="btn" onclick="funkcijaOsvezi()" style=" border: 1px solid white; "> Osvezi stranicu</button>
            </div> 
            <div class="col-md-4">
                <button id="dugmeDodaj" type="button" class="btn" style=" border: 1px solid white;" data-toggle="modal" data-target="#zakaziModal1"> Zakazi pregled</button>
            </div>
            <div class="col-md-4">
                <button id="dugmePretrazi" class="btn" onclick="funkcijaPrikaziInput()" style="border: 1px solid white;"> Pretrazi zakazani pregled</button>
                <input type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi zakazivanja po imenu doktora." hidden>
            </div>
            <div class="col-md-4">
                <button id="dugmeObrisi" class="btn" style=" border: 1px solid white; "> Obrisi zakazivanje</button>
            </div>
        </div>
        <br>
        <!-- <form id="hiddenForm" method="post" action = "#">
        <input type= "checkbox" id="deleteAllCheck" style="display:none" method="post" name="key" type = "submit" onchange="this.form.submit();">
        </form> -->
        <div id="pregled" class="panel panel-success" style="margin-top: 1%;">

            <div class="panel-body">
                <table id="tabelaOrd" class="table table-hover table-striped" style="color: black; background-color: darkolivegreen;">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Ime i prezime doktora</th>
                            <th scope="col">Odeljenje</th>
                            <th scope="col">Sala</th>
                            <th scope="col">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $rezultat->fetch_array()) {
                            // var_dump($red);
                            $i = 0;
                            $resSet = Doktor::selectSpecificDoctorByID($conn, $red['id_doktora']);
                            // var_dump($resSet);                 
                        ?>
                            <tr id="tabelaSvihPrijava">
                                <td><?php echo $resSet[$i]['ime_prez']?></td>
                                <td><?php echo $red["odeljenje"] ?></td>
                                <td><?php echo $red["sala"] ?></td>
                                <td><?php echo $red["datum"] ?></td>
                                
                            <?php $i++; ?>        
                                <td>
                                    <label class="custom-radio-btn">
                                        <input type="radio" name="checked-donut" value=<?php echo $red["id_prijave"] ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                            </tr>
                         
                    <?php
                        } 

                    ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-1" style="text-align: right">
                        
                    </div>

                    <div class="col-md-12" style="text-align: right">
                        <button id="brisanje_dugme" method="post" class="btn btn-danger" style="background-color: red; border: 1px solid white;" name="key">Obrisi sve</button>
                    </div>

                    <div class="col-md-2" style="text-align: right; color: blue">
                        <button id="sortiranje_dugme" class="btn btn-normal" onclick="sortTable()">Sortiraj</button>
                    </div>
                    
                </div>
                
            </div>
        </div>

        <!-- Novi modal -->
       
       <!-- Modal -->
        <div class="modal fade" id="zakaziModal1" role="dialog">
            <div class="modal-dialog">

                <!--Sadrzaj modala-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="dodajForm">
                                <h3 style="color: black; text-align: center">Zakazi pregled</h3>
                                <div class="row">
                                    <div class="col-md-11 ">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Ime i prezime lekara</label>
                                            <input type="text" style="border: 1px solid black" name="imeIPrezimeLekara" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Odeljenje</label>
                                            <input type="text" style="border: 1px solid black" name="odeljenje" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sala">Sala</label>
                                            <input type="sala" style="border: 1px solid black" name="sala" class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Datum</label>
                                                <input type="date" style="border: 1px solid black" name="datum" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color: orange; border: 1px solid black;">Zakazi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>



        </div>

        <!-- Modal -->
        <div class="modal fade" id="zakaziModal" role="dialog">
        
            <div class="modal-dialog">

                <!--Sadrzaj modala-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="dodajForm">
                                <h3 style="color: black; text-align: center">Zakazi pregled</h3>
                                <div class="row">
                                    <div class="col-md-11 ">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="">Ime i prezime lekara</label>
                                            <input type="text" style="border: 1px solid black" name="imeIPrezimeLekara" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="">Odeljenje</label>
                                            <input type="text" style="border: 1px solid black" name="odeljenje" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sala">Sala</label>
                                            <input type="sala" style="border: 1px solid black" name="sala" class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Datum</label>
                                                <input type="date" style="border: 1px solid black" name="datum" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color: orange; border: 1px solid black;">Zakazi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>



        </div>


        <!-- test modal -->
        <div class="modal fade" id="izmeniModal1" role="dialog">
            <div class="modal-dialog">

                <!--Sadrzaj modala-->
                <div class="modal-content">
                    <h1>Modal radi</h1>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="izmeniModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal sadrzaj-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form">
                            <form action="#" method="post" id="izmeniForm">
                                <h3 style="color: black">Izmeni prijavu</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="id" type="text" name="id" class="form-control" placeholder="Id *" value="" readonly />
                                        </div>
                                        <div class="form-group">
                                            <input id="predmet" type="text" name="imeIPrezimeDoktora" class="form-control" placeholder="Ime i prezime doktora*" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="katedra" type="text" name="odeljenje" class="form-control" placeholder="Odeljenje *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="sala" type="text" name="sala" class="form-control" placeholder="Sala *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="datum" type="date" name="datum" class="form-control" placeholder="Datum *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="color: white; background-color: orange; border: 1px solid white"> Izmeni
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                </div>
            </div>



        </div>

        <!-- </div> -->


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    
        <script>
        
        function sortTable(){
            let redovi, i, j, a, b;
            let tabela = document.getElementById("tabelaOrd");
            redovi = tabela.rows;
            for(i = (redovi.length-1);i>0 ;i--){
                console.log(""+redovi.length-1);
                for(j = 1;j< i;j++){
                    console.log("vrednost i je " +i);
                    console.log("vrednost j je "+ j);
                    console.log("vrednost red len -1 je " + redovi.length-1);
                    a = redovi[j].getElementsByTagName("TD")[1];
                    b = redovi[j + 1].getElementsByTagName("TD")[1];
                    aUpper = a.innerHTML.toUpperCase();
                    bUpper = b.innerHTML.toUpperCase();
                    if(aUpper > bUpper){
                        redovi[j].parentNode.insertBefore(redovi[j + 1], redovi[j]);
                        console.log("swap se desio.");
                    }
                }
            }
            window.alert("Tabela je sortirana.");
        }
        
        function funkcijaZaPretragu() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("tabelaOrd");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (td.textContent.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        
        function funkcijaPrikaziInput(){
           // alert("radi funkcija");
            document.getElementById("myInput").style.display = "inline";
        }
        function funkcijaOsvezi(){
            location.reload(true);
        }
    </script>
    

    </body>

    </html>