<?php include '../view/header.php'; ?>
<main>
    <h1>Edit Gig</h1>
    <form action="index.php" method="post" id="edit_gig_form">

        <input type="hidden" name="action" value="update_gig">

        <input type="hidden" name="gig_id"
               value="<?php echo $gig['gigID']; ?>">

        <label>Band ID:</label>
        <input type="band_id" name="band_id"
               value="<?php echo $gig['bandID']; ?>">
        <br>

        <label>Code:</label>
        <input type="input" name="code"
               value="<?php echo $gig['gigCode']; ?>">
        <br>

        <label>Name:</label>
        <input type="input" name="name"
               value="<?php echo $gig['gigName']; ?>">
        <br>

        <label>List Price:</label>
        <input type="input" name="price"
               value="<?php echo $gig['listPrice']; ?>">
        <br>
        
          <label>Seat:</label>
        <input type="input" name="seat"
               value="<?php echo $gig['seat']; ?>">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Save Changes">
        <br>
    </form>
    <p><a href="index.php?action=list_gigs">View Gig List</a></p>

</main>
<?php include '../view/footer.php'; ?>