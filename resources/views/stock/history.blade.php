@extends('layouts.base')

@section('title', 'Stock History')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-clock-history"></i> Stock Transaction History</h1>
    <p>View all stock movements in the system</p>
</div>

<div class="card">
    <div class="card-body">
        @if($transactions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Quantity</th>
                            <th>Recorded By</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                <td>
                                    @if($transaction->type === 'in')
                                        <span class="badge" style="background-color: var(--success-color);">
                                            <i class="bi bi-plus-circle"></i> Stock In
                                        </span>
                                    @else
                                        <span class="badge" style="background-color: var(--danger-color);">
                                            <i class="bi bi-dash-circle"></i> Stock Out
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $transaction->product->name }}</strong><br>
                                    <small class="text-muted">{{ $transaction->product->sku }}</small>
                                </td>
                                <td>
                                    {{ $transaction->supplier->name ?? '-' }}
                                </td>
                                <td>
                                    <strong>{{ $transaction->quantity }} {{ $transaction->product->unit }}</strong>
                                </td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->remarks ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        @else
            <p class="text-muted text-center py-5">No stock transactions found.</p>
        @endif
    </div>
</div>
@endsection
