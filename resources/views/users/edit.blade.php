<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<body>
    <h1>Create User</h1>

    @if (session('success'))
    <div>
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <form action="{{url("users/{$user->id}")}}" method="POST">
        @method('PATCH')
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="{{$user->username}}" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="{{$user->password}}" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{$user->name}}" required>
        </div>
        <div>
            <button type="submit">Create User</button>
        </div>
    </form>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
