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
        <!-- navbar meni sa linkovima -->
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
            <form action="studenti.php" method="POST" name="student-form">
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
                
              <button type="submit" class="btn-submit" name="submit">Submit</button>
             
            </form>


     <!-- definisemo SQL upit koji nam vraca vrednosti iz tabele u BP i smestamo u $result -->  
        <?php
        $sql = "SELECT id, ime, prezime, jmbg, broj_indeksa, godina_upisa FROM Studenti";
        $result = $conn->query($sql);
           if ($result->num_rows > 0) {
            echo "<table>";
            echo "<th>ID</>";
            echo "<th>Ime</th>";
            echo "<th>Prezime</th>";
            echo "<th>JMBG</th>";
            echo "<th>Broj indeksa</th>";
            echo "<th>Godina upisa</th>";
             while($row = $result->fetch_assoc()) {
                
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ime"] . "</td>";
                echo "<td>" . $row["prezime"] . "</td>";
                echo "<td>" . $row["jmbg"] . "</td>";
                echo "<td>" . $row["broj_indeksa"] . "</td>";
                echo "<td>" . $row["godina_upisa"] . "</td>";
                echo "</tr>";                            
            }
            echo "</table>";
        } else {
            echo "Nema rezultata";
        }
            if(isset($_POST['submit'])){
                $ime=filter_var($_POST['ime'], FILTER_SANITIZE_STRING);
                $prezime=filter_var($_POST['prezime'], FILTER_SANITIZE_STRING);
                $jmbg=filter_var($_POST['jmbg'],FILTER_SANITIZE_NUMBER_INT);
                $broj_indeksa=filter_var($_POST['broj_indeksa'],FILTER_SANITIZE_STRING);
                $godina_upisa=filter_var($_POST['godina_upisa'],FILTER_SANITIZE_NUMBER_INT);

                if($ime=="" || $prezime=="" || $jmbg=="" || $broj_indeksa=="" || $godina_upisa==""){
                    echo '<script type="text/javascript">alert("Popunite sva polja!")</script>';
                }
                else{
                // Unos u bazu; pripremamo unos, koristimo placeholdere '?' na cije mesto preko bind_param vezujemo 
                // nase promenljive poslate preko POST-a i izvrsavamo upit
                    $sql=$conn->prepare("INSERT INTO Studenti (ime, prezime, jmbg, broj_indeksa, godina_upisa) VALUES (?,?,?,?,?)");
                    $sql->bind_param('ssssi',$ime,$prezime,$jmbg,$broj_indeksa,$godina_upisa);
                    $sql->execute();
                    
                }
            }
            $conn->close();
        ?>
          </div>
    </body>
</html>