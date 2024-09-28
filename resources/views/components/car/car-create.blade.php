{{-- Only For This Template Resoures --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>




<div class="modal animated zoomIn" id="create-modal" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Create Car</h5>
                </div>
                <div class="modal-body">
                    <form id="createCar">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Name</label>
                                        <input type="text" class="form-control" id="carName">        
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Brand</label>
                                        <input type="text" class="form-control" id="carBrand">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Model</label>
                                        <input type="text" class="form-control" id="carModel">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Type</label>
                                        <input type="text" class="form-control" id="carType">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Year</label>
                                        <input type="text" class="form-control" id="carYear">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Daily Rate</label>
                                        <input type="text" class="form-control" id="carDailyRate">        
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6 mt-2">Car Availability</label>
                                        <select class="form-select" id="carAvailability" required>
                                            <option selected value="">Select Car Availability</option>
                                            <option value="1">Available</option>
                                            <option value="0">Not Available</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6  mt-2">Image</label>
                                        <input type="file" class="form-control" id="carImg" 
                                               onchange="setBackgroundImage(this)">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="img-box position-absolute shadow-card bg-gradient-faded-primary start-100 top-4"id="newImg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Create()" id="save-btn" class="btn bg-gradient-success" >Create </button>
                </div>
            </div>
    </div>
</div>


<script>

    async function Create() {
        
        let carName = $('#carName').val();
        let carBrand = $('#carBrand').val();
        let carModel = $('#carModel').val();
        let carYear = $('#carYear').val();
        let carType = $('#carType').val();
        let carDailyRate = $('#carDailyRate').val();
        let carAvailability = $('#carAvailability').val();
        let carImg = $('#carImg').prop('files')[0];


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
        }else if (carImg.length === 0) {
            errorToast("Car Image Required !")
        }else{

            let formData = new FormData();
            formData.append('car_name', carName);
            formData.append('car_brand', carBrand);
            formData.append('car_model', carModel);
            formData.append('car_year', carYear);
            formData.append('car_type', carType);
            formData.append('car_daily_rate', carDailyRate);
            formData.append('car_availability', carAvailability);
            formData.append('car-img', carImg);

            let contentType={ 
                headers: {
                'Content-Type': 'multipart/form-data' 
            }
            }

            showLoader();
            let res = await axios.post("/car-create", formData, contentType);
            hideLoader();
            if(res.data['status'] === "success"){
                successToast(res.data.message);
                await carList();
                $('#create-modal').modal('hide');
                $('#createCar').trigger('reset');
                const newImg = document.getElementById('newImg');
                newImg.style.backgroundImage = `url(/images/default.jpg)`;
            }else{
                errorToast(res.data.message);
            }


        }
           


    }


    $('#carYear, #carYearUpdate').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true,
        orientation: "bottom right"
    });
    


    function setBackgroundImage(input) {
            const file = input.files[0];
            if (file) {
                const newImg = document.getElementById('newImg');
                newImg.style.backgroundImage = `url(${window.URL.createObjectURL(file)})`;
            }
    }



</script>
