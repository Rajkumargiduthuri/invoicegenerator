<div class="container text-center mt-4 " >
    <div class="row">
        <div class="col-7">
            <div class="modal" tabindex="-1" id="pass_frm">
                <div class="modal-dialog">
                    <div class="modal-content"  style="border-radius: 20px;">
                        <div class="modal-header">
                            <h5 class="modal-title">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="password_form.php" method="post">
                                <div class="container-fluid" > <img src="img/Bhavi-Logo-2.png" alt="" height="80px" width="200px">
                                </div>
                                <div class="form-group mt-3">
                                   

                                    <div class="form-group" style="text-align: start;">
                                        <label for="current_password">Current Password *</label>
                                        <input type="password" name="current_password" required class="form-control">
                                    </div>

                                    <div class="form-group mt-4" style="text-align: start;">
                                        <label for="">New Password *</label>
                                        <input type="password" name="new_password" required class="form-control">
                                    </div>

                                    <div class="form-group mt-4" style="text-align: start;">
                                        <label for="">Confirm Password *</label>
                                        <input type="password" name="confirm_password" required class="form-control">
                                    </div>

                                    <input type="submit" name="submit" id="submit" class="btn btn-success mt-3">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addCustomerModal = new bootstrap.Modal(document.getElementById('pass_frm'));
            var addCustomerButton = document.getElementById('change_password');
             addCustomerButton.addEventListener('click', function() {
                addCustomerModal.show();
            });

            
        });
    </script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            var addCustomerModal = new bootstrap.Modal(document.getElementById('pass_frm'));
             var addCustomerButton = document.getElementById('change_password_sm');
            addCustomerButton.addEventListener('click', function() {
                addCustomerModal.show();
            });

            
        });
    </script>