<?php

namespace App\Http\Controllers;

use App\messagess;
use Illuminate\Http\Request;
use auth;
use DB;
use Session;
use App\notifications;

class MessagessController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('messgess');
    }

    public function getallmessgess() {
        $allUsers = DB::table('users')->where('id', '!=', Auth::user()->id)->get();
        return $allUsers;
    }

    public function getallmessgesswithid($id) {

        $recivmsg = DB::table('conversions as con')
                        ->select('con.id as id', 'email as user_email')
                        ->where('user_one', Auth::user()->id)
                        ->leftJoin('users as u', 'u.id', '=', 'con.user_one')
                        ->where('user_two', $id)->get();

        $sendmesg = DB::table('conversions as con')
                        ->select('con.id as id', 'u.email as email ,u.pic as pic')
                        ->where('user_two', Auth::user()->id)
                        ->leftJoin('users as u', 'u.id', '=', 'con.user_two')
                        ->where('user_one', $id)->get();

        $checkconv = array_merge($sendmesg->toArray(), $recivmsg->toArray());

        if (count($checkconv) != 0) {
            $messge = DB::table('messagesses')
                            ->leftJoin('users', 'users.id', '=', 'user_from')
                            ->where('conversions_id', $checkconv[0]->id)->get();
            return $messge;
        } else {
            
        }
    }

    public function storemesge(Request $request) {

        $conversions_id = $request->conid;
        $msg = $request->messFrom;
        $newuser = $request->user_id;



        if (empty($conversions_id)) {

            $newconv = DB::table('conversions')
                    ->insert([
                'user_one' => Auth::user()->id,
                'user_two' => $newuser,
            ]);
            $newconversionid = DB::getPdo()->lastInsertId();
            

            $sendm = DB::table('messagesses')
                    ->insert([
                'user_from' => Auth::user()->id,
                'user_to' => $newuser,
                'mgs' => $msg,
                'status' => 1,
                'conversions_id' => $newconversionid
            ]);

            if ($sendm) {
                $allmsg = DB::table('messagesses')
                        ->leftJoin('users', 'users.id', '=', 'user_from')
                        ->where('conversions_id', $newconversionid)
                        ->get();
                return $allmsg;
            } else {
                echo "Message  send Fail";
            }
        } else {
                          
//           $to_user = DB::table('messagesses')
//                    ->where('user_to', '!=', Auth::user()->id)
//                    ->get();
///i change this code without checking so be carefull change date:2.6.19 if nedded you should chckc

            $to_user = DB::table('messagesses')
                ->where('conversions_id', '=', $conversions_id)
                ->get();


            $to_user = $to_user[0]->user_to;

            $sendm = DB::table('messagesses')
                    ->insert([
                'user_from' => Auth::user()->id,
                'user_to' => $to_user,
                'mgs' => $msg,
                'status' => 1,
                'conversions_id' => $conversions_id
            ]);
            if ($sendm) {
                $allmsg = DB::table('messagesses')
                        ->leftJoin('users', 'users.id', '=', 'user_from')
                        ->where('conversions_id', $conversions_id)
                        ->get();
                return $allmsg;
            } else {
                echo "Message  send Fail";
            }
        }
    }

    public function show(messagess $messagess) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\messagess  $messagess
     * @return \Illuminate\Http\Response
     */
    public function edit(messagess $messagess) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\messagess  $messagess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, messagess $messagess) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\messagess  $messagess
     * @return \Illuminate\Http\Response
     */
    public function destroy(messagess $messagess) {
        //
    }

}
