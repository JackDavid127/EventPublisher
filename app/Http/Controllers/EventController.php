<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Event;

use Auth;
use DB;

class EventController extends Controller
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
        $events = Event::all();
        return view("event.index",["events" => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event;
        $event->event_user_id=Auth::user()->id;
        $event->event_title=$request->input("event_title");
        $event->event_content=$request->input("event_content");
        $event->event_limit=$request->input("event_limit");
        $event->event_start=$request->input("event_start");
        $event->event_end=$request->input("event_end");
        $event->event_opentill=$request->input("event_opentill");
        $event->event_total=$request->input("event_total");
        $event->event_place=$request->input("event_place");
        $event->save();
        return view('event.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event=Event::find($id);
        $userid=Auth::user()->id;
        if ($event->event_user_id == $userid){
            $isadmin = true;
            $isin = false;
            $isok = true;
        }
        else{
            $userlist = DB::table('user_event')->where('event_id', $id)->lists('user_id');
            $isadmin = false; $isok = true;
            if ($userlist == null) $isin = false;
            elseif (in_array($userid,$userlist)) $isin = true;
            elseif ($event->event_total == 0) {$isok = false; $isin = false;}
            else $isin = false;
        }
        return view('event.show',['event' => $event, 'isadmin' => $isadmin, 'isin' => $isin, 'isok' => $isok]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event=Event::find($id);
        return view('event.edit',['event' => $event]);
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
        $event = Event::find($id);
        $event->event_user_id=Auth::user()->id;
        $event->event_title=$request->input("event_title");
        $event->event_content=$request->input("event_content");
        $event->event_limit=$request->input("event_limit");
        $event->event_start=$request->input("event_start");
        $event->event_end=$request->input("event_end");
        $event->event_opentill=$request->input("event_opentill");
        $event->event_total=$request->input("event_total");
        $event->event_place=$request->input("event_place");
        $event->save();
        return view('event.update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event=Event::find($id);
        $event->delete();
        return view('event.destroy');
    }

    public function signup(Request $request, $id){
        $userid=Auth::user()->id;
        $msg=$request->input("message");
        DB::transaction(function () use($userid, $id, $msg){
            DB::insert("insert into user_event (user_id, event_id, message) values(?, ?, ?)",[$userid, $id, $msg]);
            $event=Event::find($id);
            $event->event_total--;
            $event->save();
        });
        return redirect()->action('EventController@show',[$id]);
    }

    public function cancel($id){
        $userid=Auth::user()->id;
        DB::transaction(function() use($userid, $id){
            DB::delete("delete from user_event where user_id = ? and event_id = ?", [$userid, $id]);
            $event=Event::find($id);
            $event->event_total++;
            $event->save();
        });
        return redirect()->action('EventController@show',[$id]);
    }
}
