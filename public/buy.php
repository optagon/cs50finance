<?php
    // configuration
    require("../includes/config.php");
    
    $buy= "BUY";
    $datetime = date('Y-m-d H:i:s');
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if ((empty($_POST["symbol"])) || (empty($_POST["shares"])))
        {
            apologize("You must provide all data.");
        }
        
        else if (preg_match("/^\d+$/", $_POST["shares"]) == false)
        {
            apologize("Thi is invalid input. Query has been rejected.");
        }
        
        // retrieve stock from symbol
        $stock = lookup($_POST["symbol"]);
        
            // adjust users available resources
        $rows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            
        //formula to compute the total cost of the transaction
        $cost = $stock["price"] * $_POST["shares"];
        $_POST['$cost'];
            
        // ensure the user has enough cash
        if($cost < $rows[0]["cash"])
        {
            // debit the user's cash
            CS50::query("UPDATE users set cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
                
            // create/update the position
            CS50::query("INSERT INTO portfolio (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $stock["symbol"], $_POST["shares"]);
            //insert into history
            CS50::query("INSERT INTO history (type, datetime, symbol, amount, price) VALUES (?, ?, ?, ?, ?) ", $buy, $datetime, $_POST["symbol"], $_POST["shares"], $cost);
                
            redirect("history.php");
        }
        else
        {
          apologize("You do not have enough cash for this transaction.");
        }
        
    }
    else
    {
        
        // else render form
        render("buy_form.php", ["title" => "Buy"]);
    }
?>