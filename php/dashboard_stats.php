<?php

//Access: Admin
//Purpose: dashboard that exposes system informations

include 'connect_db.php';
include 'language.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
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
  
  echo '<canvas id="bar-chart" ></canvas>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script>
  new Chart(document.getElementById("bar-chart"), {
      type: "bar",
      data: {
        labels: ['; echo $jan.','.$feb.','.$mar.','.$apr.','.$may.','.$jul.','.$jun.','.$aug.','.$sep.','.$oct.','.$nov.','.$dec; echo '],
        datasets: [
          {
            label: "",
            backgroundColor: ["#f032e6", "#800000","#9A6324","#808000","#469990","#000075", "#e6194B","#f58231","#ffe119","#bfef45","#3cb44b","#42d4f4"],
            data: ['; echo "$a[0]".','."$a[1]".','."$a[2]".','."$a[3]".','."$a[4]".','."$a[5]".','."$a[6]".','."$a[7]".','."$a[8]".','."$a[9]".','."$a[10]".','."$a[11]"; echo ']
          }
        ]
      },
      options: {
        legend: { display: false },
        title: {
          display: true,
          text:'; echo $chartLabel; echo '
        }
      }
  });
  </script>';
}
?>