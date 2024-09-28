@extends('layout.app')

@section('content')
    @include('components.header.header')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-4">About Us</h1>
                <p>Welcome to Car Rent, your trusted car rental service. We offer a wide range of well-maintained vehicles to meet all your transportation needs, whether for business trips, vacations, or special occasions. Our mission is to provide you with the best rental experience, combining convenience, affordability, and exceptional customer service.</p>
                
                <p>Since our founding in 2024, we’ve built a reputation for delivering high-quality rental cars and a seamless booking process. From compact cars to luxury SUVs, we have the right vehicle for every journey. With transparent pricing and no hidden fees, you can drive with confidence knowing you are getting the best deal possible.</p>
    
                <p>Our professional and friendly team is always here to assist you, ensuring your rental process is smooth from start to finish. We’re passionate about providing safe, reliable, and comfortable vehicles to make your travels enjoyable and stress-free.</p>
            </div>
            <div class="col-md-6">
                <img src="https://www.revv.co.in/blogs/wp-content/uploads/2021/02/Car-Rental-from-Revv.jpg" class="img-fluid rounded w-100" alt="Car Rental">
            </div>
        </div>
    </div>
    @include('components.footer.footer')
@endSection