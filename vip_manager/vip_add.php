<?php include '../view/header.php'; ?>
<main>
    <h1>Add VIP</h1>
    <form action="index2.php" method="post" id="add_vip_form">
        <input type="hidden" name="action" value="add_vip">

       
 

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
        <input type="submit" value="Add Vip">
        <br>
    </form>
    <p class="last_paragraph">
        <a href="index2.php?action=list_vips">View VIP List</a>
    </p>

</main>
<?php include '../view/footer.php'; ?>