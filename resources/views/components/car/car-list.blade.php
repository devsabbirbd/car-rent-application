<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-4">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Rental Car List</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                </div>
            </div>
        </div>
            <div class="row my-5" id="carList">

            </div>

    </div>
</div>
</div>

<script>

carList();
async function carList() {
    showLoader();
    res= await axios.post("/car-list");
    hideLoader();   
    let carList=$('#carList');
    let data=res.data['data'].reverse();
    let status = res.data['status'];
        if(status==='success'){

            carList.empty();
            data.forEach(function (car,i) {
                let availabilityButton=``;
                if(car['availability']==1){
                     availabilityButton=`
                        <p class="card-text text-white d-inline-block rounded bg-gradient-success text-uppercase px-3 py-2">Available</p> 
                    `;
                }else{
                     availabilityButton=`
                        <p class="card-text text-white d-inline-block rounded bg-gradient-danger text-uppercase px-3 py-2">Not Available</p> 
                    `;
                }
                let row = `
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="card mb-3"">
                            <div class="row no-gutters">
                            <div class="col-md-6 position-relative">
                                <img src="/${car['image']}" class="card-img" alt="">

                                <div class="action-btn position-absolute">
                                    <button class="btn bg-gradient-info me-2 edit_car" data-id="${car['id']}">Edit</button>
                                    <button class="btn bg-gradient-danger delete_car" data-id="${car['id']}">Remove</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                <h5 class="card-title">${car['name']}</h5>
                                <p class="card-text mb-1">Brand : ${car['brand']}</p>
                                <p class="card-text mb-1">Model : ${car['model']}</p>
                                <p class="card-text mb-1">Year: ${car['year']}</p>
                                <p class="card-text mb-1">Car Type : ${car['car_type']}</p>
                                <p class="card-text mb-1">Daily Rent Price : $${car['daily_rent_price']}</p>
                                ${availabilityButton}
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                `;
                carList.append(row);
            });

            if(data.length===0){
                let row = `
                    <div class="col-12 min-vh-70 d-flex justify-content-center align-items-center">
                        <h1 class="text-center">No Car Found</h1>
                    </div>
                `;
                carList.append(row);
            }

            $('.edit_car').on('click', async function () {
                let id= $(this).data('id');
                let filePath=$(this).parents().siblings('img').attr('src');
                FillUpUpdateForm(id,filePath);
                $("#update-modal").modal('show');

            })
            $('.delete_car').on('click', async function () {
                let id= $(this).data('id');
                let filePath=$(this).parents().siblings('img').attr('src');
                $('#deleteID').val(id);
                $('#deleteFilePath').val(filePath);
                $("#delete-modal").modal('show');
            })

        } else{
        errorToast(res.data['data']);
        }

}



</script>

