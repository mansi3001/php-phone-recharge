

<?php 
//index.php
$conn = mysqli_connect("localhost", "root", "Jay@1234", "phonerecharge");
$query = "SELECT rupee, date FROM recharge ";
$result = mysqli_query($conn, $query);
$chart_data = '';
while($row = mysqli_fetch_array($result))
{
 $chart_data .= "{ date:'".$row["date"]."', rupee:".$row["rupee"]."}, ";
}
$chart_data = substr($chart_data, 0, -2);
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>
    <div class="container" style="width:900px;">
       <br><br> <h1 class="text-center">Graph</h1><br><br>
        <div id="chart"></div>
    </div>
<br><br>
    <div class="container">
        <button class="btn btn-warning btn-sm"><a href="adminRechargerequest.php" style="text-decoration: none; color: #333;">Back to Recharge Request Page</a></button>
    </div>
</body>

<script type="text/javascript">
    Morris.Bar({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        xkey: 'date',
        ykeys: ['rupee'],
        labels: ['rupee'],
        hideHover: 'auto',
        stacked: true
    });
</script>

</html>
