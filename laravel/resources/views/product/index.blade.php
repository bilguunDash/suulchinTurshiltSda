@extends('manager.test')

@section('body')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Product</h1>
        <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Year Published</th>
                <th>Order Number</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
            @if($product->count() > 0)
                @foreach($product as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset($rs->photo) }}" width="100" height="100" class="img img-responsive" />
                        </td>
                        <td class="align-middle">{{ $rs->title }}</td>
                        <td class="align-middle">{{ $rs->author }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>
                        <td class="align-middle">{{ $rs->year_published }}</td>
                        <td class="align-middle">{{ $rs->order_number }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('product.show', $rs->id) }}" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('product.edit', $rs->id)}}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('product.destroy', $rs->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="btn btn-danger p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection

