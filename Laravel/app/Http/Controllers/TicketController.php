<?php

namespace App\Http\Controllers;



use App\Ticket;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();
        return View::make('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$ticket = Ticket::create($request->all());

        $validator = $this->validate($request, [

        ]);
        if($validator->fails()){
            return redirect('tickets/create')->withErrors($validator);
        } else {
        $ticket = new Ticket();
        $ticket->street_address=$request['street_address'];
        $ticket->lat=$request['lat'];
        $ticket->lon=$request['lon'];
        $ticket->postal_code=$request['postal_code'];
        $ticket->city=$request['city'];
        $ticket->country=$request['country'];
        $ticket->save();

        Session::flash('message', 'Successfully created!');
        return redirect('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        return View::make('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        return View::make('tickets.edit')->with('ticket', $ticket);

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

        $validator = $this->validate($request, [

        ]);
        if($validator->fails()){
            return redirect('tickets/' . $id . '/edit')->withErrors($validator);
        } else {
            $ticket = Ticket::find($id);
            $ticket->street_address=$request['street_address'];
            $ticket->lat=$request['lat'];
            $ticket->lon=$request['lon'];
            $ticket->postal_code=$request['postal_code'];
            $ticket->city=$request['city'];
            $ticket->country=$request['country'];
            $ticket->save();

            Session::flash('message', 'Successfully updated');
            return redirect('/');
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
        $ticket = Ticket::find($id);
        $ticket->delete();

        Session::flash('message', 'Successfully deleted!');
        return redirect('/');
    }
}
