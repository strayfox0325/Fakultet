<?php
      //include-ujemo vezu sa bazom
            require 'dbconfig/config.php';
            
        // Unos polja u tabelu preko POST zahteva, pre unosa se koristi filter promenljiva koja filtrira unos
        
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
      
      $conn->close();
?>