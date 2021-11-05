<!-- include-ujemo vezu sa bazom -->

<?php
    require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
        <!-- include-ujemo css, jquery, validaciju i datepicker plugin -->
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style2.css">
        <script type="text/javascript" src="js//jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="js/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/form-validation.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script type="text/javascript" src="js/datepicker.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
        <title>Passed exams form</title>
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
            <form action="polozeni_ispiti.php" method="POST" name="polozeni-form">
            <h1>UNOS POLOZENIH ISPITA</h1>
    <br>
    <!-- definisemo SQL upit koji nam vraca vrednosti iz tabele u BP i smestamo u $result;
                korisitmo select i option tagove za padajucu listu-->

              <label for="student">Student</label>
              <select name="stud_id">
              <option disabled selected>Izaberite studenta</option>
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM Studenti");
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '<option value="' . $row['id'] . '">' . $row['ime'] . ' ' . $row['prezime'] .' ' .$row['broj_indeksa'].'/'.$row['godina_upisa']. '</option>';
                        }	
                    ?>  
            </select>
       
              <label for="profesor">Profesor</label>
                <select name="prof_id">
                    <option disabled selected>Izaberite profesora</option>
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM Profesori");
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value='". $row['id'] ."'>" .$row['ime'] .' ' .$row['prezime']. "<br>". "</option>";
                        }	
                    ?>  
                </select>
        
            <label for="ispit">Ispit</label>
                <select name="ispit_id">
                    <option disabled selected>Izaberite ispit</option>
                    <?php
                        $result = mysqli_query($conn, "SELECT * FROM Ispiti");
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<option value='". $row['id'] ."'>" .$row['naziv'] ."<br>". "</option>";
                        }	
                    ?>  
                </select>
       
        <label for="datum">Datum polaganja</label>
        <input type="text" name="datum" id="datepicker" placeholder="Unesite datum">
        <br>
        <label for="ocena">Ocena</label>
        <input type="number" name="ocena" id="ocena" placeholder="Unesite ocenu" >
        <br><br>
        <button type="submit" class="btn-submit" name="submit">Submit</button>
    </form>

        <?php 
        /* Vracamo redove iz tabele Polozeni_ispiti koje smo JOIN-ovali preko id sa drugim tabelama 
        cije su nam kolone potrebne za prikaz i ispisujemo */

            $sql = "SELECT Polozeni_ispiti.id, CONCAT(Studenti.ime,' ',Studenti.prezime) AS 'student', CONCAT(Profesori.ime,' ',Profesori.prezime) AS 'profesor',Ispiti.naziv AS 'ispit', datum, ocena FROM Polozeni_ispiti 
            JOIN Studenti ON Polozeni_ispiti.student_id=Studenti.id JOIN Profesori ON Polozeni_ispiti.profesor_id=Profesori.id 
            JOIN Ispiti ON Polozeni_ispiti.ispit_id=Ispiti.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<th>ID polaganja</>";
                echo "<th>Student</th>";
                echo "<th>Profesor</th>";
                echo "<th>Ispit</th>";
                echo "<th>Datum</th>";
                echo "<th>Ocena</th>";

                 while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["student"] . "</td>";
                    echo "<td>" . $row["profesor"] . "</td>";
                    echo "<td>" . $row["ispit"] . "</td>";
                    echo "<td>" . $row["datum"] . "</td>";
                    echo "<td>" . $row["ocena"] . "</td>";
                    echo "</tr>";                            
                }
                echo "</table>";
            } else {
                echo "Nema rezultata";
            }
    
    // Unos polja u tabelu preko POST zahteva, pre unosa se koristi filter promenljiva koja filtrira unos

    if(isset($_POST['submit'])){
        $stud_id=filter_var($_POST['stud_id'],FILTER_SANITIZE_NUMBER_INT);
        $prof_id=filter_var($_POST['prof_id'],FILTER_SANITIZE_NUMBER_INT);
        $ispit_id=filter_var($_POST['ispit_id'],FILTER_SANITIZE_NUMBER_INT);
        $datum=$_POST['datum'];
        $ocena=filter_var($_POST['ocena'],FILTER_SANITIZE_NUMBER_INT);

        if($stud_id=="" || $prof_id=="" || $ispit_id=="" || $datum=="" || $ocena==""){
            echo '<script type="text/javascript">alert("Popunite sva polja!")</script>';
        }
        // Unos u bazu; pripremamo unos, koristimo placeholdere '?' na cije mesto preko bind_param vezujemo 
        // nase promenljive poslate preko POST-a i izvrsavamo upit
        else{
            $sql=$conn->prepare("INSERT INTO Polozeni_ispiti (student_id,profesor_id,ispit_id,datum,ocena)
            VALUES (?,?,?,?,?)");
            $sql->bind_param('iiisi',$stud_id, $prof_id, $ispit_id, $datum, $ocena);
            $sql->execute();
        }
    }
    $conn->close();
    ?>

        </div>
    </body>
</html>


