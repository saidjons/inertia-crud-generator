<?php

namespace Saidjon\InertiaCrudGenerator\Traits;

use App\Models\User;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

trait AuthTokenTrait{


    public function getTokenAttribute()
    {
        
             if(auth()->user()){
        return $this->getFromCacheOrNewToken(auth()->user()->id);

        } else{
            return "Guest";
        }
    }
    
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
       if( $user->tokens()){
          $user->tokens()->delete();

       }
       
    }
    public function newAuthToken():string
    {
        
        $token =auth()->user()->createToken('api')->plainTextToken;
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
       public function getFromCacheOrNewToken(int $userId)
    {
          $token = Cache::get(`{$userId}-token`);
          if($token){
             return $token;
          }
          $token = $this->ensureSessionSameWithAuthtokenCookie();
         
         Cache::put(`{$userId}-token`,$token);
         
         return $token;


    }
}

 
