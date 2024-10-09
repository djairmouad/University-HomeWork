<?php
if (isset($_POST["list_users"])) {
    require_once("config.php");

    try {
        $connection = new PDO($dsn, $db_user, $db_password);

        $sql = "SELECT * FROM users";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo 'Error: ' . $error->getMessage();
    }
}
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

        th,
        td {
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
            width: 300px !important;
            height: 300px !important;
        }

        .chart {
            display: flex;
            flex-direction: row;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>email</th>
                <th>password</th>
                <th>role</th>
            </tr>
        </thead>
        <?php
        if (isset($result)) {
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['mdp'] . "</td>";
                echo "<td>" . $row['role'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

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

            myrequest.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    try {
                        let data = JSON.parse(myrequest.responseText);
                        console.log(data);

                        // Extract data for labels and counts
                        var labels = data.map(entry => entry.role);
                        var counts = data.map(entry => entry.unique_name_count);

                        var chartData = {
                            labels: labels,
                            datasets: [{
                                data: counts,
                                backgroundColor: ['pink', 'blue', 'green', 'orange'], // Add colors for additional roles
                            }]
                        };
                        // Create charts
                        var pieChart = new Chart(document.getElementById('pieChart'), {
                            type: 'pie',
                            data: chartData,
                        });
                        var histogramChart = new Chart(document.getElementById('histogramChart'), {
                            type: 'bar',
                            data: chartData,
                        });
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                    }
                } else if (this.status !== 200) {
                    console.error("Error fetching data. Status:", this.status);
                }
            };

            myrequest.open("GET", "users_design.php", true);
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

    <!-- <div class="chart">
        <div>
            <canvas id="pieChart" width="300" height="300"></canvas>
        </div>
        <div>
            <canvas id="histogramChart" width="300" height="300"></canvas>
        </div>
    </div> -->
</body>

</html>
