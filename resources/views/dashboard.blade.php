@extends('layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-house"></i> Dashboard</h1>
    <p>Welcome back, {{ Auth::user()->name }}! Here's an overview of your inventory.</p>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card">
            <i class="bi bi-box-seam" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
            <h3>{{ $totalProducts }}</h3>
            <p>Total Products</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 2.5rem; color: var(--danger-color);"></i>
            <h3>{{ $lowStockProducts }}</h3>
            <p>Low Stock Items</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card">
            <i class="bi bi-shop" style="font-size: 2.5rem; color: var(--success-color);"></i>
            <h3>{{ $totalSuppliers }}</h3>
            <p>Total Suppliers</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        @if(Auth::user()->isAdmin())
        <a href="{{ route('users.index') }}" style="text-decoration:none;">
        @endif
        <div class="card stat-card">
            <i class="bi bi-people" style="font-size: 2.5rem; color: var(--primary-color);"></i>
            <h3>{{ $totalUsers }}</h3>
            <p>System Users</p>
        </div>
        @if(Auth::user()->isAdmin())
        </a>
        @endif
    </div>
</div>

<div class="row">
    <!-- Recent Transactions -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul"></i> Recent Stock Transactions
            </div>
            <div class="card-body">
                @if($recentTransactions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Date</th>
                                    <th>By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentTransactions as $transaction)
                                    <tr>
                                        <td>
                                            <strong>{{ $transaction->product->name }}</strong><br>
                                            <small class="text-muted">{{ $transaction->product->sku }}</small>
                                        </td>
                                        <td>
                                            @if($transaction->type === 'in')
                                                <span class="badge" style="background-color: var(--success-color);">Stock In</span>
                                            @else
                                                <span class="badge" style="background-color: var(--danger-color);">Stock Out</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $transaction->quantity }}</strong></td>
                                        <td>{{ $transaction->transaction_date->format('M d, Y') }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center py-4">No transactions yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Low Stock Products -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-exclamation-triangle"></i> Low Stock Items
            </div>
            <div class="card-body">
                @php
                    $lowStockItems = $products->filter(function($p) { 
                        return $p->isLowStock(); 
                    })->take(10);
                @endphp

                @if($lowStockItems->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($lowStockItems as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $product->name }}</strong><br>
                                    <small class="text-muted">{{ $product->sku }}</small>
                                </div>
                                <span class="badge badge-low-stock">{{ $product->quantity_on_hand }}/{{ $product->minimum_stock }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center py-4">All items are well stocked.</p>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mt-3">
            <div class="card-header">
                <i class="bi bi-lightning"></i> Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('stock-in') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Record Stock In
                    </a>
                    <a href="{{ route('stock-out') }}" class="btn btn-danger">
                        <i class="bi bi-dash-circle"></i> Record Stock Out
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add New Product
                        </a>
                        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add New Supplier
                        </a>
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                            <i class="bi bi-person-plus"></i> Add New User
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
