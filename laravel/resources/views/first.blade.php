@extends('layouts.app')

@section('content')

<form method="get" action="/search2">
    <div class="input-group">
        <input class="form-control" name="search2" placeholder="Search..." value="{{ isset($search2) ? $search2 : ''}}">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<table class="table table-bordered">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Cover</th>
            <th>Title</th>
            <th>Author</th>
            <th>Description</th>
            <th>Year Published</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ asset($book->photo) }}" width="100" height="100" class="img img-responsive" />
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->description }}</td>
                <td>{{ $book->year_published }}</td>
                <td>
                    <a href="{{ route('login') }}" class="btn btn-secondary">
                        Rent
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center" colspan="7">No books found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection

