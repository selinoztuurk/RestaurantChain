<html>
<head></head>
<body>

    <!-- Find the names of the recipes served in Branch1 but not served in Branch2 -->
    <form action='result_quiz.php' method='post'>
        <label>First Branch: </label><input type='number' name='first_branch' /><br/>
        <label>Second Branch: </label><input type='number' name='second_branch' />
        <input name="get_different_recipes", value='Get Different Recipes' type='submit'/></p>
    </form>
    <hr>

    <!-- Find the names of the staff that works in a branch with higher rating than 
        average of all braches and has served more than 20 orders -->
    <form action='result_quiz.php' method='post'>
        <input name="get_successful_staff", value='Get Successful Staff' type='submit'/></p>
    </form>
    <hr>

    <!-- Give them raise -->
        <form action='result_quiz.php' method='post'>
        <label>How much % raise do you want to give?: </label><input type='number' name='raise' /><br/>
        <input name="raise_salaries", value='Raise Salaries' type='submit'/></p>
    </form>
    <hr>

    <!-- Annual profit -->
    <form action='result_quiz.php' method='post'>
        <label>Which year's profits would you like to see?: </label><input type='number' name='year' /><br/>
        <input name="get_annual_profit", value='Get Annual Profit' type='submit'/></p>
    </form>
    <hr>

    <!-- Find the average profit list of recipes -->
        <form action='result_quiz.php' method='post'>
        <input name="get_average_profits", value='Get Average Recipe Profits' type='submit'/></p>
    </form>
    <hr>


    <!--Insert operation -->
    <form action='result_quiz.php' method='post'>
        <label>CID:         </label><input type='number' name='cid_insert' /><br/>
        <label>Name:        </label><input type='text' name='name_insert' /><br/>
        <label>CountryCode: </label><input type='text' name='country_code_insert' /><br/>
        <label>District:    </label><input type='text' name='district_insert' /><br/>
        <label>Population:  </label><input type='text' name='population_insert' /><br/>
        <input name="insert", value='Insert' type='submit'/></p>
    </form>
    <hr>

    <!--Remove operation -->
    <form action='result_quiz.php' method='post'>
        <label>CID:</label><input type='number' name='cid_remove' /><input name="remove", value='Remove' type='submit'/></p>
    </form>
    <hr>

    <!-- Manipulation operation -->
    <form action='result_quiz.php' method='post'>
        <label>Name: </label><input type='text' name='name_insert' /><br/>
        <label>CID:</label><input type='number' name='cid_manipulate' /><input name="manipulate", value='Manipulate' type='submit'/></p>
    </form>
    <hr>

    <!-- Please write Question 2 GUI Here -->
    <form action='result_quiz.php' method='post'>
        <label>First Country: </label><input type='text' name='first_country' /><br/>
        <label>Second Country:</label><input type='text' name='second_country' /><input name="get_differences", value='Get Differences' type='submit'/></p>
    </form>
    <hr>

    <!-- Please write Question 3 GUI Here -->
    <form action='result_quiz.php' method='post'>
        <label>First Country Code: </label><input type='text' name='first_country_code' /><br/>
        <label>Second Country Code:</label><input type='text' name='second_country_code' /><input name="get_differences_join", value='Get Differences by Join' type='submit'/></p>
    </form>
    <hr>

    <!-- Please write Question 4 GUI Here -->
    <form action='result_quiz.php' method='post'>
        <label>Choose an operation type: </label><select name='ops'><option value='MIN'>MIN</option><option value='AVG'>AVG</option></select><br/>
        <label>Country Name:</label><input type='text' name='country_name' /><input name="aggregate_countries", value='Get Life Expectancy' type='submit'/></p>
    </form>
    <hr>

</body>
</html>