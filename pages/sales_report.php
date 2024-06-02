<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid  mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1 class="m-0 text-dark">Sales report </h1>
          </div><!-- /.col -->
          <div class="col-md-6 mt-3">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sales report</li>
            </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
<div class="card">
	<div class="card-body">


  <!-- search methode start -->
          <div class="box-body">
          <div id="allSearchMethods" class="box-body" style="border: 1px solid #ebedef;">
              <div class="row">
              	<div class="col-md-5 issueDateMethod " id="issueDateMethod" >
                <div class="form-group">
                  <label for="">Start Date</label>
                  <div class="input-group">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 10px; border: 1px solid #ccc; width: 100%">
                      <i class="fa fa-calendar"></i>&nbsp;
                      <span id="search_date"></span> <i class="fa fa-caret-down"></i>
                    </div>
          
                  </div>
                </div>
              </div>
              <div class="col-md-5 customer" id="customer" style="">
              	<div class="form-group">
              		<label>Select customer</label>
              		<select name="customer" id="customer" class="form-control">
              		<option value="all">-All-</option>
              		<?php 
                          $all_customer = $obj->all('member');

                          foreach ($all_customer as $customer) {
                            ?>
                              <option value="<?=$customer->id;?>"><?=$customer->name;?></option>
                            <?php 
                          }
                         ?>
              	</select>
              	</div>
              </div>


              <div class="col-md-2 " id="form-submit-btn" style="margin-top: 30px;">
                <div class="form-group">
                  <input type="submit" id="search_sales_report" class="btn btn-primary rounded-0" value="Show">
                </div>
			 </div>
              </div>
		</div>
		 </div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<button id="exportButton" onclick="exportReportToExcel('xlsx','salesgross')" class="btn btn-outline-secondary">Export to Excel</button>
		<table class="table table-stripted" id="salesgrossid">
			<thead>
				<th>#</th>
				<th>Invoice number</th>
				<th>Sales date</th>
				<th>customer id</th>
				<th>customer name</th>
				<!-- <th>invoice total</th>
				<th>Paid paymen</th>
				<th>Due amount</th> -->
			</thead>
			<tbody id="search_sales_report_res">
				
			</tbody>
			
		</table>
	</div>
</div>
</div>
</section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>
  function exportReportToExcel(type, name,fn, dl) {
 
var elt = document.getElementById('salesgrossid');
var MySheetName = 'Sales_report';
     var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
     return dl ?
       XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
       XLSX.writeFile(wb, fn || (MySheetName+'.' + (type || 'xlsx')));
}
  </script>
          <!-- .content-wrapper -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript">
  var start = moment().subtract(29, 'days');
  var end = moment();

  function cb(start, end) {
    $('#reportrange span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
  }

  $('#reportrange').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
     'Today': [moment(), moment()],
     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
     'This Month': [moment().startOf('month'), moment().endOf('month')],
     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
   }
 }, cb);

  cb(start, end);

</script>

<script type="text/javascript">
  var start = moment().subtract(29, 'days');
  var end = moment();

  function cb(start, end) {
    $('#reportrangeEnd span').html(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
  }

  $('#reportrangeEnd').daterangepicker({
    startDate: start,
    endDate: end,
    ranges: {
     'Today': [moment(), moment()],
     'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
     'Last 7 Days': [moment().subtract(6, 'days'), moment()],
     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
     'This Month': [moment().startOf('month'), moment().endOf('month')],
     'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
   }
 }, cb);

  cb(start, end);

</script>
<script>
  $(document).on('click', '#search_sales_report', function(event) {
  event.preventDefault();

  issuedate = $.trim($("#search_date").text());
 var customer = 	$("#customer option:selected" ).val();

    $.post('app/ajax/search_sales_report.php', {customer:customer,issuedate:issuedate}, function(data) {
    $("#search_sales_report_res").html(data);
  });



});


</script>


