<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="stylish.css" rel="stylesheet">


  <title>JECRC Inventory Management System</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="padding-left: 225px;">
        <?php if (isset($_SESSION['status'])) { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php unset($_SESSION['status']); } ?>
        <div class="card mt-4">
          <div class="card-header">
            <h1>......</h1>
            <h2></h2>
            <h3></h3>
            <h6>
              <a href="javascript:void(0)" class="add-more-form float-end btn btn-primary">ADD MORE</a>
            </h6>
          </div>
          <div class="card-body">
            <form action="pages/code.php" method="POST" enctype="multipart/form-data">
              <div class="main-form mt-3 border-bottom">
                <div class="row">
                  <div class="col-md-4  ">
                    <div class="form-group">
                      <label for="p_supliar">Supplier Name *</label>
                      <input type="text" class="form-control" name="p_supliar[]" placeholder="Supplier Name">
                    </div>
                    <div class="form-group">
                      <label for="p_product_name">Purchase Product *</label>
                      <select name="p_product_name[]" class="form-control form-control-sm select2 product-select">
                        <option selected disabled>Select a product</option>
                        <?php
                        $all_product = $obj->all('products');
                        foreach ($all_product as $product) {
                        ?>
                          <option value="<?= $product->id ?>"><?= $product->product_name ?> (<?= $product->brand_name; ?>)</option>
                        <?php } ?>
                      </select>
                    </div>
                    <!-- <div class="form-group">
                      <label for="p_p_quantity">Stock Quantity *</label>
                      <input type="number" class="form-control stock-quantity" name="p_p_quantity[]" placeholder="Stock quantity">
                    </div> -->
                    <div class="form-group">
                      <label for="p_p_price">Buy Price *</label>
                      <input type="number" class="form-control" name="p_p_price[]" placeholder="Purchase price">
                    </div>
                    <div class="form-group">
                      <label for="p_pn_quantity">Purchase Quantity *</label>
                      <input type="number" class="form-control" name="p_pn_quantity[]" placeholder="Purchase quantity">
                    </div>
                    <label for="puchar_date">Purchase Date *</label>
                    <div class="form-group">
                      <input type="text" class="form-control datepicker" name="puchar_date[]">
                    </div>
                    <div class="form-group">
                      <label for="sup_name">Invoice Number *</label>
                      <input type="text" class="form-control" placeholder="Invoice Number" name="in_name[]">
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
  $(document).ready(function() {
    $(document).on('change', '.product-select', function() {
      var productSelect = $(this);
      var productId = productSelect.val();
      var stockQuantityField = productSelect.closest('.main-form').find('.stock-quantity');

      if (productId) {
        $.ajax({
          url: 'get_product_stock.php',
          type: 'POST',
          data: { product_id: productId },
          success: function(response) {
            var data = JSON.parse(response);
            if (data.stock_quantity !== undefined) {
              stockQuantityField.val(data.stock_quantity);
            } else {
              stockQuantityField.val('');
            }
          },
          error: function() {
            stockQuantityField.val('');
          }
        });
      } else {
        stockQuantityField.val('');
      }
    });

    $(document).on('click', '.remove-btn', function() {
      $(this).closest('.main-form').remove();
    });

    $(document).on('click', '.add-more-form', function() {
      $('.paste-new-forms').append(`
        <div class="main-form mt-3 border-bottom">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="p_supliar">Supplier Name *</label>
                <input type="text" class="form-control" name="p_supliar[]" placeholder="Supplier Name">
              </div>
              <div class="form-group">
                <label for="p_product_name">Purchase Product *</label>
                <select name="p_product_name[]" class="form-control form-control-sm select2 product-select">
                  <option selected disabled>Select a product</option>
                  <?php
                  $all_product = $obj->all('products');
                  foreach ($all_product as $product) {
                  ?>
                    <option value="<?= $product->id ?>"><?= $product->product_name ?> (<?= $product->brand_name; ?>)</option>
                  <?php } ?>
                </select>
              </div>
             
              <div class="form-group">
                <label for="p_p_price">Buy Price *</label>
                <input type="number" class="form-control" name="p_p_price[]" placeholder="Purchase price">
              </div>
              <div class="form-group">
                <label for="p_pn_quantity">Purchase Quantity *</label>
                <input type="number" class="form-control" name="p_pn_quantity[]" placeholder="Purchase quantity">
              </div>
              <label for="puchar_date">Purchase Date *</label>
              <div class="form-group">
                <input type="text" class="form-control datepicker" name="puchar_date[]" placeholder="Purchase Date">
              </div>
              <div class="form-group">
                <label for="sup_name">Invoice Number *</label>
                <input type="text" class="form-control" placeholder="Invoice Number" name="in_name[]">
              </div>
              <button type="button" class="remove-btn btn btn-danger mt-3">Remove</button>
            </div>
          </div>
        </div>
      `);
    });
  });
  </script>
</body>
</html>
