<div class="text-center ">
    <div class="container  ">
        <div class="modal" tabindex="-1" id="modal_service">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Service Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="servicesmodal.php" method="post">
                            <div class="form-group">
                                <label for="">Service Name</label>
                                <input type="text" name="service_name" class="form-control">
                            </div>
                            <input type="submit" name="submit" id="submit" class="btn btn-success mt-4">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
     document.addEventListener('DOMContentLoaded', function() {
            var addServiceModal = new bootstrap.Modal(document.getElementById('modal_service'));

            var addServiceButton = document.getElementById('add_service');
            addServiceButton.addEventListener('click', function() {
                addServiceModal.show();
            });
        });
</script>