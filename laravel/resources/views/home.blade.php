<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        @if(auth()->user()->is_admin == 1)
                            <a href="{{ url('admin/routes') }}">Admin</a>
                        @else
                            <div class="panel-heading">Normal User</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <form method="get" action="/search">
                                        <div class="input-group">
                                            <input class="form-control" name="search" placeholder="Search..." value="{{ isset($search) ? $search : ''}}">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

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
                                                <a href="#" class="btn btn-secondary" onclick="openRentalModal('{{ $book->title }}', '{{ $book->author }}', '{{ $book->order_number }}', 3500)">
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

                            <!-- Modal -->
                            <div class="modal fade" id="rentalModal" tabindex="-1" role="dialog" aria-labelledby="rentalModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rentalModalLabel">Rental Confirmation</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {{-- Add content for rental confirmation --}}
                                            <p id="bookTitle"></p>
                                            <p id="bookAuthor"></p>
                                            <p id="orderNumber"></p>
                                            <p id="price"></p>
                                            {{-- Add more details or input fields for the rental --}}

                                            <!-- Form for renting the book -->
                                            <form id="rentBookForm" action="" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Rent</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/js/bootstrap.bundle.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                            <script>
                                function openRentalModal(title, author, orderNumber, price) {
                                    // Set values for modal
                                    document.getElementById('bookTitle').innerText = 'Book: ' + title;
                                    document.getElementById('bookAuthor').innerText = 'Author: ' + author;
                                    document.getElementById('orderNumber').innerText = 'Order Number: ' + orderNumber;
                                    document.getElementById('price').innerText = 'Price: ' + price;

                                    // Set form action dynamically
                                    document.getElementById('rentBookForm').action = '/rent-book/' + orderNumber;

                                    // Show the modal
                                    $('#rentalModal').modal('show');
                                }

                                // Echo configuration
                                @auth
                                    Echo.channel('user.' + {{ auth()->id() }})
                                        .listen('BookRentedEvent', (event) => {
                                            toastr.success(event.message);
                                        });
                                @endauth
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @auth
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.Echo.channel('user.' + {{ auth()->id() }})
            .listen('BookRentedEvent', (event) => {
                toastr.success(event.message);
            });
    </script>
@endauth
@endsection




