<?php

//Access: Admin
//Purpose: dashboard that exposes system informations

include 'connect_db.php';
$a = array();
$month = [];
$restriction = [];
$flag = 1;
$sql = "SELECT month(date) as month,count(*) as nor 
		FROM restriction 
		GROUP by Month(date) ORDER BY Month(date);";
$run = $dbh->prepare($sql);
$run->execute();
while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
    $month[] = $row['month'];
    $restriction[] = $row['nor'];
}
for ($i = 1;$i < 13;$i++) {
    $flag = 1;
    for ($j = 0;$j < count($month);$j++) {
        if ($i == $month[$j]) {
            $a[$i - 1] = $restriction[$j];
            $flag = 0;
            break;
        }
    }
    if ($flag == 1) $a[$i - 1] = 0;
}
?>



<canvas id="bar-chart" ></canvas>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


 <script>
new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: [<?php echo $jan; ?>, <?php echo $feb; ?>, <?php echo $mar; ?>, <?php echo $apr; ?>, <?php echo $may; ?>,<?php echo $jul; ?>,<?php echo $jun; ?>,<?php echo $aug; ?>,<?php echo $sep; ?>,<?php echo $oct; ?>,<?php echo $nov; ?>,<?php echo $dec; ?>],
      datasets: [
        {
          label: "",
          backgroundColor: ["#f032e6", "#800000","#9A6324","#808000","#469990","#000075", "#e6194B","#f58231","#ffe119","#bfef45","#3cb44b","#42d4f4"],
          data: [<?php echo "$a[0]"; ?>,<?php echo "$a[1]"; ?>,<?php echo "$a[2]"; ?>,<?php echo "$a[3]"; ?>,<?php echo "$a[4]"; ?>,<?php echo "$a[5]"; ?>,<?php echo "$a[6]"; ?>,<?php echo "$a[7]"; ?>,<?php echo "$a[8]"; ?>,<?php echo "$a[9]"; ?>,<?php echo "$a[10]"; ?>,<?php echo "$a[11]"; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text:<?php echo $chartLabel; ?>
      }
    }
});
</script>