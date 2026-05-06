@extends(layouts.app)

@section('content')
<div>
    <h1>Register</h1>
    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        <button type="submit">Register</button>
    </form>
</div>
@endsection