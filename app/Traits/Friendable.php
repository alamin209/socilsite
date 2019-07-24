<?php

namespace App\Traits;

use App\friendships;
use DB;

trait Friendable {

    public function test() {

        return 'hi';
    }

    public function addFriend($user_id) {
        $Eriendship = friendships::create([
                    'requester' => $this->id,
                    'user_requested' => $user_id
        ]);
        $Eriendship=$Eriendship->id;
        
        if ($Eriendship) {
            
            return back();
        }
        else{
            return  "Fail";
        }
            
    }

}
