

<div class="container text-center" style="justify-items: center;">
    <div class="modal" tabindex="-1" id="modal_exp_type">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add-exp-type-form.php" method="post">
                        <div class="form-group">
                            <label for="">Expenditure type</label>
                            <input type="text" name="exp_type" class="form-control">
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
    var addGstModal = new bootstrap.Modal(document.getElementById('modal_exp_type'));
    var addGstButton = document.getElementById('exp_type_modal');
            addGstButton.addEventListener('click', function() {
                addGstModal.show();
            });
        });

</script>
