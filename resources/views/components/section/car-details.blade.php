@if(isset($car))
<div class="container">
    <div class="row gap-0 rounded-3 my-5 shadow-lg">
        <div class="col-md-6 ps-0">
            <img class="h-100 w-100 rounded-start" src="/{{$car['image']}}" alt="" srcset="">
        </div>
        <div class="col-md-6 d-flex justify-content-center flex-column">
        
            <h4 class="text-center fs-3 mb-3">{{$car['name']}}</h4>
            <div class="row gap-3 justify-content-center">
                
                <div class="col-3 text-center bg-gradient-info text-white p-3 rounded-3 pb-3">
                    <span><i class="fas fa-flag fs-3"></i></span>
                    <p class="text-bold text-center mb-0">Brand: {{$car['brand']}}</p>
                </div>
                <div class="col-3 text-center bg-gradient-dark text-white p-3 rounded-3 pb-3">
                    <span><i class="fas fa-cogs fs-3"></i></span>
                    <p class="text-bold text-center mb-0">Model: {{$car['model']}}</p>
                </div>
                <div class="col-3 text-center bg-gradient-warning text-white p-3 rounded-3 pb-3">
                    <span><i class="fas fa-calendar-alt fs-3"></i></span>
                    <p class="text-bold text-center mb-0">Year: {{$car['year']}}</p>
                </div>
                <div class="col-3 text-center bg-gradient-primary text-white p-3 rounded-3 pb-3">
                    <span><i class="fas fa-car fs-3"></i></span>
                    <p class="text-bold text-center mb-0">Car Type: {{$car['car_type']}}</p>
                </div>
                <div class="col-3 text-center bg-gradient-dark text-white rounded-3 py-2">
                    <span><i class="fas fa-dollar-sign fs-3"></i></span>
                    <p class="text-bold text-center mb-0">Daily Rent Price: ${{$car['daily_rent_price']}}</p>
                </div>

                @if($car['availability'] == 1)
                    <div class="col-3 text-center bg-gradient-success text-white p-3 rounded-3 pb-3">
                        <span><i class="fas fa-check-circle fs-3"></i></span>
                        <p class="text-bold text-center mb-0">Available</p>
                    </div>

                    <div class="col-12 text-center">
                         <button class="btn btn-lg btn-rounded fs-5 bg-gradient-info" id="book_car" data-id="{{$car['id']}}" data-price="{{$car['daily_rent_price']}}">Book Now</button>
                    </div>
                @else
                    <div class="col-3 text-center bg-gradient-danger text-white p-3 rounded-3 pb-3">
                        <span><i class="fas fa-times-circle fs-3"></i></span>
                        <p class="text-bold text-center mb-0">Not Available</p>
                    </div>
                @endif

            </div>

            
         
        </div>
    </div>

    <div class="row rounded-3 my-5 p-5 shadow-lg">
        <p>The sleek and stylish 2024 Velocity GT is a perfect blend of power, performance, and modern design. Equipped with a 3.5L twin-turbo V6 engine, this car delivers an exhilarating 400 horsepower, ensuring a smooth yet thrilling ride on highways or city streets. Its aerodynamic body is crafted to reduce drag and maximize speed, while the LED headlights and 19-inch alloy wheels give it a bold and futuristic look.
            <br>
            <br>
            Inside, the Velocity GT offers a luxurious experience with leather seats, a 12-inch infotainment system, and advanced driver-assist features such as adaptive cruise control and lane-keeping assist. The spacious interior provides comfort for long drives, and the premium sound system ensures top-quality entertainment.
            <br>
            <br>
            Developer Sabbir recommends the Velocity GT for anyone looking to combine practicality with excitement, as it offers a spacious trunk, great fuel efficiency, and cutting-edge technology to enhance both performance and convenience. Whether you're navigating city traffic or cruising along the coast, the 2024 Velocity GT guarantees an unforgettable driving experience.</p>
    </div>
</div>

@else
<div class="container">
    <div class="row">
        <div class="col-12 min-vh-50 d-flex justify-content-center align-items-center">
            <h1 class="text-center">No car details found</h1>
        </div>
    </div>
</div>
@endif


@if(isset($car) && $car['availability'] == 1)

<script>
        $('#book_car').on('click', function () {
            console.log("clicked");
            
            let id = $(this).data('id');
            let dailyPrice= $(this).data('price');
            $('#carId').val(id);
            $('#carDailyPrice').val(dailyPrice);
            $('#dailyRate').text(dailyPrice);
            $("#rent-modal").modal('show');
        });
</script>

@endif