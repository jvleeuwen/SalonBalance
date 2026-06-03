@extends('layouts.app')

@section('title', 'Show Treatment: {{ $treatment->name }}')

@section('content')
    <h1>{{ $treatment->name }}</h1>

    <p><strong>Price:</strong> €{{ $treatment->price }}</p>
    <p><strong>Customer:</strong> {{ optional($treatment->customer)->name }}</p>

    <a href="{{ route('treatments.edit', $treatment) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('treatments.destroy', $treatment) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection