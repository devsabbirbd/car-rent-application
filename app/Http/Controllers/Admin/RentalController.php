<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class RentalController extends Controller
{
    
    public function rentalHistory(){
        return view('pages.dashboard.rental-page');
    }

    public function rentalList()
    {
        try
        {
            $rentals = Rental::with(['car:id,name,brand', 'user:id,name'])
            ->select('id', 'car_id', 'user_id', 'start_date', 'end_date', 'total_cost', 'status')
            ->get();

            return response()->json([
            'status'=>'success',
            'data'=>$rentals
            ]);

        }catch(Exception $e){
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }

    }


    public function rentalDelete(Request $request)
    {

        DB::beginTransaction();
        try
        {
            $rental = Rental::where('id', $request->id)->with('car')->first();
            $rental->car->update([
                'availability'=>'1'
            ]);
            $rental->delete();
            DB::commit();
            return response()->json([
                'status'=>'success',
                'message'=>'Rental deleted successfully'
            ]);
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }
    }
    

    public function rentalStatusUpdate(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $id=$request->id;
            $status=$request->status;

            if($status=='Canceled'){
                $rental=Rental::where('id',$id)->with('car')->first();
                $rental->car->update([
                    'availability'=>'1'
                ]);
                $rental->update([
                    'status'=>'Canceled'
                ]);
                DB::commit();
                return response()->json([
                    'status'=>'success',
                    'message'=>'Rental status updated successfully'
                ]);
            }else if($status=='Completed'){
                $rental=Rental::where('id',$id)->with('car')->first();
                $rental->car->update([
                    'availability'=>'1'
                ]);
                $rental->update([
                    'status'=>'Completed'
                ]);
                DB::commit();
                return response()->json([
                    'status'=>'success',
                    'message'=>'Rental status updated successfully'
                ]);
            }else if($status=='Ongoing'){
                $rental=Rental::where('id',$id)->with('car')->first();
                $availability=$rental->car->availability;
                if($availability==0){
                    return response()->json([
                        'status'=>'failed',
                        'message'=>'Car is not available'
                    ]);
                }else{
                    $rental->car->update([
                        'availability'=>'0'
                    ]);
                    $rental->update([
                        'status'=>'Ongoing'
                    ]);
                    DB::commit();
                    return response()->json([
                        'status'=>'success',
                        'message'=>'Rental status updated successfully'
                    ]);
                }
                
            }
        }catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'=>'failed',
                'message'=>$e->getMessage()
            ]);
        }
    }

    public function rentalHistoryById(Request $request)
    {
        $user_id=$request->id;
        $rentals = Rental::with(['car:id,name,brand,model', 'user:id,name']);
        if($user_id){
            $rentals = $rentals->where('user_id', $user_id);
            $rentals = $rentals->get();
            return response()->json([
                'status'=>'success',
                'data'=>$rentals
            ]);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Something went wrong'
            ]);
        }
        
    }

}
