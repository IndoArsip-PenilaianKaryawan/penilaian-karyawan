<!DOCTYPE html>
<html>

<head>
    <title>Update User</title>
</head>


<body>
    @include('component.sidebar')
    <div class="px-4 py-8 xl:ml-80 bg-[#F5F6F7] min-h-screen">
        <div class="p-8 bg-white">
            <h1 class="font-semibold text-xl text-center">Update Users</h1>
            <form action="{{url("users/{$user->id}")}}" method="POST" class="gap-6 grid">
                @method('PATCH')
                @csrf
                <div class="gap-2 grid">
                    <div class="font-semibold">Name:</div>
                    <input type="text" id="name" name="name" required value="{{$user->name}}" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Username:</div>
                    <input type="text" id="username" name="username" value="{{$user->username}}" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>
                <div class="gap-2 grid">
                    <div class="font-semibold">Password:</div>
                    <input type="password" id="password" name="password" required value="{{$user->password}}" class="p-4 bg-[#E5E5E5]  rounded-2xl  text-sm w-full outline-0">
                </div>

                <button type="submit" class="p-4 bg-[#9F2D2D]  rounded-2xl  text-sm w-full outline-0 text-white font-semibold">Update</button>
            </form>
        </div>

        <script>
        </script>
    </div>
</body>

</html>
