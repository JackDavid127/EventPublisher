<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;
use App\User;
use App\Event;
use App\Message;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $friends = $user->friends()->get();
        $pfriends = $user->reqeds()->get();
        return view('user.index',['friends' => $friends, 'pfriends' => $pfriends]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('user.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->truename = $request->input('truename');
        $user->phone = $request->input('phone');
        $user->hobby = $request->input('hobby');
        $user->intro = $request->input('intro');
        $user->save();
        return redirect()->action('UserController@show', [$user->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userid = Auth::user()->id;
        $user = User::find($id);
        $myevents = Event::where('event_user_id', $user->id)->get();
        $parevents = $user->events()->get();
        if ($userid == $id){
            $isme = true;
            $isfrd = 0;
        }
        else{
            $friends = DB::table('friends')->where('user1_id', $userid)->lists('user2_id');
            $req = DB::table('requests')->where('from_user_id', $userid)->lists('to_user_id');
            $reqed = DB::table('requests')->where('to_user_id', $userid)->lists('from_user_id');
            $isme = false;
            if (in_array($id, $friends)) $isfrd = 3;
            elseif (in_array($id, $req)) $isfrd = 2;
            elseif (in_array($id, $reqed)) $isfrd = 1;
            else $isfrd = 0;
        }
        return view("user.show",['user' => $user, 'myevents' => $myevents, 'parevents' => $parevents, 'isme' => $isme, 'isfrd' => $isfrd]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $him = User::find($id);
        $friends = DB::table('friends')->where('user1_id', $user->id)->lists('user2_id');
        $reqed = DB::table('requests')->where('to_user_id', $user->id)->lists('from_user_id');
        if (in_array($id, $friends)) return view('user.edit', ['user' => $him]);
        elseif (in_array($id, $reqed)){
            DB::transaction(function () use($user, $id){
                DB::table('requests')->where('from_user_id', $id)->where('to_user_id', $user->id)->delete();
                DB::table('friends')->insert(['user1_id' => $user->id, 'user2_id' => $id]);
                DB::table('friends')->insert(['user1_id' => $id, 'user2_id' => $user->id]);
            });
            return redirect()->action('UserController@show', [$id]);
        }
        else{
            DB::table('requests')->insert(['from_user_id' => $user->id, 'to_user_id' => $id]);
            return redirect()->action('UserController@show', [$id]);
        }
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
        $userid = Auth::user()->id;
        $friends = DB::table('friends')->where('user1_id', $userid)->lists('user2_id');
        if (in_array($id, $friends)){
            $msg = new Message;
            $msg->from_user_id = Auth::user()->id;
            $msg->to_user_id = $id;
            $msg->text = $request->input('msg_content');
            $msg->read = true;
            $msg->belong_to = false;
            $msg->save();
            $msg2 = new Message;
            $msg2->from_user_id = Auth::user()->id;
            $msg2->to_user_id = $id;
            $msg2->text = $request->input('msg_content');
            $msg2->read = false;
            $msg2->belong_to = true;
            $msg2->save();
            return view('user.update');
        }
        else{
            DB::table('requests')->where('from_user_id', $id)->where('to_user_id', $userid)->delete();
            return redirect()->action('UserController@show', [$id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userid = Auth::user()->id;
        DB::transaction(function () use($userid, $id){
            Message::where('from_user_id', $userid)->where('to_user_id', $id)->delete();
            Message::where('from_user_id', $id)->where('to_user_id', $userid)->delete();
            DB::table('friends')->where('user1_id', $userid)->where('user2_id', $id)->delete();
            DB::table('friends')->where('user1_id', $id)->where('user2_id', $userid)->delete();
        });
        return redirect()->action('UserController@show', [$id]);
    }
}
