<?php
require_once "includes/db.php";
$con=connect();
$result=$con->query("SELECT id,company from companies");
$data=$result->fetch_all(MYSQLI_ASSOC);
$con->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test</title>
    <script src="includes/jquery-3.6.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="includes/style.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="display-3">Test Page</h1>
    <div class="row mt-5">
        <div class="col-3">
            <select id="company" name="company" class="form-control">
                <option value="">Select Company</option>
                <?php foreach ($data as $row){
                    $company=$row['company'];
                    $id=$row['id'];?>
                    <option value="<?php echo $id; ?>"><?php echo $company;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#addCompany">
                Add Company
            </button>
            <button type="button" id="deleteCompany" class="ms-3 btn btn-danger btn-custom">Delete</button>
            <button type="button" id="updateCompany" class="btn btn-primary btn-custom">Update</button>
        </div>
    </div>
    <div class="row mt-5" style="display: none" id="model-div">
        <div class="col-3">
            <select id="model" name="model" class="form-control">

            </select>
        </div>
        <div class="col-6">
            <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#addModel">
                Add Model
            </button>
            <button type="button" id="deleteCompany" class="ms-3 btn btn-danger btn-custom">Delete</button>
            <button type="button" id="updateCompany" class="btn btn-primary btn-custom">Update</button>
        </div>
    </div>

    <div class="row mt-5" style="display: none" id="data-div">
        <div class="col-12" id="data">
        </div>
    </div>

</div>

<!-- Modal Add company-->
<div class="modal fade" id="addCompany" tabindex="-1" aria-labelledby="addCompany" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Company</h1>
                <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Form for new company
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add model-->
<div class="modal fade" id="addModel" tabindex="-1" aria-labelledby="addModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Model</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Form for new model
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#company').on('change', function(){
            var company_id = $(this).val();
            if(company_id){
                $.ajax({
                    type:'POST',
                    url:'getModels.php',
                    data:{company_id:company_id},
                    success:function(html){
                        $('#model-div').show();
                        $('#model').html(html);
                    }
                });
            }else{
                $('#model').hide();
            }
        });

        $('#model').on('change', function(){
            var model_id = $(this).val();
            var company_id=$('#company').val();

            if(model_id){
                $.ajax({
                    type:'POST',
                    url:'getData.php',
                    data:{company_id:company_id, model_id:model_id},
                    success:function(html){
                        $('#data-div').show();
                        $('#data').html(html);
                    }
                });
            }else{
                $('#data').hide();
            }
        });
    });
</script>
</body>
</html>