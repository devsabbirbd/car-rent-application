<div class="container mb-5">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-lg-5 py-lg-4 mt-lg-3 px-4 py-2">
                    <h4 class="text-center">Rent A Car</h4>

                    <form id="search-form" action="javascript:void(0)">
                        <div class="row justify-content-center mt-4 mt-sm-2">
                            <div class="col-lg-2 col-sm-6 ">
                                <label for="" class="form-label fs-6">Car Type</label>
                                <select name="" id="car_type" class="form-select">
                                    <option value="" selected>Select Car Type</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-sm-6 mt-3 mt-lg-0">
                                <label for="" class="form-label fs-6">Car Brand</label>
                                <select name="" id="car_brand" class="form-select">
                                    <option value="" selected>Select Car Brand</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-sm-6 mt-3 mt-lg-0">
                                <label for="" class="form-label fs-6">Car Availability</label>
                                <select name="" id="car_availability" class="form-select">
                                    <option value="" selected>Select Car Availability</option>
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-sm-6 mt-3 mt-lg-0">
                                <label for="" class="form-label fs-6">Daily Rent Price</label>
                                <input type="text" class="form-control" id="car_daily_price">
                            </div>
                            <div class="col-lg-2 col-sm-12 mt-1 mt-3 mt-lg-0 text-sm-center text-center">
                                <button onclick="filterCar()" class="btn btn-primary mt-4 btn-rounded">Search</button>
                            </div>
                        </div>
                    </form>
            </div>

            <div class="placeholder-glow position-relative">
                <div class="row my-3" id="carList">
                    {{-- Place Car here --}}
                </div>
                <div class="preloadercar d-none placeholder position-absolute w-100 h-100 top-0 start-0 rounded-3" style="opacity: 1"></div>
            </div>

            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center gap-2 flex-wrap" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>

@include('components.rent.create-rent')

<script>

    carList();
    async function carList() {
        showLoader();
        let res = await axios.get("/car-list");
        hideLoader();

        let data = res.data['data'].reverse();
        let status = res.data['status'];

        if (status === 'success') {
           await fillUpFilter(data);
            initPagination(data,4);
        } else {
            errorToast(res.data['data']);
        }
    }

    // Function to initialize pagination
    function initPagination(data, carsPerPage = 4) {
        const totalPages = Math.ceil(data.length / carsPerPage);
        const pagination = $('#pagination');
        pagination.empty();
        // Create pagination links
        for (let i = 1; i <= totalPages; i++) {
            pagination.append(`
                <li class="page-item"><a class="page-link fs-4" href="#" data-page="${i}">${i}</a></li>
            `);
        }
        pagination.find('.page-item').first().addClass('active');
        // Display the first page
        displayCars(data, 1, carsPerPage);
         // Handle page click
         pagination.on('click', '.page-link', function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            const pageNumber = $(this).data('page');
            pagination.find('.page-item').removeClass('active');
            $(this).parent('.page-item').addClass('active');
            displayCars(data, pageNumber, carsPerPage);
            
        });
    }

     // Function to display cars for a specific page
    function displayCars(data, pageNumber, carsPerPage) {
        let carList = $('#carList');
        carList.empty();
        
        let start = (pageNumber - 1) * carsPerPage;
        let end = start + carsPerPage;
        let paginatedCars = data.slice(start, end);
        paginatedCars.forEach(function (car) {
            let availabilityButton=``;
            let BookNowButton=``;
                if(car['availability']==1){
                     availabilityButton=`
                        <p class="card-text text-white d-inline-block rounded bg-gradient-success text-uppercase px-3 py-2">Available</p> 
                    `;
                    BookNowButton=`
                       <button class="btn bg-gradient-info me-2 book_car" data-id="${car['id']}" data-price="${car['daily_rent_price']}">Book Car</button>
                    `;
                }else{
                     availabilityButton=`
                        <p class="card-text text-white d-inline-block rounded bg-gradient-danger text-uppercase px-3 py-2">Not Available</p> 
                    `;
                }
            let row = `
                <div class="col-md-6 col-sm-12">
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-6 position-relative">
                                <img src="/${car['image']}" class="card-img" alt="${car['name']}" >

                                <div class="action-btn position-absolute">
                                     ${BookNowButton}   
                                    <a class="btn bg-gradient-success view_car" href="/car/${car['id']}" >View</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title">${car['name']}</h5>
                                    <p class="card-text mb-1">Brand: ${car['brand']}</p>
                                    <p class="card-text mb-1">Model: ${car['model']}</p>
                                    <p class="card-text mb-1">Year: ${car['year']}</p>
                                    <p class="card-text mb-1">Car Type: ${car['car_type']}</p>
                                    <p class="card-text mb-1">Daily Rent Price: $${car['daily_rent_price']}</p>
                                    ${availabilityButton}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            carList.append(row);
        });

        // Show "no car" message if empty
        if (paginatedCars.length === 0) {
            let row = `
                <div class="col-12 min-vh-50 d-flex justify-content-center align-items-center">
                    <h1 class="text-center">No Car Found</h1>
                </div>
            `;
            carList.append(row);
        }

        // Add event listeners for edit and delete buttons
        carList.on('click', '.book_car', function () {
            let id = $(this).data('id');
            let dailyPrice= $(this).data('price');
            $('#carId').val(id);
            $('#carDailyPrice').val(dailyPrice);
            $('#dailyRate').text(dailyPrice);
            $("#rent-modal").modal('show');
        });

        carList.on('click', '.delete_car', function () {
            let id = $(this).data('id');
            let filePath = $(this).parents('.col-md-6').find('img').attr('src');
            $('#deleteID').val(id);
            $('#deleteFilePath').val(filePath);
            $("#delete-modal").modal('show');
        });
    }

    // Fill up filter
    function fillUpFilter(data) {
        let carTypeList = $('#car_type');
        let brandTypeList = $('#car_brand');
        let carTypeData=[];
        let carBrandData=[];

        data.forEach(function (item) {
                carTypeData.push(item['car_type']);
                carBrandData.push(item['brand']);
        })
        carTypeData= [...new Set(carTypeData)].sort();
        carBrandData= [...new Set(carBrandData)].sort();
        
        optionAdd(carTypeData,carTypeList);
        optionAdd(carBrandData,brandTypeList);
        
        function optionAdd(data,list){
            data.forEach(function (item) {
                let option=`<option value="${item}">${item}</option>`;
                list.append(option);
            })
        }


    }

    // Show Loder
    function showcarLoader() {
        $('.preloadercar').removeClass('d-none');
    }
    // Hide Loder
    function hidecarLoader() {
        $('.preloadercar').addClass('d-none');
    }

    async function filterCar(){

        let carType = $('#car_type').val();
        let brand = $('#car_brand').val();
        let availability = $('#car_availability').val();
        let car_daily_price = $('#car_daily_price').val();


            showcarLoader()
            let res= await axios.post("/car-filter",{car_type:carType,car_brand:brand,car_availability:availability,car_daily_price:car_daily_price});
            hidecarLoader()
            let data = res.data['data'].reverse();
            console.log(data);
            
            if (res.data['status'] === 'success') {
                initPagination(data,4);
            } else {
                errorToast(res.data['message']);
            }
            


        
    }

</script>

