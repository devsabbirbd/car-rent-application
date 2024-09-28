<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    //

    public function index(){
        return view('pages.dashboard.cars-page');
    }

    public function carCreate(Request $request){

        try{
            // Important Data
            $user_id=$request->header('id');
            $carName=$request->car_name;
            $carBrand=$request->car_brand;
            $carModel=$request->car_model;
            $carYear=$request->car_year;
            $carType=$request->car_type;
            $carDailyRate=$request->car_daily_rate;
            $carAvailability=$request->car_availability;

            if ($request->hasFile('car-img')) {
                //Manage image Request
                $img=$request->file('car-img');
                $time=time();
                $filename= str_replace(' ', '_',$img->getClientOriginalName());
                $img_name="$user_id-$time-$filename";
                $img_url="uploads/car/$img_name";

                // Upload File
                $img->move(public_path('uploads/car'),$img_name);

                $data=[
                    'name'=>$carName,
                    'brand'=>$carBrand,
                    'model'=>$carModel,
                    'year'=>$carYear,
                    'car_type'=>$carType,
                    'daily_rent_price'=>$carDailyRate,
                    'availability'=>$carAvailability,
                    'image'=>$img_url,
                ];

                $data=Car::create($data);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Car created successfully',
                    'data' => $data
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'data' => 'Something went wrong'
                ]);
            }
        }catch(Exception $error){
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
                'data' => $error
            ]);
        }
    

    }

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

    public function carUpdate(Request $request){

        try {
            
            // Car Update Data
                $user_id=$request->header('id');
                $carName=$request->car_name;
                $carBrand=$request->car_brand;
                $carModel=$request->car_model;
                $carYear=$request->car_year;
                $carType=$request->car_type;
                $carDailyRate=$request->car_daily_rate;
                $carAvailability=$request->car_availability;
                $carID=$request->car_id;
                $img_url=$request->img_url;

            if ($request->hasFile('car_img')) {
                //Collect image Request
                File::delete(public_path($img_url));
                $img=$request->file('car_img');
                $time=time();
                $filename= str_replace(' ', '_',$img->getClientOriginalName());
                $img_name="$user_id-$time-$filename";
                $img_url="uploads/car/$img_name";
    
                // Upload File
                $img->move(public_path('uploads/car'),$img_name);
    
    
                $data= Car::where('id',$carID)->update([
                    'name'=>$carName,
                    'brand'=>$carBrand,
                    'model'=>$carModel,
                    'year'=>$carYear,
                    'car_type'=>$carType,
                    'daily_rent_price'=>$carDailyRate,
                    'availability'=>$carAvailability,
                    'image'=>$img_url
                ]);
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Car updated successfully',
                    'data' => $data
                ]);


            }else{
                $data=Car::where('id',$carID)->update([
                    'name'=>$carName,
                    'brand'=>$carBrand,
                    'model'=>$carModel,
                    'year'=>$carYear,
                    'car_type'=>$carType,
                    'daily_rent_price'=>$carDailyRate,
                    'availability'=>$carAvailability
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Car updated successfully',
                    'data' => $data
                ]);
            }
        }catch(Exception $error){
            return response()->json([
                'status' => 'failed',
                'data' => 'Something went wrong'
            ],500);
        }
    }

     public function carDelete(Request $request){

        $car_id=$request->car_id;
        $img_url=ltrim($request->img_url, '/');
        $rental=Rental::where('car_id',$car_id)->first();
        if($rental){
            return response()->json([
                'status' => 'failed',
                'message' => 'Car can not be deleted as it is in use'
            ]);
        }
        $car=Car::where('id',$car_id)->where('image',$img_url)->delete();
        if($car){
            File::delete(public_path($img_url));
            return response()->json([
                'status' => 'success',
                'data'=>'Car Deleted Successfully'
            ]);
        }else{
            return response()->json([
                'status' => 'failed',
                'data' => 'Something went wrong'
            ],200);
        }

    }


    public function carDetailsById(Request $request){
        $car_id=$request->car_id;
        $car=Car::where('id',$car_id)->first();

        if($car){
            return response()->json([
                'status' => 'success',
                'data' => $car
            ]);
        }else{
            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong'
            ]);
        }
    }


}
