<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Message;
use DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::user()->id;
        $imsgs = DB::table("messages")->where('to_user_id', $userid)->where('belong_to', true)->join('users', 'users.id', '=', 'messages.from_user_id')->select("messages.*", "users.name")->get();
        $omsgs = DB::table("messages")->where('from_user_id', $userid)->where('belong_to', false)->join('users', 'users.id', '=', 'messages.to_user_id')->select("messages.*", "users.name")->get();
        $msgs = Message::where('to_user_id', $userid)->where('belong_to', true)->get();
        foreach ($msgs as $msg){
            $msg->read = true;
            $msg->save();
        }
        return view("message.index", ['imsgs' => $imsgs, 'omsgs' => $omsgs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $msg = Message::find($id);
        $msg->delete();
        return redirect()->action("MessageController@index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
