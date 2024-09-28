<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-danger">Are you sure to Delete !</h3>
                <p class="mb-3">Rent History will be deleted.</p>
                <input class="d-none" id="deleteID"/>

            </div>
            <div class="modal-footer justify-content-center">
                <div>
                    <button type="button" id="delete-modal-close" class="btn mx-2 bg-gradient-success" data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete" class="btn  bg-gradient-danger" >Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     async  function  itemDelete(){
            let id=document.getElementById('deleteID').value;
            document.getElementById('delete-modal-close').click();
            showLoader();
            let res=await axios.post("/customer-delete",{id:id})
            hideLoader();
            let status=res.data['status'];
            if(status==='success'){
                successToast("Customer deleted successfully")
                await getList();
            }
            else{
                errorToast("Request fail!")
            }
     }
</script>
