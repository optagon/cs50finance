<table class="table table-striped">
    <thead>
        <tr>
            <th>Transaction type</th>
            <th>Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
            if(isset($history))
            {        
                foreach($history as $item)
                {
                    print("<tr>");
                    print("<td>" . $item["type"] . "</td>");
                    print("<td>" . $item["datetime"] . "</td>");
                    print("<td>" . $item["symbol"] . "</td>");
                    print("<td>" . $item["amount"] . "</td>");
                    print("<td>" . $item["price"] . "</td>");
                    print("</tr>\n");
                }
            }
        ?>
    </tbody>
</table>