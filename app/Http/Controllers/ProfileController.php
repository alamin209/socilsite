<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use DB;
use Session;
use App\notifications;

class ProfileController extends Controller {

    public function index($slug) {
        $profile = Auth::user()->profile;
        $userData=DB::table('users')
                ->Leftjoin('profiles','profiles.user_id','users.id')
                ->where('slug',$slug)->get();
      return view('profile/index',compact('userData'))->with('profile', $profile);
    }

    public function pudate_pic(Request $request) {

        $file = $request->file('profile_pic');
        $filename = $file->getClientOriginalName();
        $path = 'public/img';
        $file->move($path, $filename);
        $user_id = Auth::user()->id;
        DB::table('users')->where('id', $user_id)->update(['pic' => $filename]);
        return back();
    }

    public function edit_profile() {
        $profile = Auth::user()->profile;
        return view('profile.edit_profile')->with('profile', $profile);
    }

    public function edit_profile_image() {
        return view('profile.profile_pic');
    }

    public function updateProfileData(Request $request) {
        $user_id = Auth::user()->id;
        DB::table('profiles')->where('user_id', $user_id)->update($request->except('_token'));
        return back();
    }

    public function findfriend() {

        $user_id = Auth::user()->id;
        $allUser = DB::table('profiles')->leftJoin('users', 'users.id', '=', 'profiles.user_id')->where('users.id', '!=', $user_id)->get();
        return view('profile.findfriend', compact('allUser'));
    }

    public function sendfriendreequest($id) {

        return Auth::user()->addFriend($id);
    }

    public function requesters() {

        $user_id = Auth::user()->id;

        $friendrequested = DB::table('users')
                ->leftJoin('friendships', 'users.id', '=', 'requester')
                ->where("friendships.user_requested", '=', $user_id)
                ->where("status", '=', NULL)
                ->get();
//        dd( $friendrequested);
        return view('profile.requester', compact('friendrequested'));
    }

    public function accept($name, $id) {
        $user_id = Auth::user()->id;
        $checkrequestd = DB::table('friendships')
                ->where('requester', '=', $id)
                ->where('user_requested', '=', $user_id)
                ->first();
        if ($checkrequestd) {
            $updatestatus = DB::table('friendships')
                    ->where('requester', '=', $id)
                    ->where('user_requested', '=', $user_id)
                    ->update(['status' => 1]);

            $notifications = new notifications;
            $notifications->send_request = $user_id;
            $notifications->loggedin_user = $id;
            $notifications->status = 1;
            $notifications->note = "Accept your friend request";
            $notifications->save();
            session()->flash('message', 'You are now friend with !' . $name);
            return back();
        } else {
            session()->flash('message', 'Someting wrong added Fail !');
            return back();
        }
    }

    public function friends() {
        $user_id = Auth::user()->id;
        $requestme = DB::table('friendships') // i send  request and the person who accept my request
                ->leftJoin('users', 'users.id', '=', 'user_requested')
                ->where('status', 1)
                ->where('requester', '=', $user_id)
                ->get();
        $requestbyme = DB::table('friendships') //the person who  send   request me and i accept  the request 
                ->leftJoin('users', 'users.id', '=', 'requester')
                ->where('status', 1)
                ->where('user_requested', '=', $user_id)
                ->get();
        $friends = array_merge($requestme->toArray(), $requestbyme->toArray());
        return view('profile.friends', compact('friends'));
    }

        public function remove($name, $id) {
            $deletrequest = DB::table('friendships')
                    ->where('id', $id)
                    ->delete();
            if ($deletrequest) {
                session()->flash('message', 'You delete friend request !' . $name);
                return back();
            } else {
                session()->flash('message', 'Someting wrong !');
                return back();
            }
        }
        public function notification($id){
             $user_id = Auth::user()->id;
             $allnotification = DB::table('notifications')
                      ->LeftJoin('users','notifications.send_request','=','users.id')  
                      ->where('loggedin_user', $user_id)
                      ->where('notifications.id', '=', $id)
                     ->get();
             $updatestatus = DB::table('notifications')
                           ->where('id', '=', $id)
                          ->update(['status' => 0]);
             
             return view('profile.notification', compact('allnotification'));

        }
        public function unfriend($name,$id){
            $deletrequest = DB::table('friendships')
                    ->where('requester', $id)
                    ->delete();
            if ($deletrequest) {
                session()->flash('message', 'You delete friend  !' . $name);
                return back();
            } else {
                session()->flash('message', 'Someting wrong !');
                return back();
            }
            
            
        }
        public function settoken(Request $request){
          $email=$request->email;
          $echeckemail=DB::table('users')->where('email',$email)->get();

          if( count($echeckemail)==0){
              echo "email link is not natch or invalid emil ADDRESS";

          }else{
              $random=rand(1,500);
              $token_str=bcrypt($random);
              $token= stripslashes($token_str);
              $bas_url='http://localhost/socilsite/settoken/'.$token;

              $to=$email;
              $subject="Passowrd Rest Link";
              $message="<a href='$bas_url'>$token</a>";

              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

              $headers .= 'From: <admin@socilsite.com>' . "\r\n";
//              $headers .= 'Cc: myboss@example.com' . "\r\n";

              mail($to,$subject,$message,$headers);

          }


        }
                

}
