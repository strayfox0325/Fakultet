<?php
    //include-ujemo vezu sa bazom
    require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
            <!-- include-ujemo css, jquery i validaciju -->

        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <script type="text/javascript" src="js//jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/form-validation.js"></script>
        <title>Student form</title>
    </head>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="profesori.php">Profesori</a>
        <a href="smerovi.php">Smerovi</a>
        <a href="ispiti.php">Ispiti</a>
        <a href="polozeni_ispiti.php">Polozeno</a>

</div>

        <!-- izgled tabele za ispis rezultata iz baze -->
    <style>
        table,th,td {
        color: #fff;
        border : 1px solid white;
        border-collapse: collapse;
        }
        th,td {
        padding: 5px;
        }
</style>
    <body>
        <div class="main-div">
            <form action="" method="POST" id="student-form" name="student-form" >
            <h1>UNOS STUDENTA</h1>

              <label for="ime">Ime</label>
              <input type="text" name="ime" id="ime" placeholder="Unesite ime" required>
                
              <label for="prezime">Prezime</label>
              <input type="text" name="prezime" id="prezime" placeholder="Unesite prezime" required>
            
              <label for="jmbg">JMBG</label>
              <input type="text" name="jmbg" id="jmbg" placeholder="Unesite jmbg" required>
                
              <label for="broj_indeksa">Broj indeksa</label>
              <input type="text" name="broj_indeksa" id="broj_indeksa" placeholder="Unesite broj indeksa" required>

              <label for="godina_upisa">Godina upisa</label>
              <input type="number" name="godina_upisa" id="godina_upisa" placeholder="Unesite godinu upisa" required>
                
              <button type="submit" class="btn-submit" name="submit" id="submit">Submit</button>
           
        <br>
        <table>
            <tr>
                <th>Ime</th>
                <th>Prezime</th>
                <th>JMBG</th>
                <th>Broj indeksa</th>
                <th>Godina upisa</th>
            </tr>
                <tbody id="studenti">
                   
                </tbody>
        </table>
    <br>
    <button type="button" class="btn-refresh" name="refresh" id="refresh">Refresh</button>

    </form>
</div>
   <!-- $.ajax koji poziva php koji ucitava studente iz baze i prikazuje ih u tabelu, unosi novog studenta na 'submit' i dodaje ga na kraj tabele
        na 'refresh' se ponovo ucitava tabela -->
<script>
        $(document).ready(function(){
               $.ajax({
                    url:"ucitaj-studenta.php",
                    type:"get",
                    success: function(data){
                        $("#studenti").html(data);
                    }
               }); 
            $("#submit").click(function(){
                $.ajax({
                    url:"unesi-studenta.php",
                    type:"post",
                    data:$("#student-form").serialize(),
                });
            });
            $("#refresh").click(function(){
               $.ajax({
                    url:"ucitaj-studenta.php",
                    type:"get",
                    success: function(data){
                        $("#studenti").html(data);
                    }
               });
            });
        });

        </script>
    </body>
</html>
