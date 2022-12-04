<?php
require_once "includes/db.php";
$company_id=isset($_POST['company_id'])?$_POST['company_id']:-1;

$con=connect();
$stmt=$con->prepare("SELECT * from models where company_id=?");
$stmt->bind_param("i",$company_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
if($data){
    echo '<option value="">Select Model</option>';
    foreach ($data as $row){
        echo '<option value="'.$row['id'].'">'.$row['model'].'</option>';
    }
}else{
    echo '<option value="">Model not available</option>';
}
$con->close();