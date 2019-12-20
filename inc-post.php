<?php
    if(!isset($_POST['submit'])){
        header('Location: index.php');
        exit;
    }
/* Using json as database to make it easier to show (I have used only localhost database..)
   "Connecting to database" */
$db = 'database.json';
$file = file_get_contents($db);
$dbData = json_decode($file, true);

# Getting form inputs
$name = $_POST['name'];
$kills = $_POST['kills'];
$deaths = $_POST['deaths'];

# Counting stat (k/d)
if ($deaths == 0) {
    $kd = $kills / 1;
} else {
    $kd = $kills / $deaths;
}

# Making $player to array with post values
$player = array("name" => $name, "kills" => $kills, "deaths"=> $deaths, "kd"=> $kd);

# Making ready to send
$dbData[] = $player;

# Let's start sorting the data
$sortArray = array();

foreach($dbData as $stat){
    foreach($stat as $key=>$value){
        if(!isset($sortArray[$key])){
            $sortArray[$key] = array();
        }
        $sortArray[$key][] = $value;
    }
}

$orderby = "kd";

array_multisort($sortArray[$orderby],SORT_DESC,$dbData);

# Sending data to "database"
$insert = json_encode($dbData);
file_put_contents($db, $insert);

header('Location: index.html');