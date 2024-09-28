<div class="container mt-5 min-vh-90 d-flex flex-column justify-content-center dashboard-summary ">
    <div class="row">
        <!-- Total Number of Cars -->
        <div class="col-lg-3 col-sm-4 col-12 mt-sm-0 mt-4">
            <div class="card text-center text-white bg-gradient-primary">
                <div class="card-body">
                    <i class="fas fa-car fa-3x mb-3"></i>
                    <h5 class="card-title text-white text-white">Total Cars</h5>
                    <p class="card-text display-4" id="totalCars">0</p>
                </div>
            </div>
        </div>

        <!-- Available Cars -->
        <div class="col-lg-3 col-sm-4 col-12 mt-sm-0 mt-4">
            <div class="card text-center text-white bg-gradient-success">
                <div class="card-body">
                    <i class="fas fa-car-side fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Available Cars</h5>
                    <p class="card-text display-4" id="availableCars">0</p>
                </div>
            </div>
        </div>

        
        <!-- Total Customers -->
        <div class="col-lg-3 col-sm-4 col-12 mt-sm-0 mt-4">
            <div class="card text-center text-white bg-gradient-warning">
                <div class="card-body">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Total Customers</h5>
                    <p class="card-text display-4" id="totalCustomers">0</p>
                </div>
            </div>
        </div>

        <!-- Total Earnings -->
        <div class="col-lg-3 col-sm-4  col-12 mt-lg-0 mt-4">
            <div class="card text-center text-white bg-gradient-dark">
                <div class="card-body">
                    <i class="fas fa-dollar-sign fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Total Earnings</h5>
                    <p class="card-text display-4" id="totalEarnings">0</p>
                </div>
            </div>
        </div>
        
        
        <!-- Total Rentals -->
        <div class="col-lg-3 col-sm-4  col-12 mt-4">
            <div class="card text-center text-white bg-gradient-info">
                <div class="card-body">
                    <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Total Rentals</h5>
                    <p class="card-text display-4" id="totalRentals">0</p>
                </div>
            </div>
        </div>

        <!-- Total Completed Rent -->
        <div class="col-lg-3 col-sm-4  col-12 mt-4">
            <div class="card text-center bg-gradient-success text-white">
                <div class="card-body">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Completed Rentals</h5>
                    <p class="card-text display-4" id="totalCompleted">0</p>
                </div>
            </div>
        </div>
        

        <!-- Total Cancel Rent -->
        <div class="col-lg-3 col-sm-4  col-12 mt-4">
            <div class="card text-center bg-gradient-danger text-white">
                <div class="card-body">
                    <i class="fas fa-times-circle fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Cancelled Rentals</h5>
                    <p class="card-text display-4" id="totalCancelled">0</p>
                </div>
            </div>
        </div>

        <!-- Total Ongoing Rent -->
        <div class="col-lg-3 col-sm-4  col-12 mt-4">
            <div class="card text-center bg-gradient-info text-white">
                <div class="card-body">
                    <i class="fas fa-sync-alt fa-3x mb-3"></i>
                    <h5 class="card-title text-white">Ongoing Rentals</h5>
                    <p class="card-text display-4" id="totalOngoing">0</p>
                </div>
            </div>
        </div>


    </div>
</div>






<script>
    getSummaryList();
    async function getSummaryList() {
        showLoader();
        let res=await axios.post("/dashboard-summary");
        document.getElementById('totalCars').innerText=res.data['totalCar']
        document.getElementById('availableCars').innerText=res.data['availableCar']
        document.getElementById('totalRentals').innerText=res.data['totalRental']
        document.getElementById('totalEarnings').innerText=res.data['totalCost']
        document.getElementById('totalCustomers').innerText=res.data['totalCustomer']
        document.getElementById('totalCompleted').innerText=res.data['totalCompletedRental']
        document.getElementById('totalCancelled').innerText=res.data['totalCanceledRental']
        document.getElementById('totalOngoing').innerText=res.data['totalOngoingRental']
        hideLoader();



    }
</script>
