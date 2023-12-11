<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Books::orderBy('created_at', 'DESC')->get();

        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $requestData["photo"] = '/storage/'.$path;
        Books::create($requestData);
        return redirect('product')->with('flash_message', 'Employee Addedd!');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $books = Books::findOrFail($id);

        return view('product.show', compact('books'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $books = Books::findOrFail($id);

        return view('product.edit', compact('books'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data if needed
    
        $book = Books::findOrFail($id);
    
        // Update the fields
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->description = $request->input('description');
    
        // Validate and format the year_published
        $yearPublished = $request->input('year_published');
        $validatedYear = preg_match('/^\d{4}$/', $yearPublished) ? $yearPublished : null;
        $book->year_published = $validatedYear;
    
        // Update the photo if a new one is provided
        if ($request->hasFile('photo')) {
            $fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $book->photo = '/storage/' . $path;
        }
    
        // Save the changes
        $book->save();
    
        return redirect('product')->with('flash_message', 'Book updated successfully!');
    }



    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Books::findOrFail($id);

        $books->delete();

        return redirect()->route('product.findex')->with('success', 'product deleted successfully');
    }
}
