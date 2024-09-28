<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Exception;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Get all cars
    public function carList(Request $request){
        try{
        return response()->json([
            'status' => 'success',
            'data' => Car::all()
        ]);

        }catch(Exception $error){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'
            ]);
        }
    }

    // Get filtered cars
    public function carFilter(Request $request){

       // Get filter parameters
       $carType = $request->input('car_type');
       $brand = $request->input('car_brand');
       $availability = $request->input('car_availability');
       $carDailyPrice = $request->input('car_daily_price');

       // Build the query
       $query = Car::query();

       if (!empty($carType)) {
           $query->where('car_type', $carType);
       }

       if (!empty($brand)) {
           $query->where('brand', $brand);
       }

       if (isset($availability)) {
           $query->where('availability', $availability);
       }

       if (!empty($carDailyPrice)) {
           $query->where('daily_rent_price', '<=', $carDailyPrice);
       }

       // Execute the query and get the filtered results
       $cars = $query->get();
       if (empty($cars)) {
           return response()->json([
               'status' => 'failed',
               'message' => 'No cars found'
           ]);
       }else{
           return response()->json([
               'status' => 'success',
               'data' => $cars
           ]);
       }


    }

    public function carDetails(Request $request){
        $car_id=$request->id;
        $car=Car::where('id',$car_id)->first();
        
        return view('pages.frontend.car-details',compact('car'));
        
    }





}
