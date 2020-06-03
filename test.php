
<?php 

$monday = strtotime("last monday");
$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

$sunday = strtotime(date("Y-m-d",$monday)." +6 days");

$this_week_sd = date("Y-m-d",$monday);
$this_week_ed = date("Y-m-d",$sunday);


echo $this_week_sd;
echo '<br>';
echo $this_week_ed;
?>