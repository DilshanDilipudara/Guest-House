<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bookinginfo;
use App\user;
use App\aaa;
use Auth;
use Image;
use DB;
use Carbon\Carbon;




class front extends Controller
{
    
    public function managewaiting(){

        $data=   DB::table('bookinginfos')
        ->select('users.Uname','bookinginfos.Jtype','bookinginfos.Roomid',
                'bookinginfos.Strd','bookinginfos.Endd','bookinginfos.Empno')
        ->join('users','users.Empno','=','bookinginfos.Empno')
        ->where('Cleval','=','0')
        ->get();

        //$data = DB::table('bookinginfos')->where('Cleval',!3)->get();

        //$data = bookinginfo::table('Empno')->get();
    Return view('adminIndex',['user'=>$data]);
}





public function store(Request $request )
{
    
    //dd($request->all());
$name=$request->input('/payment');
$data=   DB::table('bookinginfos')
    ->select('users.Uname',
            'bookinginfos.Empno','users.Abill')
    ->join('users','users.Empno','=','bookinginfos.Empno')
    ->where('Empno',!3)
    ->get();

}



 //room confirm part
 public function confirmrequest(){

    $data=   DB::table('bookinginfos')
    ->select('users.Uname','bookinginfos.Jtype','bookinginfos.Roomid',
            'bookinginfos.Strd','bookinginfos.Endd','bookinginfos.Empno')
    ->join('users','users.Empno','=','bookinginfos.Empno')
    ->where('Cleval','=','0')
    ->get();  
  
Return view('adminIndex',['user'=>$data]);
}


public function doconfirm($Empno ,$roomid,$strd,$endd){
   
   DB::table('bookinginfos')
            ->where('Empno', $Empno )
            ->where('Strd', $strd )
            ->where('Endd', $endd )
            ->update(['Cleval' => 3]);
           
            app('App\Http\Controllers\MailController')->send($Empno);
            return redirect()->back();

}

public function doreject($Empno ,$roomid,$strd,$endd){
  
   DB::table('bookinginfos')
            ->where('Empno', $Empno )
            ->where('Strd', $strd )
            ->where('Endd', $endd )
            ->update(['Cleval' => 5]);
          
            app('App\Http\Controllers\MailController')->rejectroom($Empno);
            return redirect()->back();

}


//payment information part

public function paymentinfo()
{
    $data=   DB::table('users')
    ->select('Uname','Empno','Abill')
    ->get();

  
Return view('paymentinfo',['user'=>$data]);

}


public function dopay(Request $request){
$amount=$request->input('/payinfo');
$emp=$request->input('Empno');
$now=$request->input('cur');


DB::table('users')
    ->where('Empno', $emp )
    ->update(['Abill' =>$now-$amount]);
    return redirect()->back();
   

// $data = DB::table('bookinginfos')->where('Cleval',!3)->get();

//$data = bookinginfo::table('Empno')->get();
//Return view('home');

}




// add user part

public function confirmuser(){

    $data=   DB::table('users')
    ->select('users.Empno','users.Uname','users.gender',
            'users.faculty','users.Department','users.Position','users.email')
    ->where('Crts',0)
    ->get();

    
Return view('adduser',['user'=>$data]);
}

public function douserconfirm($Empno){
    //echo("$Empno");
    DB::table('users')
            ->where('Empno', $Empno )
            ->update(['Crts' => 1]);

            app('App\Http\Controllers\MailController')->useraccessmail($Empno);
            return redirect()->back();
//dd($data->all());
}
public function rejectuser($Empno){
    //echo("$Empno");
    DB::table('users')
            ->where('Empno', $Empno )
            ->update(['Crts' => 5]);
            app('App\Http\Controllers\MailController')->rejectmail($Empno);
            return redirect()->back();
//dd($data->all());
}

//Booking

public function bookThis(Request $request){

    $name = $request->input('userName');

    $pos = $request->input('position');

    $dept = $request->input('department');

    $phone = $request->input('phone');

    $strd = $request->input('start');

    $endd = $request->input('end');

    $Empno = Auth::user()->Empno;

    $roomid = $request->input('roomNo');
    
    $reason = $request->input('optradio'); 

    $amt = DB::table('rooms')->select('rooms.price')->where('Roomid',$roomid)->get();
    

       $formatted_dt1=Carbon::parse($request->start);

        $formatted_dt2=Carbon::parse($request->end);

        $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
      

    $am = ($amt[0]->price)*$date_diff;


   

    $bookingdata = array($Empno,$reason,$roomid,$strd,$endd);

    // dd($reason);

    // dd($endd);
    // DB::table('bookinginfos')
    //         ->insert(['Empno' => $Empno]);


    //         return redirect()->back();


            DB::insert('insert into bookinginfos (Empno,Jtype,Roomid,Strd,Endd,Amount) values(?,?,?,?,?,?)',[$Empno,$reason,$roomid,$strd,$endd,$am]);
        
            Return view('index');



}



public function addRoom(Request $request)


{

   $validationdata = $request->validate([
       'Roomid' => 'unique:rooms'
   ]);

    $roomid = $request->input('id');

    
        
    $desc = $request->input('desc');

    $price = $request->input('price');

    $size = $request->input('size');

    $bedtype = $request->input('bedtype');

    $fac = $request->input('fac');
   
    $image = $request->file('select_file');
   
    $new_name = rand() . '.' . $image->getClientOriginalExtension();
     
    
    Image::make($image)->resize(300,300)->save(public_path('/uploads/room/'.  $new_name))->save();
     
    
    DB::insert('insert into rooms (Roomid,description,price,size,Bed_Type,Facilities,room_image) values(?,?,?,?,?,?,?)',[$roomid,$desc,$price,$size,$bedtype,$fac,$new_name]);
        
    return redirect()->back()
    ->with('success','Room Added successfully');

   
    


       
        

}





public function mypdf(){
    $Empno = Auth::user()->Empno;
    $data=   DB::table('bookinginfos')
   
    ->select('users.Uname','bookinginfos.Jtype','bookinginfos.Roomid',
            'bookinginfos.Strd','bookinginfos.Endd','bookinginfos.Empno')
    ->join('users','users.Empno','=','bookinginfos.Empno')
    ->where('Cleval','=','3')
    ->where('users.Empno', '=',$Empno)
    ->get();  
  
Return view('mypdf',['user'=>$data]);
}


public function downloadpdf($Empno ,$roomid,$strd,$endd){

    app('App\Http\Controllers\PDFController')->pdf($Empno,$roomid,$strd,$endd);
  
//Return view('mypdf',['user'=>$data]);
}


// user details
public function userdetails(){

    $data=   DB::table('users')
    ->select('users.Empno','users.Uname','users.gender','users.faculty','users.Department','users.Position','users.email')
            ->where('users.position','!=','Admin')
            ->where('users.Crts','=','1')
    ->get();

    
Return view('userdetails',['user'=>$data]);
}

public function removeuser($Empno){
    
    $data=   DB::table('users')
    ->select('users.id')
    ->where('users.Empno','=', $Empno)
    ->delete();

    return redirect()->back();

       
     
}
public function setadmin($Empno){
    
    $data=   DB::table('users')
    ->select('users.id')
    ->where('users.Empno','=', $Empno)
    ->update(['Position' =>'Admin']);

    return redirect()->back();

       
     
}

public function summary(){

    $data=   DB::table('bookinginfos')
    ->select('users.Uname','bookinginfos.Jtype','bookinginfos.Roomid','bookinginfos.Amount',
            'bookinginfos.Strd','bookinginfos.Endd','bookinginfos.Empno')
    ->join('users','users.Empno','=','bookinginfos.Empno')
    ->where('Cleval','=','3')
    ->get();  
  
Return view('summary',['user'=>$data]);
}


public function updateroom(){

    $data =  DB::table('rooms')
             ->get();

       return view('updateroom',compact('data'));      
}

public function updateroomvalue(Request $request)


{
    $roomid = $request->input('id');
        
    $desc = $request->input('desc');

    $price = $request->input('price');

    $size = $request->input('size');

    $bedtype = $request->input('bedtype');

    $fac = $request->input('fac');
   
    $image = $request->file('select_file');
   
    $new_name = rand() . '.' . $image->getClientOriginalExtension();

    
    Image::make($image)->resize(300,300)->save(public_path('/uploads/room/'.  $new_name))->save();
     
     DB::table('rooms')
        ->where('Roomid',$roomid)
        ->update(['description'=>$desc,'price'=>$price,'size'=>$size,'Bed_Type'=>$bedtype,'Facilities'=> $fac,'room_image'=>$new_name]);

    return redirect()->back()
    ->with('success','Room Added successfully');
     

}


public function deleteroom(){

    $data =  DB::table('rooms')
             ->get();

       return view('deleteroom',compact('data'));      
}

public function deleteroomdetails(Request $request){


    
    $id = $request->input('id');
        
  
    DB::table('rooms')->where('Roomid', $id)->delete();
    return redirect()->back();
}


}


