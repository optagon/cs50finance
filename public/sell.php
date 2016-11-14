<?php
    // configuration
    require("../includes/config.php");
    
    //set variables written into history
    $sell = "sell";
    $date = date('Y-m-d H:i:s');
    
    // check for submission
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["symbol"]))
        {
            apologize("Please provide all required data.");
        }
        
        // get the symbol from Yahoo
        $stock = lookup($_POST["symbol"]);
        
        // get the position from database
        $positions = CS50::query("SELECT * FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        // delete the position from the database
        CS50::query("DELETE FROM portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        
        // calculate the value of the transaction
        $value = $stock["price"] * $positions[0]["shares"];
        
        // credit the user
        CS50::query("UPDATE users set cash = cash + ? WHERE id = ?", $value, $_SESSION["id"]);
        CS50::query("INSERT INTO history (type, datetime, symbol, amount, price) VALUES (?, ?, ?, ?, ?) ", $sell, $date, $_POST["symbol"], $_POST["shares"], $value);
      
        redirect("history.php");
    }
    else
    {
        // else lookup user positions and render form
        $positions = CS50::query("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
        render("sell_form.php", ["title" => "Sell", "positions" => $positions]);
    }
?>