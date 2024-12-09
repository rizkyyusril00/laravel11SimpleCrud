<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Home</title>
</head>

<body>
    <div class="flex flex-col gap-4 icon-open justify-center mt-8">
        <h1 class="mx-auto text-2xl text-black font-semibold">List All Users</h1>
        <a href="/add/user" class="p-3 bg-green-400 rounded-lg w-[143px] text-center">Add New</a>
        @if (Session::has('success'))
            <span class="text-green-400">{{ Session::get('success') }}</span>
        @endif
        @if (Session::has('fail'))
            <span class="text-red-400">{{ Session::get('fail') }}</span>
        @endif
        <table>
            <thead class="border border-slate-400 text-center">
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">NAME</th>
                    <th class="px-4 py-2">EMAIL</th>
                    <th class="px-4 py-2">PHONE NUMBER</th>
                    <th class="px-4 py-2">REGIST DATE</th>
                    <th class="px-4 py-2">UPDATE DATE</th>
                    <th class="px-4 py-2">ACTION</th>
                </tr>
            </thead>
            <tbody class="text-center border border-slate-400">
                @if (count($all_users) > 0)
                    @foreach ($all_users as $user)
                        <tr>
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->phone_number }}</td>
                            <td class="px-4 py-2">{{ $user->created_at }}</td>
                            <td class="px-4 py-2">{{ $user->updated_at }}</td>
                            <td class="px-4 py-2 flex gap-1">
                                <a href="/update/{{ $user->id }}"
                                    class="text-green-400 bg-slate-200 rounded-lg p-1">Update</a>
                                <a href="/delete/{{ $user->id }}"
                                    class="text-red-400 bg-slate-200 rounded-lg p-1">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center flex items-center justify-center">
                        <td class="text-center">No User Found!!</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>
