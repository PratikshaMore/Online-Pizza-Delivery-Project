<?php include '../../view/header.php'; ?>
<main>
    <section>
        <h1>Today is day <?php echo $current_day; ?></h1>
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="next_day">
            <input type="submit" value="Advance to day <?php echo $current_day + 1; ?>" />
        </form>

        <form  action="index.php" method="post">
            <input type="hidden" name="action" value="initial_db">           
            <input type="submit" value="Initialize DB (making day = 1)" />
            <br>
        </form>
        <br>
        <h2>Today's Orders</h2>
        <?php if (count($todays_orders) > 0): ?>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Room No</th>
                    <th>Status</th>
                </tr>

                <?php foreach ($todays_orders as $todays_order) : ?>
                    <tr>
                        <td><?php echo $todays_order['id']; ?> </td>
                        <td><?php echo $todays_order['room_number']; ?> </td>  
                        <td><?php echo $todays_order['status']; ?> <td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No Orders Today </p>
        <?php endif; ?>
        <h2>On Order: Undelivered Supply Orders</h2>
        <?php if (count($undeliveredOrders) > 0): ?>
            <?php foreach ($undeliveredOrders as $order) : ?>
                <?php echo "Order ID:" . $order['orderid']; ?>
                <?php echo "Flour Qty:" . $order['flour_qty']; ?><br>  
                <?php echo "Cheese Qty:" . $order['cheese_qty']; ?><br>  
            <?php endforeach; ?>
        <?php else: ?>
            <p>No placed orders</p>
        <?php endif; ?>

        <h2>Current Inventory</h2>
        <?php if (count($inventory) > 0): ?>
            <?php foreach ($inventory as $inventoryItem) : ?>
                <?php echo "Flour Qty:" . $inventoryItem['flour_qty']; ?><br>  
                <?php echo "Cheese Qty:" . $inventoryItem['cheese_qty']; ?><br>  
             <?php endforeach; ?>
        <?php else: ?>
            <p>No inventory</p>
        <?php endif; ?>
        <br> 
        <!--<form  action="index.php" method="post" >-->
            <!--<input type="hidden" name="action" value="change_to_baked">-->
            <!--<input type="submit" value="Mark Oldest Pizza Baked" />-->
            <!--<br>-->
        <!--</form>-->
        <br> 
    </section>

</main>
<?php include '../../view/footer.php'; ?>