<?php include '../view/header.php'; ?>
<main>
    <h1>Add Platinum</h1>
    <form action="index3.php" method="post" id="add_platinum_form">
        <input type="hidden" name="action" value="add_platinum">

<!--        <label>Band:</label>
        <select name="band_id">-->
        <?php // foreach ( $bands as $band ) : ?>
<!--            <option value="<?php // echo $band['bandID']; ?>">-->
                <?php // echo $band['bandName']; ?>
<!--            </option>-->
        <?php // endforeach; ?>
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
        <input type="submit" value="Add Platinum">
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index3.php?action=list_platinums">View Platinum List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>