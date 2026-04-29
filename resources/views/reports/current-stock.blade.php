@extends('layouts.base')

@section('title', 'Current Stock Report')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-file-earmark-bar-graph"></i> Current Stock Report</h1>
    <p>View current quantity on hand for all products</p>
</div>

<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <span>Stock Levels</span>
            <button class="btn btn-sm btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Report
            </button>
        </div>
    </div>
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>Min Stock</th>
                            <th>On Hand</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><strong>{{ $product->sku }}</strong></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>{{ $product->minimum_stock }}</td>
                                <td>
                                    @if($product->isLowStock())
                                        <span class="badge badge-low-stock">{{ $product->quantity_on_hand }}</span>
                                    @else
                                        <span class="badge badge-in-stock">{{ $product->quantity_on_hand }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->isLowStock())
                                        <span class="badge" style="background-color: var(--danger-color);">
                                            <i class="bi bi-exclamation-circle"></i> Low Stock
                                        </span>
                                    @else
                                        <span class="badge badge-active">Adequate</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>

            <!-- Summary -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total Products: <strong>{{ $products->total() }}</strong></h6>
                            <h6>Low Stock Items: <strong class="text-danger">{{ $products->filter(fn($p) => $p->isLowStock())->count() }}</strong></h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Generated: {{ now()->format('M d, Y H:i A') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-muted text-center py-5">No products found.</p>
        @endif
    </div>
</div>
@endsection
