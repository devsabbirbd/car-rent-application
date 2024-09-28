<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Car Rental Confirmation - Admin</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
      }

      .email-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
      }

      h1, h2, h3 {
        color: #000000;
        margin: 0;
      }

      p {
        margin: 5px 0;
      }

      .car-details img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px ;
      }

      .details-section {
        margin-bottom: 30px;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
      }

      .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007BFF;
        color: #ffffff !important;
        text-decoration: none;
        border-radius: 5px;
      }

      .button:hover {
        background-color: #0056b3;
      }

      .footer {
        margin-top: 20px;
        text-align: center;
        color: #777777;
        font-size: 12px;
      }
    </style>
  </head>
  <body>
    <div class="email-container">
      <h2>New Car Rental Confirmation</h2>
      <p>Hello Admin,</p>
      <p>A new car rental has been successfully placed by the user. Here are the full details:</p>

      <div class="details-section">
        <h3>User Details:</h3>
        <p><strong>Name:</strong> {{ $data['rent']['user']['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['rent']['user']['email'] }}</p>
        <p><strong>Mobile:</strong> {{ $data['rent']['user']['mobile'] }}</p>
        <p><strong>Address:</strong> {{ $data['rent']['user']['address'] }}</p>
      </div>

      <div class="details-section">
        <h3>Rental Details:</h3>
        <p><strong>Rental ID:</strong> #{{ $data['rental_id'] }}</p>
        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($data['rent']['start_date'])->format('d M, Y') }}</p>
        <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($data['rent']['end_date'])->format('d M, Y') }}</p>
        <p><strong>Duration:</strong> {{ $data['rent-days'] }} Day(s)</p>
        <p><strong>Total Cost:</strong> ${{ number_format($data['rent']['total_cost'], 2) }}</p>
      </div>

      <div class="details-section">
        <h3>Car Details:</h3>
        <p><strong>Car Name:</strong> {{ $data['car']['name'] }}</p>
        <p><strong>Brand:</strong> {{ $data['car']['brand'] }}</p>
        <p><strong>Model:</strong> {{ $data['car']['model'] }} ({{ $data['car']['year'] }})</p>
        <p><strong>Car Type:</strong> {{ $data['car']['car_type'] }}</p>
        <p><strong>Daily Rent Price:</strong> ${{ number_format($data['car']['daily_rent_price'], 2) }}</p>
      </div>

      <p style="text-align: center;">
        <a href="https://devsabbirbd.com/" class="button">Manage Rental</a>
      </p>

      <div class="footer">
        <p>© {{ date('Y') }} Car Rent by Developer Sabbir. All rights reserved.</p>
        <p>Faridpur, Dhaka, Bangladesh</p>
      </div>
    </div>
  </body>
</html>
