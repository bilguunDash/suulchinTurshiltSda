@extends('manager.test')

@section('body')
    <h1 class="mb-0">Add Book</h1>
    <hr />
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Title">
            </div>
            <div class="col">
                <input type="text" name="author" class="form-control" placeholder="Author">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="description" class="form-control" placeholder="Description">
            </div>
            <div class="col">
            <input type="text" name="year_published" class="form-control" placeholder="Year Published">
            </div>

            <div class="col">
                <input class="form-control" name="photo" type="file" id="photo">
            </div>

            <div class="col">
            <input type="text" name="order_number" class="form-control" placeholder="Order Number">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
