<?php

namespace App\Http\Controllers\Admin;

use App\Helper\CarResponse;
use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{



/*
//////////////////////////////////////////////////////////
/////////------ Basic Authentication Start-----///////////
//////////////////////////////////////////////////////////
*/

    // Signup System
    public function signup(Request $request)
    {

        try {
            $userName=$request->input('name');
            $userEmail=$request->input('email');
            $userMobile=$request->input('mobile');
            $userAddress=$request->input('address');
            $password=$request->input('password');
            $user=User::create([
                'name'=>$userName,
                'email'=>$userEmail,
                'mobile'=>$userMobile,
                'address'=>$userAddress,
                'password'=>$password
            ]);
            if($user){
                return response()->json([
                    'status'=>'success',
                    'message'=>'User created successfully',
                ]); 
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'User creation failed',
                ]);
            }
        } catch (Exception $er) {
            return response()->json([
                    'status'=>'failed',
                    'message'=>'User creation failed',
                    'error'=>$er
                ]);
        }
        
    }

    // login System
    public function login(Request $request)
    {

        try {
            $userEmail=$request->input('email');
            $password=$request->input('password');
            $user=User::where('email',$userEmail)->where('password',$password)->first();

            if($user){
                $token = JWTToken::create($userEmail,$user->id,$user->role);
                return response()->json([
                    'status'=>'success',
                    'message'=>'User logged in successfully'
                ])->cookie('token', $token, 60*60*24);
            }else{
                return response()->json([
                    'status'=>'failed',
                    'message'=>'User login failed'
                ]);
            }
        } catch (Exception $er) {
            return response()->json([
                    'status'=>'failed',
                    'message'=>'User login failed'
                ]);
        }
    }

     // logout System
    public function logout()
    {
        session()->flush();
        return redirect('/')->cookie('token', '', -1);
    }

    // Customer Details
    public function profileDetails(Request $request)
    {
        $user_id=$request->header('id');
        $user = User::where('id',$user_id)->select('id','email','name', 'mobile','address','role')->first();
        return response()->json([
            'status'=>'success',
            'data'=>$user
        ]);
    }

    // Customer Listing
    public function customerList()
    {
        $allCustomerList=User::where('role','customer')->select('id','email','name', 'mobile','address','role')->get();
            return response()->json([
                'status'=>'success',
                'data'=>$allCustomerList
            ]);
    }

    // Delete Customer
    public function deleteCustomer(Request $request)
    {
        DB::beginTransaction();
        try{
            $customerId=$request->id;
            Rental::where('user_id',$customerId)->delete();
            $user=User::where('id',$customerId)->delete();
            if($user){
                DB::commit();
                return response()->json([
                    'status'=>'success',
                    'data'=>'Customer Deleted Successfully'
                ]);
            }else{
                DB::rollBack();
                return response()->json([
                    'status'=>'failed',
                    'data' => 'Something went wrong'
                ],200);
            }
        }catch(Exception $er){
            DB::rollBack();
            return response()->json([
                'status'=>'failed',
                'data' => 'Something went wrong'
            ],200);
        }
    }

    // Customer Details By Id
    public function customerDetailsById(Request $request)
    {
        $user_id=$request->id;
        $user = User::where('id',$user_id)->select('id','email','name', 'mobile','address')->first();
        return response()->json([
            'status'=>'success',
            'data'=>$user
        ]);
    }


    // Update Customer Details
    public function customerDetailsUpdate(Request $request)
    {
        $user_id=$request->input('id');
        $userName=$request->input('name');
        $userEmail=$request->input('email');
        $userMobile=$request->input('mobile');
        $userAddress=$request->input('address');
        $user = User::where('id',$user_id)->update([
            'name'=>$userName,
            'email'=>$userEmail,
            'mobile'=>$userMobile,
            'address'=>$userAddress
        ]);
        if($user){
            return response()->json([
                'status'=>'success',
                'message'=>'User details updated successfully',
            ]);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'User details update failed',
            ]);
        }
    }


    // Update Profile Details Admin and Customer
    public function ProfileUpdate(Request $request){
        $user_id=$request->header('id');
        $user = User::where('id',$user_id)->where('password',$request->input('password'))->update([
            'name'=>$request->input('name'),
            'mobile'=>$request->input('mobile'),
            'address'=>$request->input('address')
        ]);

        if($user){
            return response()->json([
                'status'=>'success',
                'message'=>'User details updated successfully',
            ]);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Password is incorrect'
            ]);
        }
    }


/*
////////////////////////////////////////////////////////
////////------ Dashboard Customer Page -----////////////
////////////////////////////////////////////////////////
*/

 function dashboard(){
     return view('pages.dashboard.dashboard-page');
 }
 function profile(){
     return view('pages.dashboard.profile-page');
 }
 function index(){
     return view('pages.dashboard.customer-page');
 }

 public function dashboardSummary(){
        
    $totalCar=Car::count();
    $availableCar=Car::where('availability','1')->count();
    $totalCustomer=User::where('role','customer')->count();
    $totalCost=Rental::sum('total_cost');
    $totalRental=Rental::count();
    $totalCompletedRental=Rental::where('status','Completed')->count();
    $totalOngoingRental=Rental::where('status','Ongoing')->count();
    $totalCanceledRental=Rental::where('status','Canceled')->count();
    $summary=[
        'totalCar'=>$totalCar,
        'availableCar'=>$availableCar,
        'totalCustomer'=>$totalCustomer,
        'totalCost'=>round($totalCost,2),
        'totalRental'=>$totalRental,
        'totalCompletedRental'=>$totalCompletedRental,
        'totalOngoingRental'=>$totalOngoingRental,
        'totalCanceledRental'=>$totalCanceledRental
    ];
    return $summary;
    

 }




}
