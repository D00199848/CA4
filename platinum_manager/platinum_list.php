<?php include '../view/header.php'; ?>
<main>

    <h1>Platinum List</h1>


    <section>
        <!-- display a table of products -->
       
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                 <th>Seat</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($platinums as $platinum) : ?>
            <tr>
                
                <td><?php echo $platinum['platinumCode']; ?></td>
                <td><?php echo $platinum['platinumName']; ?></td>
                <td class="right"><?php echo $platinum['listPrice']; ?></td>
                <td><?php echo $platinum['seat']; ?></td>
                <td><form action="index3.php" method="post">
                    
                    <input type="hidden" name="platinum_id"
                           value="<?php echo $platinum['platinumID']; ?>">
<!--                    <input type="hidden" name="band_id"
                           value="<?php // echo $platinum['bandID']; ?>">-->
                    
                </form></td>
                <td><form action="index3.php" method="post">
                    <input type="hidden" name="action"
                           value="delete_platinum">
                    <input type="hidden" name="platinum_id"
                           value="<?php echo $platinum['platinumID']; ?>">
                    
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="?action=show_add_form">Add Gig</a></p>
      
        <p><a href="../gig_manager/index.php">Back to Gigs</a></p>
    </section>

</main>
<?php include '../view/footer.php'; ?>