@extends('layouts.dashboard_layout')

@section('title', 'Profile')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Profile Information</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ auth()->user()->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ auth()->user()->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ auth()->user()->phone }}</td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td>
                            @if (auth()->user()->photo)
                                <img src="{{ asset(auth()->user()->photo) }}" alt="Profile Photo" class="img-thumbnail"
                                    style="width: 150px; height: 150px;">
                            @else
                                No photo available
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ auth()->user()->address }}</td>
                    </tr>
                    <tr>
                        <th>Role</th>
                        <td>{{ auth()->user()->role }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
