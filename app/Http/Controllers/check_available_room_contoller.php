<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class check_available_room_contoller extends Controller
{
    public function checkdate(Request $request){
         
        $this->validate($request,[
            'startdate' => 'required|date|after:today',
              'enddate' => 'required|date|after:startdate',
            
    ]);
    
            
  

        $start_date = $request->input('startdate');   
        $end_date  = $request->input('enddate');

       

        $formatted_dt1=Carbon::parse($request->startdate);

        $formatted_dt2=Carbon::parse($request->enddate);

        $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
      

        $booking_room = DB::table('bookinginfos')
                        ->wheredate('Strd','>=',$start_date)
                        ->wheredate('Endd','<=',$end_date)
                        ->orwhere('Strd','<=',$start_date)
                            ->where('Endd','>=',$start_date)
                        ->orwhere('Strd','<=',$end_date)
                             ->where('Endd','>=',$end_date)
                        ->where('Cleval','==',3)         
                        ->select('Roomid')
                        ->distinct()
                       ->get();

                     
         $room = DB::table('rooms')
              ->select('Roomid','price','size','description','Bed_Type','Facilities','room_image')
              ->get(); 
         
              $booking_room_length = count($booking_room);
              $room_len = count($room);
       
              if($booking_room_length==0){
                 
                $data = $room;  
                  
              }
              else{
                    
                     foreach($room as $allroom){
                         $flag = false;
                         foreach($booking_room as $booked){
                             if(($allroom->Roomid) == ($booked->Roomid)){
                                 $flag = true;
                             }
                         }
                         if($flag == false){
                             $data[] = $allroom;
                         }

                     }
                    }

        
         foreach($data as $value){
             
            $pri = $value->price * $date_diff;
             $value->pri = $pri;
            
         }
             
        
       
       
        
        $date[] = array($start_date,$end_date);
       // dd($date[0][0]);
       return view('availableroom',compact('data','date'));
    }   
    
    

    
}
