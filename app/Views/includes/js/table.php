
<!-- DataTables -->
<script src="<?=assetUrl("plugins/datatables/jquery.dataTables.min.js")?>"></script>
<script src="<?=assetUrl("plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")?>"></script>
<script src="<?=assetUrl("plugins/datatables-responsive/js/dataTables.responsive.min.js")?>"></script>
<script src="<?=assetUrl("plugins/datatables-responsive/js/responsive.bootstrap4.min.js")?>"></script>
<!-- Popper -->

<!-- page script -->
<script>
$(function () {
    $(".use-datatable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": [],
    });
});
</script>