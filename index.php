<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->

  <?php 
        if (isset($_GET['page'])) {
          $page ='pages/' .$_GET['page'].'.php';

        }else{
          $page = 'pages/dashboard.php';
        }
        if (file_exists($page)) {
          include $page; 
        }else{
          include 'pages/error_page.php';
        }
 ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

 <?php include 'inc/footer.php'; ?>