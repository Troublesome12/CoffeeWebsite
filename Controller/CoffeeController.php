<script>
//Displaying a confirmation dialog while deleting an item
function isConfirm(id){
    //build the confirmaiton box
    var c = confirm("Are you sure to want to delete this item?");
    
    //if true then delete and refresh 
    if(c)
        window.location = 'Overview.php?delete=' +id;
}
</script>

<?php
require ("Models/CoffeeModel.php");

//Contains non-database related function for the Coffee page
class CoffeeController {

    function createOverviewTable() {
        $result = "<table class='overviewTable'>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Type</td>
                        <td>Price</td>
                        <td>Roast</td>
                        <td>Country</td>
                    </tr>";

        $coffeeArray = $this->getCoffeeByType('%');

        foreach ($coffeeArray as $key => $value) {
            $result = $result .
                    "<tr>
                            <td><a href='CoffeeAdd.php?update=$value->id'>Update</a></td>
                            <td><a href='#' onClick='isConfirm($value->id)'>Delete</a></td>
                            <td>$value->id</td>
                            <td>$value->name</td>
                            <td>$value->type</td>
                            <td>$value->price</td>
                            <td>$value->roast</td>
                            <td>$value->country</td>
                        </tr>";
        }
        return $result . '</table>';
    }

    function createCoffeeDropdownList() {
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a type: 
                    <select name = 'types' >
                        <option value = '%' >All</option>"
                . $this->CreateOptionValues($this->GetCoffeeTypes()) .
                "</select>
                    <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function createOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }

    function createCoffeeTable($types) {
        $coffeeArray = $this->getCoffeeByType($types);
        $result = "";

        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($coffeeArray as $key => $coffee) {
            $result = $result .
                    "<table class = 'coffeeTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$coffee->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$coffee->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$coffee->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$coffee->price</td>
                        </tr>
                        
                        <tr>
                            <th>Roast: </th>
                            <td>$coffee->roast</td>
                        </tr>
                        
                        <tr>
                            <th>Origin: </th>
                            <td>$coffee->country</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$coffee->review</td>
                        </tr>                      
                     </table>";
        }
        return $result;
    }

    function getCoffeeImages() {
        //Select folder to scan
        $handle = opendir("Images/Coffee");

        //Read all the files and store name into an array
        while ($image = readdir($handle)) {
            $images[] = $image;
        }
        closedir($handle);

        //Exclude all file name where filename length < 3
        $imageArray = array();
        foreach ($images as $image) {
            if (strlen($image) > 2)
                array_push($imageArray, $image);
        }

        return $imageArray;
    }

    function insertCoffee() {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $roast = $_POST["txtRoast"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $coffee = new CoffeeEntity(-1, $name, $type, $price, $roast, $country, $image, $review);
        $coffeeModel = new CoffeeModel();
        $coffeeModel->insertCoffee($coffee);
    }

    function updateCoffee($id) {
        $name = $_POST["txtName"];
        $type = $_POST["ddlType"];
        $price = $_POST["txtPrice"];
        $roast = $_POST["txtRoast"];
        $country = $_POST["txtCountry"];
        $image = $_POST["ddlImage"];
        $review = $_POST["txtReview"];

        $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
        $coffeeModel = new CoffeeModel();
        $coffeeModel->updateCoffee($id, $coffee);
    }

    function deleteCoffee($id) {
        $coffeeModel = new CoffeeModel();
        $coffeeModel->deleteCoffee($id);
    }

    function getCoffeeById($id) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->getCoffeeById($id);
    }

    function getCoffeeByType($type) {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->getCoffeeByType($type);
    }

    function getCoffeeTypes() {
        $coffeeModel = new CoffeeModel();
        return $coffeeModel->getCoffeeTypes();
    }
}