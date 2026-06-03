@extends('layouts.app')

@section('title', 'Show Customer: {{ $customer->name }}')

@section('content')
    <h1>{{ $customer->name }}</h1>

    <p><strong>Telephone Number:</strong> {{ $customer->telephone_number }}</p>
    <p><strong>Street Address:</strong> {{ $customer->street_address }}</p>

    @if ($customer->treatments->count() > 0)
        <h2>Treatments</h2>
        <ul>
            @foreach ($customer->treatments as $treatment)
                <li>{{ $treatment->name }} - €{{ $treatment->price }}</li>
            @endforeach
        </ul>
    @else
        <p>No treatments found for this customer.</p>
    @endif

    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>

    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
@endsection