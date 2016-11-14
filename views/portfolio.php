<table class="table table-striped">
    <thead>
        <tr>
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($positions))
            {        
                foreach($positions as $position)
                {
                    print("<tr>");
                    print("<td>" . $position["symbol"] . "</td>");
                    print("<td>" . $position["name"] . "</td>");
                    print("<td>" . $position["shares"] . "</td>");
                    print("<td>" . $position["price"] . "</td>");
                    print("<td>" . $position["total"] . "</td>");
                    print("</tr>\n");
                }
            }
            
            print("<tr>");
            print("<td colspan=\"4\">CASH</td>");
            print("<td>" . $cash . "</td>");
            print("</tr>");
        ?>
    </tbody>
</table>
