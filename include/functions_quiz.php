<?php

function check_branch($conn, $branch){   
    return is_contains($conn, $branch, "BID", "Branch");
}

function diff_recipe($conn, $branch1, $branch2){

    $sql = 
    "SELECT R.RecipeName 
    FROM RestaurantChain.Recipe as R, RestaurantChain.Orders as O
        WHERE O.RecipeName = R.RecipeName 
            AND O.BID = '$branch1'  
            AND R.RecipeName NOT IN (SELECT R.RecipeName 
                                        FROM RestaurantChain.Recipe as R, RestaurantChain.Orders as O
                                        WHERE O.RecipeName = R.RecipeName 
                                        AND O.BID = '$branch2');
    ";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function print_recipe_table($result){
    ?><br>
    <table border='1'>
    <tr>
    <th>Recipe Names</th>
    </tr>
    <?php
    foreach($result as $row){
        echo "<tr>";
        echo "<td>" . $row['RecipeName'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

}

function successful_staff($conn){

    $sql = 
    "SELECT S.Name, S.Salary
    FROM Staff as S, (SELECT Rate.BID, AVG(Rate.Rating) 
    FROM CustomerRatesBranch as Rate
    GROUP BY (Rate.BID)
    HAVING AVG(Rate.Rating) > (SELECT AVG(avg_rat.Avg_Rating) 
                        FROM (SELECT Rate.BID, AVG(Rate.Rating) 
                        FROM CustomerRatesBranch as Rate
                        GROUP BY (RATE.BID)) AS avg_rat(branchID, Avg_Rating))) as BID_AVG(BID, avgrate) 
    WHERE BID_AVG.BID = S.BID
    AND S.SID IN (SELECT O2.StaffID 
                    FROM Orders as O2
                    GROUP BY (O2.StaffID)
                    HAVING COUNT(*)>20); 
    ";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function raise_salaries($conn,$percent) {
    $raise_amount = ((float) $percent /  100.0) + 1;

    $sql = "UPDATE Staff
    INNER JOIN 
    (SELECT S.Name
        FROM Staff as S, (SELECT Rate.BID, AVG(Rate.Rating) 
        FROM CustomerRatesBranch as Rate
        GROUP BY (Rate.BID)
        HAVING AVG(Rate.Rating) > (SELECT AVG(avg_rat.Avg_Rating) 
                            FROM (SELECT Rate.BID, AVG(Rate.Rating) 
                            FROM CustomerRatesBranch as Rate
                            GROUP BY (RATE.BID)) AS avg_rat(branchID, Avg_Rating))) as BID_AVG(BID, avgrate)  
        WHERE BID_AVG.BID = S.BID
        AND S.SID IN (SELECT O2.StaffID 
                        FROM Orders as O2
                        GROUP BY (O2.StaffID)
                        HAVING COUNT(*)>20)) as my_table(my_names)
    ON Staff.Name = my_table.my_names
    SET Staff.Salary = Staff.Salary*'$raise_amount';";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully! ";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

function annual_profit($conn, $year){

    $sql = "SELECT B.BID, SUM(R.Price) as annual_profit
    FROM RestaurantChain.Recipe as R, RestaurantChain.Orders as O, RestaurantChain.Branch as B
    WHERE O.BID = B.BID 
    AND R.RecipeName = O.RecipeName 
    AND YEAR(O.Date)='$year' 
    GROUP BY B.BID  
    ORDER BY SUM(R.Price) ASC;";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function print_staff_table($result){
    ?><br>
    <table border='1'>
    <tr>
    <th>Staff Names</th>
    <th>Salaries</th>
    </tr>
    <?php
    foreach($result as $row){
        echo "<tr>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['Salary'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

}

function print_profit_table($result){
    ?><br>
    <table border='1'>
    <tr>
    <th>Branch ID</th>
    <th>Annual Profit</th>
    </tr>
    <?php
    foreach($result as $row){
        echo "<tr>";
        echo "<td>" . $row['BID'] . "</td>";
        echo "<td>" . $row['annual_profit'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

}

function average_profits($conn){

    $sql = 
    "SELECT AVG(R.Price - I.Price * RI.Amount) as Average_Recipe_Profit, R.RecipeName
    FROM Recipe as R, 
    RecipeIngredient as RI,
    Ingredient as I
    WHERE RI.IngredientName = I.IngredientName AND RI.RecipeName = R.RecipeName
    GROUP BY (R.RecipeName)
    ORDER BY Average_Recipe_Profit ASC;
    ";

    $result = mysqli_query($conn, $sql);

    return $result;
}

function print_recipe_profit_table($result){
    ?><br>
    <table border='1'>
    <tr>
    <th>Recipe Name</th>
    <th>Average Profit</th>
    </tr>
    <?php
    foreach($result as $row){
        echo "<tr>";
        echo "<td>" . $row['RecipeName'] . "</td>";
        echo "<td>" . $row['Average_Recipe_Profit'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

}



function check_cid($cid){
    return is_numeric($cid);
}

function check_name($name){
    return ctype_alpha($name) and (strlen($name) < 35);
}

function check_country_code($conn,$country_code){
    return is_contains($conn,$country_code, "CountryCode", "city") and ctype_alpha($country_code) and (strlen($country_code) < 4);
}

function check_district($district){
    return ctype_alpha($district) and (strlen($district) < 20);
}

function check_population($population){
    return is_numeric($population);
}

function check_country($conn, $country){
    ########
    #PLease enter your code here
    return is_contains($conn,$country, "Name", "country") and (strlen($country) < 52);
    ########
   
}

function get_city_info($conn,$cid){

    if ($result = mysqli_query($conn, "SELECT * FROM city WHERE ID=" . $cid )) {
        return $result;
    }
}

function is_contains($conn,$string, $needle, $table_name){

    $is_contains = False;

    ########
    #PLease enter your code here

    $result = mysqli_query($conn,"SELECT * FROM $table_name WHERE $needle='$string'");

    if ($result->num_rows) {
        $is_contains = TRUE;
    } 

    ########
    return $is_contains;
}

function diff_lang($conn, $country1, $country2){

    ########
    #PLease enter your code here

    $sql = "SELECT Language FROM countrylanguage WHERE CountryCode IN (SELECT Code FROM country WHERE Name = '$country1') AND Language NOT IN (SELECT Language FROM countryLanguage WHERE CountryCode IN (SELECT Code FROM country WHERE Name = '$country2'))";

    $result = mysqli_query($conn, $sql);

    ########
    return $result;
}

function diff_lang_join($conn, $countryCode1, $countryCode2){

    ########
    #PLease enter your code here

    $sql = "SELECT f.Language FROM countrylanguage f LEFT JOIN countrylanguage s ON s.CountryCode = '$countryCode2' AND f.Language = s.Language WHERE f.CountryCode = '$countryCode1' AND s.CountryCode IS NULL";

    $result = mysqli_query($conn, $sql);

    ########
    return $result;
}

function aggregate_countries($conn,$agg_type, $country_name){

    ########
    #PLease enter your code here

    $sql = "SELECT Name, LifeExpectancy, GovernmentForm, Language FROM country, countryLanguage WHERE CountryCode = Code AND LifeExpectancy > (SELECT $agg_type(c2.LifeExpectancy) FROM country c2) AND LifeExpectancy < (SELECT c2.LifeExpectancy FROM country c2 WHERE c2.Name = '$country_name')";

    $result = mysqli_query($conn, $sql);

    ########
    return $result;
}



function print_table($table_name, $result){

    if ($table_name === 'city'){
        ?><br>
        <table border='1'>
        <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Country Code</th>
        <th>District</th>
        <th>Population</th>
        </tr>
        <?php


        foreach($result as $row){

            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['CountryCode'] . "</td>";
            echo "<td>" . $row['District'] . "</td>";
            echo "<td>" . $row['Population'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }

}

function print_language_table($result){

        ?><br>
        <table border='1'>
        <tr>
        <th>Language</th>
        </tr>
        <?php

        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row['Language'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    
}

function print_aggregate_table($result){

        ?><br>
        <table border='1'>
        <tr>
        <th>Name</th>
        <th>LifeExpectancy</th>
        <th>GovernmentForm</th>
        <th>Language</th>
        </tr>
        <?php


        foreach($result as $row){

            echo "<tr>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['LifeExpectancy'] . "</td>";
            echo "<td>" . $row['GovernmentForm'] . "</td>";
            echo "<td>" . $row['Language'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";


}

function insert_city($conn,$cid, $name, $country_code, $district, $population){


    $sql = "INSERT INTO city(ID, Name, CountryCode, District, Population) VALUES('$cid', '$name', '$country_code', '$district','$population');";
    if ($conn->query($sql) === TRUE) { #We used different function to run our query.
        echo "<br>Record updated successfully<br>";
    } else {
        echo "<br>Error updating record: " . $conn->error . "<br>";
    }
}

function remove_city($conn,$cid){
    $sql = "DELETE FROM city WHERE ID='$cid'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}

function manipulate_city($conn,$cid,$name){

    $sql = "UPDATE city SET Name='$name' WHERE ID='$cid'" ;
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

}
