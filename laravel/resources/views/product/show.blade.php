@extends('manager.test')

@section('body')
    <h1 class="mb-0">Detail Product</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $books->title }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Author</label>
            <input type="text" name="author" class="form-control" placeholder="author" value="{{ $books->author }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">description</label>
            <input type="text" name="description" class="form-control" placeholder="description" value="{{ $books->description }}" readonly>
        </div>
        <div class="col">
            <label class="form-label">Year Published</label>
            <input type="text" name="year_published" class="form-control" placeholder="Year Published" value="{{$books->year_published}}" readonly>
            </div>

            <div class="col mb-3">
            <label class="form-label">Photo</label>
                <input class="form-control" name="photo" type="file" id="photo">
            </div>

            <div class="col">
            <label class="form-label">Order Number</label>
            <input type="text" name="order_number" class="form-control" placeholder="Order Number" value="{{$books->order_number}}">
            </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $books->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $books->updated_at }}" readonly>
        </div>
       
    </div>
@endsection
