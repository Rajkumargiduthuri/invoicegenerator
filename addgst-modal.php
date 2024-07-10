<div class="container  text-center " style="justify-items: center;">
    <div class="modal" tabindex="-1" id="modal_gst">
        <div class="modal-dialog ">
            <div class="modal-content"  >
                <div class="modal-header">
                    <h5 class="modal-title">GST Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="gstmodal.php" method="post">
                        <div class="form-group">
                            <label for="">GST %</label>
                            <input type="text" name="gst" class="form-control">
                        </div>
                        <input type="submit" name="submit" id="submit" class="btn btn-success mt-3">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
      document.addEventListener('DOMContentLoaded', function() {
            var addGstModal = new bootstrap.Modal(document.getElementById('modal_gst'));

            var addGstButton = document.getElementById('add_gst');
            addGstButton.addEventListener('click', function() {
                addGstModal.show();
            });
        });
</script>