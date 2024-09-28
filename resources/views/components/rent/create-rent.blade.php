<div  class="modal fade" id="rent-modal" tabindex="-1"  data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="card px-2">
                    <div class="card-body">
                        <span type="button" id="modal-close" class="btn-close position-absolute top-5 end-5" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times-circle fs-4" style="color: red !important;"></i>
                        </span>
                        <form action="javascript:void(0)" id="rent-form">
                            <h4 class="text-center">Car Rent</h4>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="form-label fs-5">Start date</label>
                                    <input id="startDate" class="form-control" type="date"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label fs-5">End date</label>
                                    <input id="endDate"  class="form-control" type="date"/>
                                </div>
                                <div class="col-md-12 my-4">
                                    <h6><i class="fas fa-hand-holding-usd"></i> Daily Rate : <i class="fas fa-dollar-sign"></i>  <span id="dailyRate"></span></h6>
                                    <h6><i class="fas fa-calendar-alt"></i> Days: <span id="daysCount"></span></h6>
                                    <h6>
                                        <i class="fas fa-calculator"></i>
                                        Total :
                                        <i class="fas fa-dollar-sign"></i> 
                                        <span id="total"></span>
                                    </h6>
                                    <input type="hidden" id="carId">
                                    <input type="hidden" id="carDailyPrice">
                                </div>
                            </div>
                            
                            <button onclick="rentCar()" class="btn w-100 bg-gradient-primary">Book</button>
                    </form>
                    </div>
                </div>
            </div>
    </div>
</div>


<script>
    
  async function rentCar() {
        let car_id=$('#carId').val();
        let start_date=$('#startDate').val();
        let end_date=$('#endDate').val();
        let rentdays=parseInt($('#daysCount').text());

        if(start_date.length===0){
            errorToast('Start date is required')
        }else if(end_date.length===0){
            errorToast('End date is required')
        }else if(rentdays===0){
            errorToast('Rent days is required')
        }else{
            @if(Cookie::get('token')!==null)
                showLoader();
                let res= await axios.post("/rent-car",{
                    car_id:car_id,
                    start_date:start_date,
                    end_date:end_date,
                    rentdays:rentdays
                })
                hideLoader();
                if(res.data['status']==='success'){
                    successToast(res.data['message']);
                    setTimeout(function () {
                        window.location.href="{{url('rental-history')}}";
                    },1000);
                }
                else{
                    errorToast(res.data['message'])
                }

            @else
                errorToast('Please login first');
            @endif

        }
  }

    // Start date, end date , total calculator

    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    $('#startDate').attr('min', formattedDate);
    $('#startDate, #endDate').on('change', function() {
        const startDate = new Date($('#startDate').val());
        const endDate = new Date($('#endDate').val());

        if (startDate && endDate && startDate <= endDate) {
            const daysDiff = Math.ceil((endDate - startDate) / (1000 * 3600 * 24));
            let total = $('#dailyRate').text()*daysDiff;
            total = total.toFixed(2);

            $('#daysCount').text(daysDiff+" Day");
            $('#total').text(total);
            
        } else {
            $('#daysCount').val('');
            $('#total').val('');
        }

        // Set minimum date for end date
        if ($(this).is('#startDate')) {
            $('#endDate').attr('min', $('#startDate').val());
        }
    });


</script>
