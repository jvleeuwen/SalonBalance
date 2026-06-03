@extends('layouts.app')

@section('content')
    <h1>Treatments</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <a href="{{ route('treatments.create') }}" class="btn btn-primary mb-3">Add New Treatment</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Customer</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($treatments as $treatment)
                <tr>
                    <td>{{ $treatment->name }}</td>
                    <td>{{ $treatment->price }}</td>
                    <td>{{ optional($treatment->customer)->name }}</td>
                    <td>
                        <a href="{{ route('treatments.edit', $treatment->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $treatments->links() }}
@endsection