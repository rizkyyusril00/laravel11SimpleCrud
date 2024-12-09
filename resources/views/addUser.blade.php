<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Add User</title>
</head>

<body>
    <h1>Add User</h1>
    <div class="flex flex-col items-center justify-center">
        @if (Session::has('fail'))
            <span class="text-red-400">{{ Session::get('fail') }}</span>
        @endif
        <form action="{{ route('AddUser') }}" method="POST"
            class="flex flex-col items-center justify-center gap-4 bg-slate-100 w-full p-4">
            @csrf
            {{-- 1 --}}
            <div class="flex flex-col gap-1 w-full">
                <label for="">Name</label>
                <input type="text" name="name" class="p-4 rounded-md" placeholder="Add Name...">
                @error('name')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- 2 --}}
            <div class="flex flex-col gap-1 w-full">
                <label for="">Email</label>
                <input type="email" name="email" class="p-4 rounded-md" placeholder="Add Email...">
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- 3 --}}
            <div class="flex flex-col gap-1 w-full">
                <label for="">Phone Number</label>
                <input type="number" name="phone_number" class="p-4 rounded-md" placeholder="Add Phone Number...">
                @error('phone_number')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- 4 --}}
            <div class="flex flex-col gap-1 w-full">
                <label for="">Password</label>
                <input type="password" name="password" class="p-4 rounded-md" placeholder="Add Password...">
                @error('password')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>
            {{-- 5 --}}
            <div class="flex flex-col gap-1 w-full">
                <label for="">Confirm Password</label>
                <input type="password" name="password_confirmation" class="p-4 rounded-md"
                    placeholder="Add Confirm Password...">
                @error('password_confirmation')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="p-3 bg-green-400 rounded-lg w-full">Add</button>
        </form>
    </div>
</body>

</html>
