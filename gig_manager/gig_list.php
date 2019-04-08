<?php include '../view/header.php'; ?>
<main>

    <h1>Gig List</h1>

    <aside>
        <!-- display a list of categories -->
        <h2>Bands</h2>
        <?php include '../view/band_nav.php'; ?>        
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $band_name; ?></h2>
        <table>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th class="right">Price</th>
                 <th>Seat</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($gigs as $gig) : ?>
            <tr>
                
                <td><?php echo $gig['gigCode']; ?></td>
                <td><?php echo $gig['gigName']; ?></td>
                <td class="right"><?php echo $gig['listPrice']; ?></td>
                <td><?php echo $gig['seat']; ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="show_edit_form">
                    <input type="hidden" name="gig_id"
                           value="<?php echo $gig['gigID']; ?>">
                    <input type="hidden" name="band_id"
                           value="<?php echo $gig['bandID']; ?>">
                    <input type="submit" value="Edit">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_gig">
                    <input type="hidden" name="gig_id"
                           value="<?php echo $gig['gigID']; ?>">
                    <input type="hidden" name="band_id"
                           value="<?php echo $gig['bandID']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p><a href="?action=show_add_form">Add Gig</a></p>
        <p><a href="?action=list_bands">List Bands</a></p>
        <p><a href="../vip_manager/index2.php">VIP Tickets</a></p>
        <p><a href="../platinum_manager/index3.php">Platinum Tickets</a></p>
    </section>

</main>
<?php include '../view/footer.php'; ?>