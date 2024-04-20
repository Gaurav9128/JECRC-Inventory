<!-- Content Wrapper. Contains page content  -->
<div class="content-wrapper">
 <!-- Main content -->
          <section class="content ">
            <div class="container-fluid mt-5">
              <div class="card  mt-5">
             <div class="card-header">
                <h3 class="card-title"><b>Buy Product</b></h3>

                 <button type="button" class="btn btn-primary btn-sm float-right rounded-0" data-toggle="modal" data-target=".suppliarModal"><i class="fas fa-plus"></i> Add new</button>
              </div>
              <!-- /.card-header -->
               
                <form id="addByproductForm">

                <div class="card-header">
                   <div class="row">
                    <div class="col-md-6">
                       <div class="form-group">
                      <label for="p_supliar">Supplier Name *</label>
                      <select name="p_supliar" id="p_supliar" class="form-control  select2">
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
                        </div>

                     
                    <div class="col-md-6">
                      <label for="puchar_date">Purchase date *</label>
                      <div class="form-group">
                        <input type="text" class="form-control datepicker" name="puchar_date" id="puchar_date">
                      </div>
                    </div>
              </div>
             
                           <div class="col-md-6 col-lg-6">
                              <div class="form-group">
                            <label for="sup_name">InvoiceNumber*:</label>
                            <input type="text" class="form-control" id="in_name" placeholder="InvoiceNumber" name="in_name">
                          </div>
                           </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                      <label for="p_product_name">purchase product *</label>
                      <select name="p_product_name" id="p_product_name" class="form-control form-control-sm select2">
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
                      </div>
                      

                      <div class="col-md-6">
                        <a href="index.php?page=add_product" target="_blank" class="btn btn-success rounded-0" style="margin-top: 30px;">Add new prodcut</a>
                      </div>
                    </div>
                    
                    <div class="row">
                    <div class="cl-md-3 col-lg-3">
                       <div class="form-group">
                      <label for="p_p_quantity">Stock Quantity *</label>
                      <input type="number" class="form-control" id="p_p_quantity" name="p_p_quantity" placeholder="stock quantity" readonly>
                      </div>
                      </div>
                        <div class="cl-md-3 col-lg-3">
                      <div class="form-group">
                      <label for="p_p_price">Buy price *</label>
                      <input type="number" class="form-control" id="p_p_price" name="p_p_price" placeholder="Purchase price">
                      </div>
                      </div>
                       <div class="cl-md-3 col-lg-3">
                       <div class="form-group">
                      <label for="p_pn_quantity">Purchase quantity *</label>
                      <input type="number" class="form-control" id="p_pn_quantity" name="p_pn_quantity" placeholder="Purchase quantity">
                      </div>
                      </div>
                      <div class="form-group">
                         <button type="submit" class="btn btn-primary btn-block mt-4 rounded-0" id="addByproductBtn">Purchase product </button>
                      </div>
                      </div>
                  </div>
                   </div>
                 </div>
                   
                </div>
              </form>

           
         </div>
                  </div>
                 </div>
               </div>
            </div>
            <!-- /.card-body -->
            <!-- /.row -->
            </div><!--/. container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper