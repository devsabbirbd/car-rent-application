<div class="modal animated zoomIn" id="cancel-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-danger">Are you sure to cancel !</h3>
                <p class="mb-3">Once cancel, you can't get it back.</p>
                <input class="d-none" id="cancelID"/>

            </div>
            <div class="modal-footer justify-content-center">
                <div>
                    <button type="button" id="cancel-modal-close" class="btn mx-2 bg-gradient-success" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="rentCancel()" type="button" id="confirmCancel" class="btn  bg-gradient-danger" >Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     async  function  rentCancel(){
            let id=$('#cancelID').val();
            $('#cancel-modal-close').click();
            showLoader();
            let res=await axios.post("/rental-cancel",{rental_id:id})
            hideLoader();
            let status=res.data['status'];
            if(status==='success'){
                successToast("Rental deleted successfully")
                await getList();
            }
            else{
                errorToast("Failed to delete rental")
            }
     }
</script>
