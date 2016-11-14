<table class="table table-striped">
   <div class="container">
    <?php
    if($profit > 0)
    {
        echo("You are good investor");
        echo("</br>");
        echo("Your have made: ");
        echo($profit);
    }
    else if ($profit < 0)
    {
        echo("You are a bad investor, maybe try again");
        echo("</br>");
        echo("You have made: ");
        echo($profit. " USD");
    }
        
    ?>
    </div>
</table>