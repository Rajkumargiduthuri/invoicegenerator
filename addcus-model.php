


   <div class="container text-center mt-4 ">
   <div class="row">
       <div class="col-7">
           <div class="modal" tabindex="-1" id="modal_frm">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title">Customer Details</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">
                           <form action="modalform.php" method="post">
                               <div class="form-group">

                                   <label for="">Company Name</label>
                                   <input type="text" name="company_name" class="form-control">
                               </div>

                               <div class="form-group">
                                   <label for="">Name</label>
                                   <input type="text" name="cname" class="form-control">
                               </div>

                               <div class="form-group">
                                   <label for="">Address</label>
                                   <input type="text" name="caddress" required class="form-control">
                               </div>

                               <div class="form-group">
                                   <label for="">Phone</label>
                                   <input type="tel" name="cphone" required class="form-control">
                               </div>

                               <div class="form-group">
                                   <label for="">Email</label>
                                   <input type="email" name="cemail" class="form-control">
                               </div>

                               <div class="form-group">
                                   <label for="">GST_No</label>
                                   <input type="text" name="cgst" id="gstInput" class="form-control">
                               </div>
                               <input type="submit" name="submit" id="submit" class="btn btn-success mt-5">
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
        var addCustomerModal = new bootstrap.Modal(document.getElementById('modal_frm'));
        var addCustomerButton = document.getElementById('add_customer');
        var addCustomerButtonMin = document.getElementById('add_customer_min');
        
        addCustomerButton.addEventListener('click', function() {
            addCustomerModal.show();
        });

        if (addCustomerButtonMin) {
            addCustomerButtonMin.addEventListener('click', function() {
                addCustomerModal.show();
            });
        }

        document.getElementById('gstInput').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
</script>
 

