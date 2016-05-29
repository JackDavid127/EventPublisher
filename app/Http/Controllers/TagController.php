<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;
use Auth;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id){
        $events = DB::table('event_tag')->where('tag_name', $id)->join('events', 'events.event_id', '=', 'event_tag.event_id')->select('events.*')->get();
        $user = Auth::user();
        $tags = DB::table('user_tag')->where('user_id', $user->id)->lists('tag_name');
        $isin = in_array($id, $tags);
        return view('event.tagshow', ['tag' => $id, 'events' => $events, 'isin' => $isin]);
    }

    public function alter($id){
        $user = Auth::user();
        $tags = DB::table('user_tag')->where('user_id', $user->id)->lists('tag_name');
        if (in_array($id, $tags))
            DB::table('user_tag')->where('user_id', $user->id)->where('tag_name', $id)->delete();
        else
            DB::table('user_tag')->insert(['user_id' => $user->id, 'tag_name' => $id]);
        return redirect()->action('TagController@show', [$id]);
    }

    public function index(){
        $user = Auth::user();
        $tags = DB::table('user_tag')->where('user_id', $user->id)->lists('tag_name');
        $events = DB::table('user_tag')
                ->where('user_id', $user->id)
                ->join('event_tag', 'user_tag.tag_name', '=', 'event_tag.tag_name')
                ->join('events', 'events.event_id', '=', 'event_tag.event_id')
                ->select('events.*')->distinct()->get();
        return view('welcome', ['tags' => $tags, 'events' => $events]);
    }
}
