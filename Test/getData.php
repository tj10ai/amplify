<?php
require_once "includes/db.php";
$company_id=isset($_POST['company_id'])?$_POST['company_id']:-1;
$model_id=isset($_POST['model_id'])?$_POST['model_id']:-1;

$con=connect();
$stmt=$con->prepare("SELECT * from metrics where company_id=? and model_id=?");
$stmt->bind_param("ii",$company_id,$model_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
if($data){
    echo '<table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col">Metric Type</th>
                  <th scope="col">Selection</th>
                  <th scope="col">Value</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>';
                foreach ($data as $row){
                    echo '<tr>
                            <td><span hidden>'.$row['id'].'</span>'.$row['metric_type'].'</td>
                            <td>'.$row['metric_selection'].'</td>
                            <td>'.$row['value'].'</td>
                            <td><button class="btn btn-danger">Delete</button><button class="ms-3 btn btn-primary">Update</button></td>
                          </tr>';
                }
                echo '</tbody>
                       </table>';
}else{
    echo '<option value="">No data available</option>';
}
$con->close();