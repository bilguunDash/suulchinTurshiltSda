@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if(auth()->user()->is_admin == 0)
                        <p>You are an Admin.</p>
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Register</th>
                                    <th>Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($user->where('type', 0)->count() > 0)
                                    @foreach($user->where('type', 0) as $userInfo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $userInfo->name }}</td>
                                            <td>{{ $userInfo->email }}</td>
                                            <td>{{ $userInfo->address }}</td>
                                            <td>{{ $userInfo->register }}</td>
                                            <td>{{ $userInfo->phone }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="6">No users found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @else
                        <p>You are not an Admin User.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
