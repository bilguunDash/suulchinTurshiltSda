<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Events\BookRentedEvent;


class HomeController extends Controller
{
    public function rentBook($orderId)
    {
        try {
            // Find the authenticated user
            $user = User::find(auth()->user()->id);

            // Check if the user has enough balance
            if ($user->dans < 3500) {
                throw new \Exception('Insufficient balance');
            }

            // Deduct the specified amount from the user's balance
            $user->dans -= 3500;

            // Save the user model to persist changes
            $user->save();

            Notification::send($user,new WelcomeNotification);

            // Broadcast the BookRentedEvent
            event(new \App\Events\BookRentedEvent($orderId));

            return redirect()->route('home')->with('success', 'Book rented successfully');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', $e->getMessage());
        }
    }








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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        notify()->success('Welcome to the home page!');
        $books=Books::all();
        return view('home',compact('books'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 public function adminHome()
 {
     // Assuming you want to fetch all users when the type is 0
     $user = User::all();

     // Check the type of the first user (you might need to adjust this logic)
     if ($user->isNotEmpty() && $user->first()->type == 0) {
         return view('adminHome', compact('user'));
     } else {
         // Handle the case when there are no users or the type is not 0
         return view('adminHome', compact('user'))->withErrors('No eligible users found.');
     }
 }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome()
    {
        return view('managerHome');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('search');

        // Perform the search query on your 'books' model
        $books = Books::where('title', 'like', "%$keyword%")
            ->orWhere('author', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('year_published', 'like', "%$keyword%")
            ->get();

        return view('home', compact('books'));
    }

}
