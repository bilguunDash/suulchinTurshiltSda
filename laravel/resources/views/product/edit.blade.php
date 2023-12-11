@extends('manager.test')

@section('body')
    <h1 class="mb-0">Edit Product</h1>
    <hr />
    <form action="{{ route('product.update', $books->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ $books->title }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Author</label>
                <input type="text" name="author" class="form-control" placeholder="author" value="{{ $books->author }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" placeholder="description" value="{{ $books->description }}" >
            </div>
            <div class="col">
            <label class="form-label">Year Published</label>
            <input type="text" name="year_published" class="form-control" placeholder="Year Published" value="{{$books->year_published}}">
            </div>

            <div class="col mb-3">
            <label class="form-label">Photo</label>
                <input class="form-control" name="photo" type="file" id="photo">
            </div>
        </div>

        <div class="col">
            <label class="form-label">Order Number</label>
            <input type="text" name="order_number" class="form-control" placeholder="Order Number" value="{{$books->order_number}}">
            </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
