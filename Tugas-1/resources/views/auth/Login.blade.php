@extends ('layouts.app');

@section('content')
<div>
    <h1>Login</h1>
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <button type="submit">Login</button>
    </form>
    <a href="{{ route('register') }}">Register</a>
</div>
@endsection