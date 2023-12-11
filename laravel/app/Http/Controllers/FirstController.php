<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class FirstController extends Controller
{
    //
    public function HOme(){
        $books=Books::all();
        return view('first',compact('books'));}


    public function search(Request $request)
        {
            $keyword = $request->input('search2');
    
            // Perform the search query on your 'books' model
            $books = Books::where('title', 'like', "%$keyword%")
                ->orWhere('author', 'like', "%$keyword%")
                ->orWhere('description', 'like', "%$keyword%")
                ->orWhere('year_published', 'like', "%$keyword%")
                ->get();
    
            return view('first', compact('books'));
        }
}
