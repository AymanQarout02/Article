<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>
<main>
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">username</th>
        <th scope="col">email</th>
        <th scope="col">role</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)

                <tr>
                    <form action="{{route('user.update' , $user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <th scope="row">{{ $user->id }}</th>
                        <th scope="row"><input type="text" class="form-control" name="name" value="{{ $user->name }}" ></th>
                        <th scope="row"><input type="text" class="form-control" name="email" value="{{ $user->email }}" ></th>
                        <th scope="row">
                            <select class="form-select" name="role">
                                <option value="viewer" {{ $user->role === 'viewer' ? 'selected' : '' }}>viewer</option>
                                <option value="publisher" {{ $user->role === 'publisher' ? 'selected' : '' }}>publisher</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                            </select>
                        </th>
                        <td><button class="w-100 btn btn-primary btn-sm" type="submit">Edit</button></td>
                    </form>
                    <form action="{{route('user.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <td><button class="w-100 btn btn-danger btn-sm" type="submit">Delete</button></td>
                    </form>
                </tr>
        @endforeach
    </tbody>
</table>
    <a href="{{url()->previous()}}">Back</a>
</main>
</x-app-layout>
