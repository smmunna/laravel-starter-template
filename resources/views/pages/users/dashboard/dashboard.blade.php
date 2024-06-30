@extends('layouts.dashboard_layout')
@section('title', 'User Dashboard')
@section('content')
    <!--Change according to your own -->
    <div class="d-flex justify-content-center">
        <div>
            <h3>User dashboard</h3>
            <a href="{{ route('logout') }}"><button>Logout</button></a>
            <a href="{{ route('user.profile') }}"><button>My Profile</button></a>
        </div>
    </div>
@endsection
