@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->roles->pluck('name')->toArray()) }}</td>
                    <td>
                        <form action="{{ route('users.updateRoles', $user) }}" method="POST">
                            @csrf
                            <select name="role">
                                @foreach(Spatie\Permission\Models\Role::all() as $role)
                                    <option value="{{ $role->name }}" {{ $user->roles->first() && $user->roles->first()->name == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Update Roles</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection