<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Http\Resources\Ticket as TicketResource;
use App\Http\Resources\TicketCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TicketCollection(Ticket::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket($request->all());
        $request->user()->tickets()->save($ticket);

        return new Response([
            'ticket' => new TicketResource($ticket),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TicketResource(Ticket::findOrFail($id));
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
        if (!$id) {
            return new Response('', 400);
        }

        $ticket = Ticket::find($id);

        if (!$ticket) {
            return new Response([
                'message' => 'Unable to find ticket with id ' .$id,
            ], 404);
        }

        $ticket->delete();

        return new Response([
            'message' => 'Successfully deleted ticket ' .$id,
            ], 200);
    }

    public function coordinates($id){
        $coords = Ticket::find($id);
        if(!$coords){
            return new Response([
                'message' => 'Unable to find coordinates with id ' .$id,
            ], 404);
        }
        else{
            $coord = $coords->only('lat','lon');
            return $coord;
        }
    }

    public function ticketsByCity($city){
        $cities = Ticket::where('city', $city)->get();

        if($cities->count() === 0){
            return new Response([
                'message' => 'Unable to find tickets by the city ' .$city,
            ], 404);
        }
        else{
            return $cities;
        }
    }

    public function ticketsByCoord($lat, $lon){
        $ticketsCoord = Ticket::where('lat', $lat)->where('lon', $lon)->get();

        if($ticketsCoord->count() === 0) {
            return new Response([
                'message' => 'Unable to find tickets by the coordinates.',
            ], 404);
        }
        else{
            return $ticketsCoord;
        }
    }


}
