<?php

namespace App\Http\Controllers;

use App\Category;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\AppMailer;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */

    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index() //DISPLAYS TICKETS CREATED
    {
        $tickets = Ticket::paginate(10);
        return view('tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()    //CREATE A TICKET
    {
        $categories = Category::all();
        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message' => 'required'
        ]);

        $ticket = new Ticket ([                 // MAGHIMO UG BAGO NGA TICKETS
            'title' => $request->input('title'),
            'user_id' => Auth::user()->id,
            'ticket_id' => strtoupper(str_random(10)),
            'category_id' => $request->input('category_id'),
            'priority' => $request->input('priority'),
            'message' => $request->input('message'),
            'status' => "Open"
        ]);

        $tickets->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);  // AFTER PAG HIMO SA TICKET MAG SEND UG MAIL ANG APP SA EMAIL NGA GIGAMIT SA USER USING THIS COMMAND.

        return redirect()->back()->with("status", "A ticket with ID: #ticket->ticket_id has been created.");
    }
    
    public function userTickets()   // TANAWON SA USER ANG IYAHANG MGA TICKETS
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        return view('tickets.user_tickets', compact('tickets'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
