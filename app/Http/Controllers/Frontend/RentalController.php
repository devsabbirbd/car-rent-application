<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AdminMail;
use App\Mail\CustomerMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    // Rent Car Booking
    public function rentCar(Request $request)
    {

        DB::beginTransaction();
        try
        {
            $customer_id=$request->header('id');
            $car_id=$request->car_id;
            $startDate=$request->start_date;
            $endDate=$request->end_date;
            $rentDays = $request->rentdays;

            if($customer_id === null){
                return response()->json([
                    'status'=>'failed',
                    'message'=>'Please login first'
                ]);
            }

            //Backend Calculations
            $total_cost=Car::where('id',$car_id)->first()->daily_rent_price*$rentDays;

            // Check Car Availability
            $carAvailable=Car::where('id',$car_id)->where('availability','1')->first();

            if(!$carAvailable){
                return response()->json([
                    'status'=>'failed',
                    'message'=>'Car is not available'
                ]);
            }else{

                $rent=Rental::create([
                    'user_id'=>$customer_id,
                    'car_id'=> $car_id,
                    'start_date'=>$startDate,
                    'end_date'=>$endDate,
                    'total_cost'=>$total_cost
                ]);


                // Update Car Availability

                $carAvailable->update([
                    'availability'=>'0',
                ]);

                $car=Car::where('id',$car_id)->first();
                $emailData=[
                    'email'=>$rent->user->email,
                    'name'=>$rent->user->name,
                    'rental_id'=>$rent->id,
                    'rent-days'=>$rentDays,
                    'car'=>$car,
                    'rent'=>$rent
                ];

                // Send Email to Customer
                Mail::to($emailData['email'])->send(new CustomerMail($emailData));

                // Send Email to All Admin
                $adminEmail=User::where('role','admin')->get();
                if($adminEmail != "[]"){
                    foreach($adminEmail as $admin){
                        Mail::to($admin->email)->send(new AdminMail($emailData));
                    }
                }
                
                DB::commit();
                return response()->json([
                    'status'=>'success',
                    'message'=>'Rental created successfully',
                ]);

            }

        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }
    }

   // Get Rental History
   public function rentalHistory(Request $request)
   {
    $customer_id=$request->header('id');
    $rentals=Rental::where('user_id',$customer_id)->with('car')->get();
    return response()->json([
        'status'=>'success',
        'data'=>$rentals
    ]);
   }

   // Cancel Rental
   public function rentalCancel(Request $request)
   {
    DB::beginTransaction();
        try
        {
            $customer_id=$request->header('id');
            $rental_id=$request->rental_id;
            $rental=Rental::where('id',$rental_id)->where('user_id',$customer_id)->with('car')->first();
            if($rental){
                $rental->update([
                    'status'=>'Canceled'
                ]);
                $rental->car->update([
                    'availability'=>'1',
                ]);
                DB::commit();
                return response()->json([
                    'status'=>'success',
                    'message'=>'Rental cancelled successfully',
                    'rental'=>$rental
                ]);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'Something went wrong'
                ]);
            }
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }

   }


}
