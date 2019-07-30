<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bookinginfo;
use App\user;
use App\aaa;
use Auth;

use DB;


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
    //echo($Empno);
    //echo($strd);
    //echo($endd);
   DB::table('bookinginfos')
            ->where('Empno', $Empno )
            ->where('Strd', $strd )
            ->where('Endd', $endd )
            ->update(['Cleval' => 3]);
            //Session::put('key', '$Empno');
            app('App\Http\Controllers\MailController')->send($Empno);
            return redirect()->back();

}

public function doreject($Empno ,$roomid,$strd,$endd){
    //echo($Empno);
    //echo($strd);
    //echo($endd);
   DB::table('bookinginfos')
            ->where('Empno', $Empno )
            ->where('Strd', $strd )
            ->where('Endd', $endd )
            ->update(['Cleval' => 5]);
            //Session::put('key', '$Empno');
            app('App\Http\Controllers\MailController')->rejectroom($Empno);
            return redirect()->back();

}


//payment information part

public function paymentinfo()
{
    $data=   DB::table('users')
    ->select('Uname','Empno','Abill')
    ->get();

    //$data = DB::table('bookinginfos')->where('Cleval',!3)->get();
   //,['user'=>$data]
    //$data = bookinginfo::table('Empno')->get();
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
            'users.faculty','users.Department','users.Position','users.Email')
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
    
    $am = ($amt[0]->price);


    

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
        $roomid = $request->input('id');

        $desc = $request->input('desc');

        $price = $request->input('price');

        $size = $request->input('size');

        $bedtype = $request->input('bedtype');

        $fac = $request->input('fac');

        $file = $request->file('filename[]');

        
        

        
        DB::insert('insert into rooms (Roomid,description,price,size,Bed_Type,Facilities) values(?,?,?,?,?,?)',[$roomid,$desc,$price,$size,$bedtype,$fac]);
            
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
    ->select('users.Empno','users.Uname','users.gender','users.faculty','users.Department','users.Position','users.Email')
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
}


