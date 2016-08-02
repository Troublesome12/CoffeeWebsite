<?php

require ('Entities/CoffeeEntity.php');

class CoffeeModel {

    function getCoffeeTypes() {
        include 'Credentials.php';

        //Open Connection and select database
        $con = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_connect_error());
        $query = 'SELECT DISTINCT type FROM coffee';
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $types = array();

        //Get data from database
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($types, $row['type']);
        }

        mysqli_close($con);
        return $types;
    }

    function getCoffeeByType($type) {
        include 'Credentials.php';

        //Open Connection and select database
        $con = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_connect_error());

        $query = "SELECT * FROM coffee WHERE type LIKE '$type'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $coffeeArray = array();

        //Get data from database
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $type = $row['type'];
            $price = $row['price'];
            $roast = $row['roast'];
            $country = $row['country'];
            $image = $row['image'];
            $review = $row['review'];
            $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
            array_push($coffeeArray, $coffee);
        }

        mysqli_close($con);
        return $coffeeArray;
    }

    function getCoffeeById($id) {
        include 'Credentials.php';

        //Open Connection and select database
        $con = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_connect_error());

        $query = "SELECT * FROM coffee WHERE id='$id'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        //Get data from database
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $type = $row['type'];
            $price = $row['price'];
            $roast = $row['roast'];
            $country = $row['country'];
            $image = $row['image'];
            $review = $row['review'];
            $coffee = new CoffeeEntity($id, $name, $type, $price, $roast, $country, $image, $review);
        }

        mysqli_close($con);
        return $coffee;
    }

    function insertCoffee(CoffeeEntity $coffee) {
        require 'Credentials.php';

        //Open Connection and select database
        $con = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_connect_error());       
        $query = sprintf("INSERT INTO coffee (name, type, price, roast, country, image, review)
                        VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
                        mysqli_real_escape_string($con, $coffee->name),
                        mysqli_real_escape_string($con, $coffee->type),
                        mysqli_real_escape_string($con, $coffee->price),
                        mysqli_real_escape_string($con, $coffee->roast),
                        mysqli_real_escape_string($con, $coffee->country),
                        mysqli_real_escape_string($con, "Images/Coffee/".$coffee->image),
                        mysqli_real_escape_string($con, $coffee->review));
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
        
    }

    function updateCoffee($id, CoffeeEntity $coffee) {
        require 'Credentials.php';

        //Open Connection and select database
        $con = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_connect_error());        
        $query = sprintf("Update coffee SET name='%s',type='%s',price='%s',roast='%s',country='%s',image='%s',review='%s'
                        WHERE id='$id'",
                        mysqli_real_escape_string($con, $coffee->name),
                        mysqli_real_escape_string($con, $coffee->type),
                        mysqli_real_escape_string($con, $coffee->price),
                        mysqli_real_escape_string($con, $coffee->roast),
                        mysqli_real_escape_string($con, $coffee->country),
                        mysqli_real_escape_string($con, "Images/Coffee/".$coffee->image),
                        mysqli_real_escape_string($con, $coffee->review));        
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
    }

    function deleteCoffee($id) {
        require 'Credentials.php';
        //Open Connection and select database
        $con = mysqli_connect($host, $user, $passwd, $database) or die(mysqli_connect_error());
        $query = "DELETE FROM coffee WHERE id=$id";
        mysqli_query($con, $query) or die(mysqli_error($con));
        mysqli_close($con);
    }
}