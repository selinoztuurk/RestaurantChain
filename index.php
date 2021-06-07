<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha512-8bHTC73gkZ7rZ7vpqUQThUDhqcNFyYi2xgDgPDHc+GXVGHXq+xPjynxIopALmOPqzo9JZj0k6OqqewdGO3EsrQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="index.css">
</head>
<body>

    <div class="ui container" id="main">
    <h1 class="ui center aligned header">Welcome to our Restaurant Chain!</h1>
    <img class="ui centered large image" src="restaurant.jpg">
    <br>
    <hr>

    <!-- Find the names of the recipes served in Branch1 but not served in Branch2 -->
    
    <h3 class="ui center aligned header">Our each branch offers a unique experience. See which recipes are served on one branch and not on the other, by entering the ID number of each branch. </h3>
    
    <form action='result.php' method='post'>
    <div class="ui input">
        <input type="number" name="first_branch" placeholder="First Branch ID">
    </div>
    <div class="ui input">
    <input type="number" name="second_branch" placeholder="Second Branch ID">
    </div>
        
    <button class="ui button" name="get_different_recipes" type='submit'>
        Get Different Recipes
    </button>
    </form>
    <hr>

    <!-- Find the names of the staff that works in a branch with higher rating than 
        average of all braches and has served more than 10 orders -->
    
    <h3 class="ui center aligned header">We apprecieate all the efort that our staff has been putting in since the very first day. Click to view our best staff who has received above the average rating on their orders and has successfully served more than 10 times.</h3>
    
    <form action='result.php' method='post'>
        <button class="ui button" name="get_successful_staff" type='submit'>
        Get Successful Staff
        </button>
    </form>
    <hr>

    <!-- Give them raise -->
    <h3 class="ui center aligned header">Customer is always right in our Restaurant Chain. Give our best staff a salary raise on any amount you wish.</h3>
    
    <form action='result.php' method='post'>

    <div class="ui input">
    <input type="number" name="raise" placeholder="How much % raise?">
    </div>
    <button class="ui button" name="raise_salaries" type='submit'>
    Raise Salaries
    </button>
    </form>
    <hr>

    <!-- Annual profit -->
    <h3 class="ui center aligned header">We have been happily serving since 1990. If you are an investor, our Restaurant Chain is the best option you have! Check our annual profits by entering a year, between 1990 and 2020 (both years included).</h3>
    
    <form action='result.php' method='post'>
    <div class="ui input">
    <input type="number" name="year" placeholder="Which year's profits?">
    </div>
    <button class="ui button" name="get_annual_profit" type='submit'>
    Get Annual Profit
    </button>
    </form>
    <hr>

    <!-- Find the average profit list of recipes -->
    <h3 class="ui center aligned header">Some of our recipes are not only super delicious, but also very profitable! Click to see the average profits receieved from each recipe.</h3>
    
    <form action='result.php' method='post'>
    <button class="ui button" name="get_average_profits" type='submit'>
    Get Average Recipe Profits
    </button>
    </form>
    </div>
</body>
</html>