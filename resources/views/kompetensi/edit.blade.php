<!DOCTYPE html>
<html>

<head>
    <title>Update Kompetensi</title>
</head>

<body>
    <h1>Update Kompetensi</h1>

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


    <form action="{{url("kompetensi/{$kompetensi->id}")}}" method="POST">
        @method('PATCH')
        @csrf
        <div>
            <label for="nama_kompetensi">Nama Kompetensi:</label>
            <input type="text" id="nama_kompetensi" name="nama_kompetensi" value="{{$kompetensi->nama_kompetensi}}" required>
        </div>
        <div>
            <label for="deskripsi">Desksripsi:</label>
            <input type="text" id="deskripsi" name="deskripsi" value="{{$kompetensi->deskripsi}}">
        </div>
        <div>
            <button type=" submit">Update Kompetensi</button>
        </div>
    </form>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
