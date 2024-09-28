<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Confirmation</title>
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

      h1 {
        color: #000000;
        margin: 0;
      }

      p {
        margin: 3px 0;
      }

      .car-details img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px ;
      }

      .car-details {
        margin-bottom: 35px;
        padding: 30px;
        border-radius: 8px;
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
      <h1>Car Rental Confirmation</h1>
      <p>Hi <b>{{ $data['name'] }}</b>, </p>
      <p>Thank you for renting a car with us! Here are the details of your rental:</p>
      <div class="car-details">
        <img src="https://images.pexels.com/photos/2365572/pexels-photo-2365572.jpeg?cs=srgb&dl=pexels-mikebirdy-2365572.jpg" alt="Car Image">
        <h2>Rental ID: #{{ $data['rental_id'] }}</h2>
        <h3>Car Details:</h3>
        <p>
          <strong>Car Name:</strong> {{ $data['car']['name'] }}
        </p>
        <p>
          <strong>Brand:</strong> {{ $data['car']['brand'] }}
        </p>
        <p>
          <strong>Model:</strong> {{ $data['car']['model'] }} ({{ $data['car']['year'] }})
        </p>
        <p>
          <strong>Car Type:</strong> {{ $data['car']['car_type'] }}
        </p>
        <p>
          <strong>Daily Rent Price:</strong> ${{ number_format($data['car']['daily_rent_price'], 2) }}
        </p>
        <h3>Rental Period:</h3>
        <p>
          <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($data['rent']['start_date'])->format('d M, Y') }}
        </p>
        <p>
          <strong>End Date:</strong> {{ \Carbon\Carbon::parse($data['rent']['end_date'])->format('d M, Y') }}
        </p>
        <p>
          <strong>Rental Car For : </strong> {{ $data['rent-days'] }} Day
        </p>
        <p>
          <strong>Total Cost:</strong> ${{ number_format($data['rent']['total_cost'], 2) }}
        </p>
        <p>If you have any questions, feel free to contact us. We hope you enjoy your rental experience!</p>
        <p style="text-align: center;">
          <a href="https://devsabbirbd.com" class="button">View Your Rental History</a>
        </p>
      </div>
      <div class="footer">
        <p>© {{ date('Y') }} Car Rent By Developer Sabbir. All rights reserved.</p>
        <p>Faridpur, Dhaka, Bangladesh</p>
      </div>
    </div>
  </body>
</html>