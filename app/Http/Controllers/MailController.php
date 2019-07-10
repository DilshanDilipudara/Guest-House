<?php

namespace App\Http\Controllers;


use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use DB;

class MailController extends Controller
{
    public function send($empno){
      
        $id = $empno;
        $user= DB::table('users')
        ->where('Empno','=',$id)
       ->select('Email')
       ->get();  
    
        
     
        Mail::send ('send',['user'=>$user],function($message)use ($user){
           
            $message ->to($user[0]->Email)
                      ->subject('UOJ_Guest_House_Booked');
            
            $message ->from('gunawardhanaudara@gmail.com','UoJ_Mail');

            
        });
       
    }

    public function useraccessmail($empno){
      
        $id = $empno;
        $user= DB::table('users')
        ->where('Empno','=',$id)
       ->select('Email')
       ->get();  
    
        
     
        Mail::send ('useraccess',['user'=>$user],function($message)use ($user){
           
            $message ->to($user[0]->Email)
                      ->subject('UOJ_Guest_House_Access_permission');
            
            $message ->from('gunawardhanaudara@gmail.com','UoJ_Mail');

            
        });
       
    }

    public function rejectmail($empno){
      
        $id = $empno;
        $user= DB::table('users')
        ->where('Empno','=',$id)
       ->select('Email')
       ->get();  
    
        
     
        Mail::send ('rejectmail',['user'=>$user],function($message)use ($user){
           
            $message ->to($user[0]->Email)
                      ->subject('Reject_Permission');
            
            $message ->from('gunawardhanaudara@gmail.com','UoJ_Mail');

            
        });
       
    }

    public function rejectroom($empno){
      
        $id = $empno;
        $user= DB::table('users')
        ->where('Empno','=',$id)
       ->select('Email')
       ->get();  
    
        
     
        Mail::send ('rejectroommail',['user'=>$user],function($message)use ($user){
           
            $message ->to($user[0]->Email)
                      ->subject('Reject_Permission');
            
            $message ->from('gunawardhanaudara@gmail.com','UoJ_Mail');

            
        });
       
    }
    

}
