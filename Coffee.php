<?php

require 'Controller/CoffeeController.php';
$coffeeController = new CoffeeController(); 

if(isset($_POST['types'])){
    //Fill page with coffees of selected type
    $coffeeTable = $coffeeController->createCoffeeTable($_POST['types']);
}else{
    //Page is loaded for the first time, Fetch all type
    $coffeeTable = $coffeeController->createCoffeeTable('%');
}

$title='Coffee';
$content=$coffeeController->createCoffeeDropdownList().$coffeeTable;

include 'Template.php';