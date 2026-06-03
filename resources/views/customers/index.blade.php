@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <h1>Customers</h1>
    
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">Add New Customer</a>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Telephone Number</th>
                <th>Street Address</th>
                <th>Treatments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->telephone_number }}</td>
                    <td>{{ $customer->street_address }}</td>
                    <td>
                        @forelse($customer->treatments as $treatment)
                            {{ $treatment->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @empty
                            No treatments
                        @endforelse
                    </td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $customers->links() }}
@endsection