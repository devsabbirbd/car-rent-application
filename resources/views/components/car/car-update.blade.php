
<div class="modal animated zoomIn" id="update-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Update Car</h5>
                </div>
                <div class="modal-body">
                    <form id="updateCar">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Name</label>
                                        <input type="text" class="form-control" id="carNameUpdate">  
                                        <input type="hidden" id="filePath">
                                        <input type="hidden" id="updateID">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Brand</label>
                                        <input type="text" class="form-control" id="carBrandUpdate">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Model</label>
                                        <input type="text" class="form-control" id="carModelUpdate">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Type</label>
                                        <input type="text" class="form-control" id="carTypeUpdate">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Year</label>
                                        <input type="text" class="form-control" id="carYearUpdate">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Daily Rate</label>
                                        <input type="text" class="form-control" id="carDailyRateUpdate">        
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Availability</label>
                                        <select class="form-select" id="carAvailabilityUpdate" required>
                                            <option selected value="">Select Car Availability</option>
                                            <option value="1">Available</option>
                                            <option value="0">Not Available</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6  mt-2">Image</label>
                                        <input type="file" class="form-control" id="carImgUpdate"  onchange="setBackgroundImageUpdate(this)">
                                        
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="img-box position-absolute shadow-card bg-gradient-faded-primary start-100" id="newImgUpdate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="update()" id="save-btn" class="btn bg-gradient-success" >Update</button>
                </div>
            </div>
    </div>
</div>


<script>



async function FillUpUpdateForm(id, filePath) {
    
    $('#updateCar').trigger('reset');
    $('#updateID').val(id);
    $('#filePath').val(filePath);

    showLoader();
    let res = await axios.post("/car-by-id", { car_id: id });
    hideLoader();

    let $response = res.data['data'];

    // Update Data Fill Up
    $('#carNameUpdate').val($response['name']);
    $('#carBrandUpdate').val($response['brand']);
    $('#carModelUpdate').val($response['model']);
    $('#carTypeUpdate').val($response['car_type']);
    $('#carYearUpdate').val($response['year']);
    $('#carDailyRateUpdate').val($response['daily_rent_price']);
    $('#carAvailabilityUpdate').val($response['availability']);

    // Set the background image
    document.getElementById('newImgUpdate').style.backgroundImage = `url("${filePath}")`;

}

    async function update() {

        let carName = $('#carNameUpdate').val();
        let carBrand = $('#carBrandUpdate').val();
        let carModel = $('#carModelUpdate').val();
        let carYear = $('#carYearUpdate').val();
        let carType = $('#carTypeUpdate').val();
        let carDailyRate = $('#carDailyRateUpdate').val();
        let carAvailability = $('#carAvailabilityUpdate').val();
        let updateID=$('#updateID').val();
        let filePath=$('#filePath').val();
        let carImg = document.getElementById('carImgUpdate').files[0];

        if (carName.length === 0) {
            errorToast("Car Name Required !")
        }
        else if (carBrand.length === 0) {
            errorToast("Car Brand Required !")
        }
        else if (carModel.length === 0) {
            errorToast("Car Model Required !")
        }
        else if (carYear.length === 0) {
            errorToast("Car Year Required !")
        }
        else if (carType.length === 0) {
            errorToast("Car Type Required !")
        }
        else if (carDailyRate.length === 0 ) {
            errorToast("Car Daily Rate Required !")
        }
        else if (isNaN(carDailyRate) || parseFloat(carDailyRate) <= 0) {    
            errorToast("Car Daily Rate must be a valid number");
        }
        else if (carAvailability === '') {
            errorToast("Car Availability Required !")
        } else {
            
                // Prepare the form data
                let formData = new FormData();
                formData.append('car_img', carImg);
                formData.append('car_name', carName);
                formData.append('car_brand', carBrand);
                formData.append('car_model', carModel);
                formData.append('car_year', carYear);
                formData.append('car_type', carType);
                formData.append('car_daily_rate', carDailyRate);
                formData.append('car_availability', carAvailability);
                formData.append('car_id', updateID);
                formData.append('img_url', filePath);

                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }

            showLoader();
            let res = await axios.post("/car-update",formData,config)
            hideLoader();

            if(res.data['status'] === 'success'){
                successToast(res.data['message']);
                $('#update-modal').modal('hide');
                $('#updateCar').trigger('reset');
                await carList();
            }
            else{
                errorToast("Car Update Fail !")
            }
        }
    }


    function setBackgroundImageUpdate(input) {
            let file = input.files[0];
            if (file) {
                let newImg = document.getElementById('newImgUpdate');
                newImg.style.backgroundImage = `url(${window.URL.createObjectURL(file)})`;

            }
    }

</script>
