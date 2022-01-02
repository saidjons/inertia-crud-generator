<?php

namespace Saidjon\InertiaCrudGenerator\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

trait AuthTokenTrait{


   public function ensureSessionSameWithAuthtokenCookie()
   {
     

      // if(!request()->hasCookie('auth_token')){
      //       $this->setAuthCookie();
      //       return;
      // }
   //   $tokenAndSession = Cookie::get('auth_token');
         
      // if ($tokenAndSession !==false) {
      //    $arrays = explode('|',$tokenAndSession);
      //    if ( $arrays[1]== Session::getId()) {
      //       return ;
      //    }
         $this->revokeOldTokens();
        return  $this->newAuthToken();
      
   }
  

    public function revokeOldTokens()
    {
      // dd(auth()->user()->createToken('admin')->plainTextToken);
       $user = User::find(auth()->user()->id);
       $user->tokens()->delete();
       
    }
    public function newAuthToken():string
    {
        
        $token =auth()->user()->createToken('admin')->plainTextToken;
        $string =  explode('|',$token);
        return $string[1];
    }
    
    public function cleanAuthTokenCookie()
    {
       $this->revokeOldTokens();
        $this->cleanAuthCookie();
    }
    public function cleanAuthCookie()
    {
        Cookie::queue(
            Cookie::forget('auth_token')
         );
    }
}