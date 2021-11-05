    <?php
    //include-ujemo vezu sa bazom
            require 'dbconfig/config.php';

            //definisemo SQL upit koji nam vraca vrednosti iz tabele u BP i smestamo u $result

                $sql = "SELECT * FROM Studenti";
                $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                         while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ime"] . "</td>";
                            echo "<td>" . $row["prezime"] . "</td>";
                            echo "<td>" . $row["jmbg"] . "</td>";
                            echo "<td>" . $row["broj_indeksa"] . "</td>";
                            echo "<td>" . $row["godina_upisa"] . "</td>";
                            echo "</tr>";                                      
                        }
                    } else {
                        echo "Nema rezultata";
                    }
            $conn->close();
    ?>