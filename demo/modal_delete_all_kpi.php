<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">ยืนยันการลบ</h4>
            </div>

            <div class="modal-body">
                <p></p>

                <p class="debug-url"></p>
            </div>

            <div class="modal-footer">
                <a class="btn btn-danger btn-ok">ลบ</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>

            </div>
        </div>
    </div>
</div>

<script>
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        //                                                                $('.debug-url').html('Delete URL: <b style="color:red;">' + $(this).find('.btn-ok').attr('href') + '</b>');
    });
</script>