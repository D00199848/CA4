<?php include '../view/header.php'; ?>
<main>
    <h1>Add Gig</h1>
    <form action="index.php" method="post" id="add_gig_form">
        <input type="hidden" name="action" value="add_gig">

        <label>Band:</label>
        <select name="band_id">
        <?php foreach ( $bands as $band ) : ?>
            <option value="<?php echo $band['bandID']; ?>">
                <?php echo $band['bandName']; ?>
            </option>
        <?php endforeach; ?>
        </select>
        <br>

        <label>Code:</label>
        <input type="input" name="code">
        <br>

        <label>Name:</label>
        <input type="input" name="name">
        <br>

        <label>List Price:</label>
        <input type="input" name="price">
        <br>
        
        <label>Seat:</label>
        <input type="input" name="seat">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Add Gig">
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index.php?action=list_gigs">View Gig List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>