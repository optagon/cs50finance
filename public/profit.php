<table class="table table-striped">
<?php
    require("../includes/config.php");
   //CS50::mysql_connect("localhost", "koptat", "v1kCjsvLYytrBTGV");
   //mysql_select_db("pset7");
   
   $rows = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
   
   $profit = $rows[0]["cash"] - 10000;  
   

   render("profit_form.php", ["title" => "Profit", "profit" => $profit]);
    
?>

</table>