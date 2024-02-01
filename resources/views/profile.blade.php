<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>

<body>

    <h1>User Profile</h1>

    @if(auth()->check())
    <p>Welcome, {{ auth()->user()->name }}!</p>

    <ul>
        <li><strong>Name:</strong> {{ auth()->user()->name }}</li>
        <li><strong>Email:</strong> {{ auth()->user()->email }}</li>
        <li><strong>ID:</strong> {{ auth()->user()->id }}</li>
        <li><strong>Created At:</strong> {{ auth()->user()->created_at->format('Y-m-d H:i:s') }}</li>
        <li><strong>Updated At:</strong> {{ auth()->user()->updated_at->format('Y-m-d H:i:s') }}</li>
        <!-- Add more user information fields as needed -->
    </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    @else
    <p>User not authenticated.</p>
    @endif

</body>

</html>