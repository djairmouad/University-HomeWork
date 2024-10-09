<?php
if (isset($_POST["bulletin_list"])) {
    require_once("config.php");
    $id = $_POST["id"];
    $filiere = null;

    if (isset($_POST['filiere'])) {
        $filiereArray = $_POST['filiere'];
        $filiere = implode(',', $filiereArray);
    }

    $nomPrenom = $_POST['nom_prenom'];
    $connection = new PDO($dsn, $db_user, $db_password);

    $sql = "SELECT nom_prenom, filiere, SUM(coefficient * note) / SUM(coefficient) AS moyenne FROM module GROUP BY nom_prenom, filiere";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
}

$MAX = null;
$Min = null;
$Genrale = 0;
$Somme_coefficient = 0;
$Somme_coef_note = 0;
$Moyenne = 0;
$cof = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #36304a;
        color: white;
    }

    th:hover {
        background-color: #3c95e3;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    .resulte {
        display: flex;
        width: 50%;
        margin: 20px auto;
        justify-content: space-between;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }

    .resulte h3 {
        font-size: 17px;
        margin: 5px 0;
    }

    p {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
        color: #555;
    }
    #pieChart,
    #histogramChart {
        width: 50%;
    }

    #pieChart,
    #histogramChart,
    #Chartsuper,
    #pieChartsup,
    #chart2,
    #chart1 {
        width: 300px !important;
        height: 300px !important;
    }

    .chart {
        display: flex;
        flex-direction: row;
        justify-content: center;
        gap: 20px; /* Added gap between charts for better spacing */
        flex-wrap: wrap;
        margin: 20px auto; /* Added margin for better centering */
    }
</style>


</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Nom/Prenom</th>
                <th>Filiere</th>
                <th>Moyenne</th>
            </tr>
        </thead>
        <?php
        $previousName = null;

        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . $row['nom_prenom'] . "</td>";
            echo "<td>" . $row['filiere'] . "</td>";
            echo "<td>" . number_format($row['moyenne'], 2) . "</td>";
            echo "</tr>";
            $cof++;
            $Genrale += number_format($row['moyenne'], 2);
            $arrayMax[] = number_format($row['moyenne'], 2);
        }
        ?>
    </table>

    <!-- Output $MAX, $Min, and $Genrale after the loop -->
    <div>
        <h3>MAX: <?php echo max($arrayMax) ?></h3>
        <h3>Min: <?php echo min($arrayMax) ?></h3>
        <?php if ($cof !== 0): ?>
            <h3>General Average: <?php echo ($Genrale / $cof) ?></h3>
        <?php else: ?>
            <p>No data available for general average.</p>
        <?php endif; ?>
    </div>

    <button onclick="window.print()">Imprimer</button>
<button onclick="showStatistics()">Statistiques</button>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Define a variable to store the data
    let dataForCharts = [];

    function showStatistics() {
        // Check if data is already fetched
        if (dataForCharts.length === 0) {
            var myrequest = new XMLHttpRequest();

            <?php
            echo "let myarray = [];";

            foreach ($arrayMax as $value) {
                echo "myarray.push($value);";
            }

            echo "console.log(myarray);";
            ?>

            let superieur = myarray.filter(e => e > 10);
            console.log(superieur);

            // Filter values less than 10
            let inferieur = myarray.filter(e => e < 10);
            console.log(inferieur);
            let arr1=(myarray.filter(e => e <8)).length;
            let arr2=(myarray.filter(e => (e >8 && e<10))).length;
            let arr3=(myarray.filter(e => (e >10 && e<12))).length;
            let arr4=(myarray.filter(e => (e >12))).length;
            console.log(arr1);
            console.log(arr2);
            console.log(arr3);
            console.log(arr4);
            let Su = superieur.length;
            let inf = inferieur.length;
            console.log(Su);
            console.log(inf);
            let info = [Su, inf];
            let info2=[arr1,arr2,arr3,arr4]
            // Store data in the global variable
            dataForCharts = info;

            myrequest.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    try {
                        let data = JSON.parse(myrequest.responseText);
                        console.log(data);

                        // Extract data for labels and counts
                        var labels = data.map(entry => entry.cevilite);
                        var counts = data.map(entry => entry.unique_name_count);

                        var chartData = {
                            labels: labels,
                            datasets: [{
                                data: counts,
                                backgroundColor: ['pink', 'blue'],
                            }]
                        };

                        var hello = {
                            labels: ["superieur then 10", "inferieur then 10"],
                            datasets: [{
                                data: info,
                                backgroundColor: ['limegreen', 'orange'],
                            }]
                        };
                        var hello2 = {
                            labels: ["from 0 to 8", "from 8 to 10","from 10 to 12","superieur then 12"],
                            datasets: [{
                                data: info2,
                                backgroundColor: ['green', 'red','limegreen','orange'],
                            }]
                        };

                        // Create charts
                        var pieChart = new Chart(document.getElementById('pieChart'), {
                            type: 'pie',
                            data: chartData,
                        });
                        var pieChartsup = new Chart(document.getElementById('pieChartsup'), {
                            type: 'pie',
                            data: hello,
                        });
                        var hi2= new Chart(document.getElementById('chart2'), {
                            type: 'pie',
                            data: hello2,
                        });

                        var histogramChart = new Chart(document.getElementById('histogramChart'), {
                            type: 'bar',
                            data: chartData,
                        });

                        // Chart for values greater than 10
                        var Chartsuper = new Chart(document.getElementById('Chartsuper'), {
                            type: 'bar',
                            data: hello,
                        });
                        var hi1=new Chart(document.getElementById('chart1'), {
                            type: 'bar',
                            data: hello2,
                        });
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                } else if (this.status !== 200) {
                    console.error("Error fetching data. Status:", this.status);
                }
            };

            myrequest.open("GET", "design.php", true);
            myrequest.send();
        } else {
            // If data is already fetched, create charts using the existing data
            createCharts(dataForCharts);
        }
    }

    // Function to create charts using the provided data
    function createCharts(data) {
        // ... (similar code as in the showStatistics function)
    }
</script>
<div class="chart">
    <div>
        <canvas id="pieChart" width="100" height="100"></canvas>
    </div>
    <div>
        <canvas id="histogramChart" width="100" height="100"></canvas>
    </div>
    <div>
        <canvas id="Chartsuper" width="100" height="100"></canvas>
    </div>
    <div>
        <canvas id="pieChartsup" width="100" height="100"></canvas>
    </div>
    <div>
        <canvas id="chart1" width="100" height="100"></canvas>
    </div>
    <div>
        <canvas id="chart2" width="100" height="100"></canvas>
    </div>
</div>



</body>

</html>
