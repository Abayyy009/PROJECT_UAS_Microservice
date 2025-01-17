<!-- Main Footer -->
<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; <?php echo date('Y') ?>
    <div class="bullet"></div> Abayyy's Store
  </div>
  <div class="footer-right">
    1.0.0
  </div>
</footer>
</div>

<!-- General JS Scripts -->
<script src="https://demo.getstisla.com/assets/modules/jquery.min.js"></script>
<script src="https://demo.getstisla.com/assets/modules/popper.js"></script>
<script src="https://demo.getstisla.com/assets/modules/tooltip.js"></script>
<script src="https://demo.getstisla.com/assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="https://demo.getstisla.com/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="https://demo.getstisla.com/assets/modules/moment.min.js"></script>
<script src="https://demo.getstisla.com/assets/js/stisla.js"></script>

<!-- JS Libraies -->
<script src="https://demo.getstisla.com/assets/modules/datatables/datatables.min.js"></script>
<script
  src="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://demo.getstisla.com/assets/modules/jquery-ui/jquery-ui.min.js"></script>

<!-- Page Specific JS File -->
<script src="https://demo.getstisla.com/assets/js/page/modules-datatables.js"></script>

<!-- Template JS File -->
<script src="https://demo.getstisla.com/assets/js/scripts.js"></script>
<script src="https://demo.getstisla.com/assets/js/custom.js"></script>




<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script>
  $(document).ready(function () {
    $('#table-datatable').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true,
      "pageLength": 50
    });

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
    }).datepicker("setDate", new Date());

    $('.datepicker2').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd',
    });

    CKEDITOR.replace('editor1');
  });

  $(document).ready(function () {
    $("#pesan_pilih_tujuan").on("change", function () {
      var pilih = $(this).val();
      var data = "tujuan=" + pilih;
      if (pilih.length > 0) {
        $.ajax({
          url: "pesan_ajax_pilih_tujuan.php",
          method: "POST",
          data: data,
          success: function (result) {
            $(".tampil_tujuan").html(result);
          }
        });
      }
    });
  });
</script>

</body>

</html>