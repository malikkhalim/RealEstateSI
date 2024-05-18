<!-- resources/views/mortgage-calculator/index.blade.php -->

@extends('site.base')

@section('title') Mortgage Calculator | @endsection

@section('content')

<!-- Breadcrumb -->
<section id="bc" class="mt-3">
    <div class="container">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('listings') }}">Listings</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('single.listing', $listing->id) }}">{{ $listing->title }}</a>
                </li>
                <li class="breadcrumb-item active">Mortgage Calculator</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Mortgage Calculator -->
<section id="mortgage-calculator" class="py-4">
    <div class="container">
        <h2>Mortgage Calculator</h2>
        <form id="mortgageCalculator">
            <div class="form-group">
                <label for="price">Price ($):</label>
                <input type="number" id="price" class="form-control" value="{{ $listing->price }}" readonly>
            </div>
            <div class="form-group">
                <label for="downPayment">Down Payment ($):</label>
                <input type="number" id="downPayment" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="loanTerm">Loan Term (years):</label>
                <input type="number" id="loanTerm" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="interestRate">Interest Rate (%):</label>
                <input type="number" id="interestRate" class="form-control" step="0.01" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="calculateMortgage()">Calculate</button>
        </form>
        <div id="mortgageResult" class="mt-3"></div>
    </div>
</section>

<script>
function calculateMortgage() {
    const price = parseFloat(document.getElementById('price').value);
    const downPayment = parseFloat(document.getElementById('downPayment').value);
    const loanTerm = parseFloat(document.getElementById('loanTerm').value) * 12; // Convert to months
    const interestRate = parseFloat(document.getElementById('interestRate').value) / 100 / 12; // Monthly interest rate

    const loanAmount = price - downPayment;
    const x = Math.pow(1 + interestRate, loanTerm);
    const monthlyPayment = (loanAmount * x * interestRate) / (x - 1);

    document.getElementById('mortgageResult').innerHTML = `
        <h4>Monthly Payment: $${monthlyPayment.toFixed(2)}</h4>
    `;
}
</script>

@endsection
