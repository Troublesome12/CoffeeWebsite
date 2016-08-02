<?php
require 'Controller/CoffeeController.php';

$coffeeController = new CoffeeController();

$title='Overview';
$content=$coffeeController->createOverviewTable();


if(isset($_GET['delete'])){
    $coffeeController->deleteCoffee($_GET['delete']);
    header("Refresh:0; url=Overview.php");
}

include './Template.php';