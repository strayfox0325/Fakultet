<?php
    //include-ujemo vezu sa bazom
    require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
    <!-- include-ujemo css, jquery i validaciju -->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <script type="text/javascript" src="js//jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/form-validation.js"></script>
        <title>Exam form</title>
    </head>
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
            <form action="ispiti.php" method="POST" name="ispiti-form">
            <h1>UNOS ISPITA</h1>

              <label for="naziv">Naziv</label>
              <input type="text" name="naziv" id="naziv" placeholder="Unesite naziv" required>
              
              <button type="submit" class="btn-submit" name="submit">Submit</button>
            </form>

            <!-- definisemo SQL upit koji nam vraca vrednosti iz tabele u BP i smestamo u $result -->
        <?php
        $sql = "SELECT id, naziv FROM Ispiti";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<th>ID</>";
            echo "<th>Naziv</th>";
             while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["naziv"] . "</td>";
                echo "</tr>";                            
            }
            echo "</table>";
        } else {
            echo "Nema rezultata";
        }
        // Unos polja u tabelu preko POST zahteva, pre unosa se koristi filter promenljiva koja filtrira unos
            if(isset($_POST['submit'])){
                $naziv=filter_var($_POST['naziv'],FILTER_SANITIZE_STRING);

                if($naziv==""){
                    echo '<script type="text/javascript">alert("Popunite polje!")</script>';
                }
                // Unos u bazu; pripremamo unos, koristimo placeholdere '?' na cije mesto preko bind_param vezujemo 
                // nase promenljive poslate preko POST-a i izvrsavamo upit 
                else{
                    $sql=$conn->prepare("INSERT INTO Ispiti (naziv) VALUES (?)");
                    $sql->bind_param('s',$naziv);
                    $sql->execute();
                }
            }
            $conn->close();
        ?>
          </div>
    </body>
</html>