<?php
    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    
    {
        $rows = CS50::query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
        
        if(empty($_POST['username'])) //make sure user typed an username
        {
            
            apologize("you have to create an username");
            return false;
        }
    
        
        else if(empty($_POST['password'])) //make sure user typed a password
        {
            
            apologize("you have to type a valid password");
            return false;
            
        }
        
        else if(($_POST['password']) != ($_POST['confirmation'])) //nesure no typo in password
        {
            
            apologize("passwords do not match ! ");
            return false;
            
        }
        if (count($rows) == 1)//ensure user name is unique
        {
            apologize("Username already exists");
        }
        else //procede to the database 
        {
            CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            //redirect user to his portfolio
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $id = $rows[0]["id"];
            $_SESSION["id"] = $id;
            redirect("index.php");
            
        }
    }
            

?>