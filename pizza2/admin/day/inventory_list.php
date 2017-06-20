<main>
    <section>
    <h1>Current Inventory Report</h1>
        <h2>Inventory Orders Placed but not delivered</h2>
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
