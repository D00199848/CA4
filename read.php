<div class="table-responsive">
<table class="table table-bordered table-condensed table-hover table-striped" cellspacing="0" width="100%">
<thead>
   <tr>
   <th>#ID</th>
   <th>Band Name</th>
   <th>Action</th>
   </tr>
</thead>
<tbody>
<?php
   require_once 'database.php';
   $query = "SELECT bandID, bandName FROM bands";
   $stmt = $DBcon->prepare( $query );
   $stmt->execute();
   if($stmt->rowCount() > 0) {
 while($row=$stmt->fetch(PDO::FETCH_ASSOC)) {
 extract($row);
 ?>
 <tr>
 <td><?php echo $band_id; ?></td>
        <td><?php echo $band_name; ?></td>
 <td> 
 <a class="btn btn-sm btn-danger" id="delete_product" data-id="<?php echo $band_id; ?>" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i></a>
 </td>
 </tr>
 <?php
        } 
   } else {
 ?>
        <tr>
        <td colspan="3">No Bands Found</td>
        </tr>
        <?php
   }
?>
</tbody>
</table>   
</div>