@extends('layouts.app')

@section('title', 'Create Customer')

@section('content')
    <h1>Create Customer</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="telephone_number" class="form-label">Telephone Number</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" required>
        </div>

        <div class="mb-3">
            <label for="street_address" class="form-label">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Customer</button>
    </form>
@endsection