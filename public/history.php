<?php

    require("../includes/config.php"); 
    
    if(isset($_SESSION["id"]))
    {
        
        // get users transactions
        $rows = CS50::query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
       if(count($rows) > 0)
        {
            foreach($rows as $row)
            {
                $history[] = [
                    "type" => $row["type"],
                    "datetime" => $row["datetime"],
                    "symbol" => $row["symbol"],
                    "amount" => $row["amount"],
                    "price" => money_format("$%i", $row["price"])
                ];
            }
            render("history_form.php", ["title" => "History", "history" => $history]);
        }
        else
        {
            render("history_form.php", ["title" => "History"]);
        }
    }
?>

