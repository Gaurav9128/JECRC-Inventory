<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Funda Of Web IT</title>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <?php
        if (isset($_SESSION['status'])) {
        ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
          unset($_SESSION['status']);
        }
        ?>

        <div class="card mt-4">
          <div class="card-header">
          <h4>
              <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">ADD MORE</a>
            </h4>
          </div>
          <div class="card-body">

            <form action="./pages/code.php" method="POST">

              <div class="main-form mt-3 border-bottom">
                <div class="row">
                 
                  <div class="col-md-4">
                    <!-- <div class="form-group mb-2">
                      <label for="">Name</label>
                      <input type="text" name="name[]" class="form-control" required placeholder="Enter Name">
                    </div> -->
                    <div class="form-group">
                      <label for="p_supliar">Supplier Name *</label>
                      <select name="p_supliar[]"  class="form-control  select2">
                        <option selected disabled>Select a Supplier </option>
                        <?php 
                          $all_supplier = $obj->all('suppliar');
                          foreach ($all_supplier as $supplier) {
                            ?>
                             <option value="<?=$supplier->id?>"><?=$supplier->name?></option>

                            <?php 
                          }
                         ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="p_product_name">purchase product *</label>
                      <select name="p_product_name[]"  class="form-control form-control-sm select2">
                        <option selected disabled>Select a product </option>
                        <?php 
                          $all_product = $obj->all('products');
                          foreach ($all_product as $product) {
                            ?>
                              <option value="<?=$product->id?>"><?=$product->product_name?> (<?=$product->brand_name;?>)</option>
                            <?php 
                          }
                         ?>
                      </select>
                        </div>
                    <div class="form-group">
                      <label for="p_p_quantity">Stock Quantity *</label>
                      <input type="number" class="form-control"  name="p_p_quantity[]" placeholder="stock quantity" readonly>
                    </div>
                    <div class="form-group">
                      <label for="p_p_price">Buy price *</label>
                      <input type="number" class="form-control"  name="p_p_price[]" placeholder="Purchase price">
                      </div>
                      <div class="form-group">
                      <label for="p_pn_quantity">Purchase quantity *</label>
                      <input type="number" class="form-control"  name="p_pn_quantity[]" placeholder="Purchase quantity">
                      </div>
                    <label for="puchar_date">Purchase date *</label>
                      <div class="form-group">
                        <input type="text" class="form-control datepicker" name="puchar_date[]" >
                      </div>
                      <div class="form-group">
                            <label for="sup_name">InvoiceNumber*:</label>
                            <input type="text" class="form-control"  placeholder="InvoiceNumber" name="in_name[]">
                          </div>
                      
                    


                  </div>
                </div>
              </div>
              <div class="paste-new-forms"></div>

              <button type="submit" name="save_multiple_data" class="btn btn-primary">Save Multiple Data</button>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
$(document).ready(function() {
  // Function to remove the form when Remove button is clicked
  $(document).on('click', '.remove-btn', function() {
    $(this).closest('.main-form').remove();
  });

  // Function to add a new form when Add More button is clicked
  $(document).on('click', '.add-more-form', function() {
    // Appending a new form to the specified container
    $('.paste-new-forms').append(`
      <div class="main-form mt-3 border-bottom">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group mb-2">
             <div class="form-group">
                      <label for="p_pn_quantity">Purchase quantity *</label>
                      <input type="number" class="form-control"  name="p_pn_quantity[]" placeholder="Purchase quantity">
                      </div>
          </div>
          <!-- Other form fields here -->
          <div class="col-md-4">
            <div class="form-group mb-2">
              <label for="">Product Name</label>
              <select name="p_product_name[]" class="form-control form-control-sm select2">
                <option selected disabled>Select a product</option>
                <?php 
                  $all_product = $obj->all('products');
                  foreach ($all_product as $product) {
                    ?>
                    <option value="<?=$product->id?>"><?=$product->product_name?> (<?=$product->brand_name;?>)</option>
                    <?php 
                  }
                ?>
              </select>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group mb-2">
            
              <br>
              <button type="button" class="remove-btn btn btn-danger">Remove</button>
            </div>
          </div>
        </div>
      </div>
    `);
  });
});
</script>


</body>

</html>