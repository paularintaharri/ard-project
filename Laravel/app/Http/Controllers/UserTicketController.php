<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\Ticket as TicketResource;
use App\Ticket;
use App\Http\Requests\StoreTicket;
use Illuminate\Support\Facades\Auth;

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        return new TicketCollection(Ticket::where('user_id', "=", $id)->get());
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
    public function store(StoreTicket $request)
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
        $id = Auth::id();
        $ticket = Ticket::findOrFail($id);

        if (!($id === $ticket->user_id)) {

            return new Response([
                'message' => 'Must be the owner of the ticket ' .$id,
            ], 401);

        }

        return new TicketResource($ticket);
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
        $user_id = Auth::id();

        if (!$id) {
            return new Response('', 400);
        }

        $ticket = Ticket::find($id);

        if (!$ticket) {
            return new Response([
                'message' => 'Unable to find ticket with id ' .$id,
            ], 404);
        }

        if (!($user_id === $ticket->user_id)) {

            return new Response([
                'message' => 'Must be the owner of the ticket ' .$id,
            ], 401);

        }

        $ticket->delete();

        return new Response([
            'message' => 'Successfully deleted ticket ' .$id,
        ], 200);
    }
}
