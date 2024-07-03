<!DOCTYPE html>
<html>

<head>
    <title>Create Kompetensi</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <h1>Create Kompetensi</h1>

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

    <form action="{{ route('kompetensi.store') }}" method="POST">
        @csrf
        <div>
            <label for="username">Nama Kompetensi:</label>
            <input type="text" id="username" name="nama_kompetensi" required>
        </div>
        <div>
            <label for="deskripsi">Desksripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi">
        </div>
        <div>
            <button type="submit">Create Kompetensi</button>
        </div>
    </form>
</body>

</html>
