<?php

require_once 'include/dbConnect.php';
require_once 'include/functions.php';

if (isset($_POST['get_different_recipes'])){

    $first_branch_ID = $_POST["first_branch"];
    $second_branch_ID = $_POST["second_branch"];

    if(check_branch($conn, $first_branch_ID) !== true or check_branch($conn, $second_branch_ID) !== true){
        exit("Wrong branch ID(s)! Branch ID should exist in the database.");
    }

    $result = diff_recipe($conn,$first_branch_ID, $second_branch_ID);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_recipe_table($result);
    mysqli_free_result($result);
}

if (isset($_POST['get_successful_staff'])){

    $result = successful_staff($conn);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_staff_table($result);
    mysqli_free_result($result);
}

if (isset($_POST['raise_salaries'])){

    $percent = $_POST["raise"];

    if($percent < 0){
        exit("Percent cannot be negative!");
    }

    raise_salaries($conn,$percent);
    $result = successful_staff($conn);
    echo "You have increased salaries of ". mysqli_num_rows($result). " staff!";
    print_staff_table($result);
    mysqli_free_result($result);
}

if (isset($_POST['get_annual_profit'])){

    $year = $_POST["year"];

    if($year > 2021){
        exit("Enter valid year!");
    }

    $result = annual_profit($conn, $year);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_profit_table($result);
    mysqli_free_result($result);
}

if (isset($_POST['get_average_profits'])){

    $result = average_profits($conn);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_recipe_profit_table($result);
    mysqli_free_result($result);
}


if (isset($_POST['insert'])){

    $cid = $_POST["cid_insert"];
    $name = $_POST["name_insert"];
    $country_code = $_POST["country_code_insert"];
    $district = $_POST["district_insert"];
    $population = $_POST["population_insert"];

    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }

    if(check_name($name) !== true){
        exit("Wrong name");
    }

    if(check_country_code($conn,$country_code) !== true){
        exit("Wrong country code");
    }

    if(check_district($district) !== true){
        exit("Wrong district");
    }

    if(check_population($population) !== true){
        exit("Wrong population");
    }

    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
    insert_city($conn,$cid, $name, $country_code, $district, $population);
    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
}


if (isset($_POST['remove'])){

    $cid = $_POST["cid_remove"];

    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
    remove_city($conn,$cid);
    $result = get_city_info($conn,$cid);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_table('city', $result);
    mysqli_free_result($result);
}


if (isset($_POST['manipulate'])){

    $cid = $_POST["cid_manipulate"];
    $name = $_POST["name_insert"];

    if(check_cid($cid) !== true){
        exit("Wrong cid value");
    }
    get_city_info($conn,$cid);
    manipulate_city($conn,$cid,$name);
    get_city_info($conn,$cid);
}

if (isset($_POST['get_differences'])){

    $first_country_name = $_POST["first_country"];
    $second_country_name = $_POST["second_country"];

    if(check_country($conn, $first_country_name) !== true or check_country($conn, $second_country_name) !== true){
        exit("Wrong country name(s)! Country name should exist in the database.");
    }

    $result = diff_lang($conn,$first_country_name, $second_country_name);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_language_table($result);
    mysqli_free_result($result);
}

if (isset($_POST['get_differences_join'])){

    $first_country_code = $_POST["first_country_code"];
    $second_country_code = $_POST["second_country_code"];

    if(check_country_code($conn, $first_country_code) !== true or check_country_code($conn, $second_country_code) !== true){
        exit("Wrong country code! Country code should exist in the database.");
    }

    $result = diff_lang_join($conn,$first_country_code, $second_country_code);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_language_table($result);
    mysqli_free_result($result);
}

if (isset($_POST['aggregate_countries'])){

    $ops = $_POST["ops"];

    switch ($ops) {
        case 'MIN':
            $agg_type = "MIN";
            break;
        
        default:
            $agg_type = "AVG";
            break;
    }

    $country_name = $_POST["country_name"];

    if(check_country($conn, $country_name) !== true){
        exit("Wrong country name! Country name should exist in the database.");
    }

    $result = aggregate_countries($conn,$agg_type, $country_name);
    echo "Returned rows are: " . mysqli_num_rows($result);
    print_aggregate_table($result);
    mysqli_free_result($result);
}


