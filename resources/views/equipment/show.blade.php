@extends('layouts.app')

@section('title', 'Optic Clubs - Booking')

@section('content')

@if(session('success'))
    <div class="alert alert-success" style="color: green; padding: 30px; background-color: #e1f8e3; border: 1px solid #d4edda; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="color: red; padding: 10px; background-color: #f8d7da; border: 1px solid #f5c6cb; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

<style>
    main {
        background-color: white;
    }
    .container {
        padding: 90px;
        text-align: center;
        margin: auto;
        max-width: 1000px;
    }
    .container input {
        margin-left: 25px;
    }
    .container button {
        padding: 10px;
        background: #f4f4f4;
    }
    th, td {
        padding: 15px;
        border: 2px solid #ddd;
    }
    button {
        margin-left: 20px;
    }
    span {
        color: red;
        font-weight: bold;
    }
</style>

<div class="container">
    <table>
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Description</th>
                <th>Quantity Available</th>
                <th>Price Per Item</th>
                <th>Bookings</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($location->equipment as $equipment)
            <tr>
                <td>{{ $equipment->name }}</td>
                <td>{{ $equipment->description }}</td>
                <td>{{ $equipment->quantity_available }}</td>
                <td>{{ $equipment->price }}</td>
                <td>
                    @if ($equipment->quantity_available > 0)
                        {{-- Booking Form --}}
                        <form method="POST" action="{{ route('payment.create') }}" id="paymentForm">
                            @csrf
                            <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
                            <input type="number" name="quantity_booked" min="1" max="{{ $equipment->quantity_available }}" required>
                            <input type="hidden" name="description" value="Booking for {{ $equipment->name }}">
                            <input type="hidden" name="price" value="{{ $equipment->price }}">
                            <input type="hidden" name="amount" id="paymentAmount" value="100">
                            <button type="submit" id="payButton" class="submit-btn">Make Payment</button>
                        </form>
                    @else
                        <span>Sold Out</span>
                    @endif
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>
</div>

<script>
    let paymentSuccess = false; // Flag to track payment status

document.getElementById('payButton').addEventListener('click', async function (e) {
    e.preventDefault(); // Prevent default button behavior

    const paymentForm = document.getElementById('paymentForm');
    const formData = new FormData(paymentForm);

    try {
        const response = await fetch(paymentForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: formData,
        });

        const result = await response.json();

        if (result.success) {
            // Redirect to Stripe Checkout
            window.location.href = result.url;
        } else {
            alert(result.message || 'Payment failed. Please try again.');
        }
    } catch (error) {
        console.error('Payment error:', error);
        alert('An error occurred during payment.');
    }
});

// Listen for post-checkout redirect success or cancel actions
window.addEventListener('load', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const paymentStatus = urlParams.get('payment_status');
    const registerButton = document.getElementById('registerButton'); // Correctly define the button element

    // Check payment status and enable the button if payment is successful
    if (paymentStatus === 'success') {
        alert('Payment completed successfully! You can now submit the form.');
        registerButton.disabled = false; // Enable the Register Club button
    } else if (paymentStatus === 'cancel') {
        alert('Payment was canceled. Please try again.');
    }

    // Add event listener to the form to validate payment before submission
    document.querySelector('form').addEventListener('submit', function (event) {
        if (registerButton.disabled) {
            event.preventDefault(); // Prevent form submission
            alert('You must complete the payment to register the club.');
        }
    });
});
</script>

@endsection
