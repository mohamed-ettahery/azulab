<?php 
require('includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
function getCount ($con,$table)
{
    $query ="SELECT count(*) as count FROM $table";
    $results = mysqli_query($con,$query);
    $row = $results->fetch_assoc();
    echo $row['count'];
}
?>
<div class="container-fluid">
        <div class="row mt-4">
            <div class="col-sm-3 co-md-4 sidebar">
            <?php 
                require('includes/sidebar.php');
            ?>
            </div>
            <div class="col-sm-6 col-md-8 mr-3 main">
                <h2 class="text-info"> Statistiques </h2>
                <hr>
                <body>
                        <div id="chart" style="width: 900px; height: 500px;"></div>
                </body>
            </div>
        </div>
        
</div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Produits', <?php echo getCount($con,"produit"); ?> ],
          ['Categories', <?php echo getCount($con,"categorie"); ?>],
          ['Sous Categories', <?php echo getCount($con,"sous_categorie"); ?> ],
          ['Devis', <?php echo getCount($con,"devis"); ?> ]
        ]);

        var options = {
          title: 'Mon panel Stats',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <?php
    require('includes/footer.php');
?>