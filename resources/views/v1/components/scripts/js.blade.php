<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('template/AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('template/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- DataTables -->
<script src="{{asset('template/AdminLTE/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('template/AdminLTE/dist/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('template/AdminLTE/dist/js/demo.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- SparkLine -->
<script src="{{asset('template/AdminLTE/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jVectorMap -->
<script src="{{asset('template/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('template/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>

<!-- FastClick -->
<script src="{{asset('template/AdminLTE/plugins/fastclick/fastclick.js')}}"></script>

<!-- ChartJS 1.0.2 -->
<script src="{{asset('template/AdminLTE/plugins/chartjs-old/Chart.min.js')}}"></script>

<!-- PAGE SCRIPTS -->
<!-- <script src="{{asset('template/AdminLTE/dist/js/pages/dashboard2.js')}}"></script> -->
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>

<!-- google recaptcha api-->
<script src='https://www.google.com/recaptcha/api.js'></script>

<script>
  ClassicEditor.create(document.querySelector('#product-create'), {
    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
    heading: {
      options: [
        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
      ]
    }
  })
    .catch(error => {
      console.log(error);
    });
</script>

<script>
  $(function () {
    $("#logoutBtn").on('click', function () {
      //if (confirm("Confirm Logout?")) {
        document.getElementById('logout-form').submit();
      //}
    });
  });
</script>

<script>
  $(function () {
    $('.multiSel').selectpicker();

    $("#gradelevel-table").DataTable({ "order": [[2, "asc"]] });
    $("#section-table").DataTable({ "order": [[4, "desc"]] });
    $("#subject-table").DataTable({ "order": [[3, "desc"]] });
    $("#sy-table").DataTable({ "order": [[2, "desc"]] });
    $("#questions-table").DataTable({ "order": [[3, "desc"]] });
    $("#faculty-table").DataTable({ "order": [[5, "desc"]] });
    $("#users-table").DataTable({ "order": [[5, "desc"]] });
    $("#schedules-table").DataTable({ "order": [[6, "desc"]] });
    $("#students-table").DataTable({ "order": [[6, "desc"]] });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });

</script>
