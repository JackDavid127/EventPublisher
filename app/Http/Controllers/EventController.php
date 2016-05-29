<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Event;
use App\User;
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
        $tags = explode(" ", $request->input("event_tags"));
        foreach ($tags as $tag){
            DB::table('event_tag')->insert(['event_id' => $event->event_id, 'tag_name' => $tag]);
        }
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
        $event = Event::find($id);
        $tags = DB::table('event_tag')->where('event_id', $event->event_id)->lists('tag_name');
        $userid = Auth::user()->id;
        $auser = User::find($event->event_user_id);
        if ($event->event_user_id == $userid){
            $userlist = DB::table('user_event')->where('event_id', $id)->join('users', 'user_event.user_id', '=', 'users.id')->select('users.*','user_event.message')->get();
            $isadmin = true;
            $isin = false;
            $isok = true;
        }
        else{
            $userlist = $event->users()->get();
            $isadmin = false; $isok = true; $isin = false;
            foreach ($userlist as $user)
                if ($user->id == $userid) {$isin = true; break;}
            if ($event->event_total == 0) $isok = false;
            date_default_timezone_set("Asia/Shanghai");
            $dat = date('Y-m-d H:i:s');
            if (strcmp($dat,$event->event_opentill)>=0) $isok = false;
        }
        return view('event.show',['event' => $event, 'isadmin' => $isadmin, 'isin' => $isin, 'isok' => $isok, 'users' => $userlist, 'tags' => $tags, 'user' => $auser]);
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
        $tags = DB::table('event_tag')->where('event_id', $event->event_id)->lists('tag_name');
        $str = implode(' ', $tags);
        return view('event.edit',['event' => $event, 'tagsval' => $str]);
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
        $tags = explode(" ", $request->input("event_tags"));
        $oldtags = DB::table('event_tag')->where('event_id', $event->event_id)->lists('tag_name');
        $newtags = array_diff($tags, $oldtags);
        $deltags = array_diff($oldtags, $tags);
        foreach ($deltags as $tag){
            DB::table('event_tag')->where('tag_name', $tag)->delete();
        }
        foreach ($newtags as $tag){
            DB::table('event_tag')->insert(['event_id' => $event->event_id, 'tag_name' => $tag]);
        }
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
        date_default_timezone_set("Asia/Shanghai");
        $dat = date('Y-m-d H:i:s');
        $event=Event::find($id);
        if (strcmp($dat,$event->event_opentill)>=0) return redirect()->action('EventController@show',[$id]);
        DB::transaction(function () use($userid, $id, $msg, $dat, $event){
            if($event->event_total == 0) return;
            $event->event_total--;
            $event->save();
            DB::insert("insert into user_event (user_id, event_id, message) values(?, ?, ?)",[$userid, $id, $msg]);
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
