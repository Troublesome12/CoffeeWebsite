<?php

require 'Controller/CoffeeController.php';
$coffeeController = new CoffeeController();

if(isset($_GET['update'])){
    $coffee = $coffeeController->getCoffeeById($_GET['update']);
    $title = 'Updating Coffee';
    $content = "<form action='' method='post'>
                    <fieldset>
                        <legend>Updating Coffee</legend>
                        <label for='name'>Name: </label>
                        <input type='text' class='inputField' name='txtName' value=$coffee->name /><br/>
        
                        <label for='type'>Type: </label>
                        <select class='inputField' name='ddlType'>
                            <option value='%'>All</option>"
                            .$coffeeController->createOptionValues($coffeeController->getCoffeeTypes()).
                        "</select><br/>
        
                        <label for='price'>Price: </label>
                        <input type='text' class='inputField' name='txtPrice' value=$coffee->price /><br/>
        
                        <label for='roast'>Roast: </label>
                        <input type='text' class='inputField' name='txtRoast' value=$coffee->roast /><br/>
        
                        <label for='country'>Country: </label>
                        <input type='text' class='inputField' name='txtCountry' value=$coffee->country /><br/>
        
                        <label for='image'>Image: </label>
                        <select class='inputField' name='ddlImage'>"
                            .$coffeeController->createOptionValues($coffeeController->getCoffeeImages()).
                        "</select><br/>
                        <label for='review'>Review: </label>
                        <textarea cols='70' rows='12' name='txtReview'>$coffee->review</textarea><br/>
        
                        <input type='submit' value='Submit'/>
                    </fieldset>
                </form>";
}
else{
    $title = 'Adding Coffee';
    $content = "<form action='' method='post'>
                    <fieldset>
                        <legend>Add a new Coffee</legend>
                        <label for='name'>Name: </label>
                        <input type='text' class='inputField' name='txtName'/><br/>
        
                        <label for='type'>Type: </label>
                        <select class='inputField' name='ddlType'>
                            <option value='%'>All</option>"
                            .$coffeeController->createOptionValues($coffeeController->getCoffeeTypes()).
                        "</select><br/>
        
                        <label for='price'>Price: </label>
                        <input type='text' class='inputField' name='txtPrice'/><br/>
        
                        <label for='roast'>Roast: </label>
                        <input type='text' class='inputField' name='txtRoast'/><br/>
        
                        <label for='country'>Country: </label>
                        <input type='text' class='inputField' name='txtCountry'/><br/>
        
                        <label for='image'>Image: </label>
                        <select class='inputField' name='ddlImage'>"
                            .$coffeeController->createOptionValues($coffeeController->getCoffeeImages()).
                        "</select><br/>
                        <label for='review'>Review: </label>
                        <textarea cols='70' rows='12' name='txtReview'></textarea><br/>
        
                        <input type='submit' value='Submit'/>
                    </fieldset>
                </form>";
}


if(isset($_GET['update'])){
    if(isset($_POST['txtName'])){
        $coffeeController->updateCoffee($_GET['update']);
        header("Refresh:0; url=Overview.php");
    }
}  
else {
    if(isset($_POST['txtName'])){
        $coffeeController->insertCoffee();
        header("Refresh:0; url=Overview.php");
    }
}

include './Template.php';