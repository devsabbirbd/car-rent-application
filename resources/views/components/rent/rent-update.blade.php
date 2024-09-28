<div class="modal " id="update-modal" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title">Update Rental</h5>
            </div>
            <div class="modal-body text-center">



            </div>

            <div class="modal-footer justify-content-center">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="update()" id="update-btn" class="btn bg-gradient-success" >Update</button>
            </div>

        </div>
    </div>
</div>


<script>

$('.dropdown-item').on('click', function () {
            var selectedText = $(this).html();
            var selectedClass = $(this).data('class');
            $('.dropdown-toggle').removeClass('bg-gradient-primary bg-gradient-success bg-gradient-danger');
            $('.dropdown-toggle').addClass(selectedClass);     
            $('.dropdown-toggle').html(selectedText);
});



    async function update() {

        let productCategoryUpdate=document.getElementById('productCategoryUpdate').value;
        let productNameUpdate = document.getElementById('productNameUpdate').value;
        let productPriceUpdate = document.getElementById('productPriceUpdate').value;
        let productUnitUpdate = document.getElementById('productUnitUpdate').value;
        let updateID=document.getElementById('updateID').value;
        let filePath=document.getElementById('filePath').value;
        let productImgUpdate = document.getElementById('productImgUpdate').files[0];


        if (productCategoryUpdate.length === 0) {
            errorToast("Product Category Required !")
        }
        else if(productNameUpdate.length===0){
            errorToast("Product Name Required !")
        }
        else if(productPriceUpdate.length===0){
            errorToast("Product Price Required !")
        }
        else if(productUnitUpdate.length===0){
            errorToast("Product Unit Required !")
        }

        else {

            document.getElementById('update-modal-close').click();

            let formData=new FormData();
            formData.append('img',productImgUpdate)
            formData.append('id',updateID)
            formData.append('name',productNameUpdate)
            formData.append('price',productPriceUpdate)
            formData.append('unit',productNameUpdate)
            formData.append('category_id',productCategoryUpdate)
            formData.append('img_url',filePath)

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }

            showLoader();
            let res = await axios.post("/product-update",formData,config)
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast('Product Update Sucessfully !');
                document.getElementById("update-form").reset();
                await getList();
            }
            else{
                errorToast("Request fail !")
            }
        }
    }
</script>
