<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myEvents = array(); 
        $event = DB::table("events")->select('*')->where('user_id', auth()->user()->id)->get();

        foreach ($event as $el) {
            $myEvents[] = [
                'id' => $el->id,
                'title' => $el->name,
                'start' => $el->start_date,
                'end' => $el->end_date,
                'description' => $el->description,
                'color' => $el->color,
            ];
            
        }

        return view('home', ['events' => $myEvents]);
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
        // Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
        // $data = $request->all();
        if ($request->event_id == null) {
            $user_id = auth()->user()->id;
            // $event = Event::create($data);
            // return response()->json($event, 201);
    
            $event = new Event;
            $event->name = $request->name;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->description = $request->event_description;
            $event->color = $request->color;
            $event->user_id = $user_id;
            $event->save();
        }else{
            $this->update($request->all());
        }
       

        // dd($event);
        // return response()->json($event, 201);
        return redirect('home');
        // with('addflm','event Added Successfully')
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update($Data)
    {
        //update event
        $event = Event::find($Data['event_id']);
        $event->name = $Data['name'];
        $event->start_date = $Data['start_date'];
        $event->end_date = $Data['end_date'];
        $event->description = $Data['event_description'];
        $event->color = $Data['color'];
        $event->update();
        return response()->json($event, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //delete event
        $event = Event::find($request['event_id']);
        $event->delete();
        return redirect('home');
    }   
}
