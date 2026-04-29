@extends('layouts.base')

@section('title', 'Products')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-box-seam"></i> Products</h1>
            <p>Manage your product inventory</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Product
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>On Hand</th>
                            <th>Min Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><strong>{{ $product->sku }}</strong></td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->unit }}</td>
                                <td>
                                    @if($product->isLowStock())
                                        <span class="badge badge-low-stock">{{ $product->quantity_on_hand }}</span>
                                    @else
                                        <span class="badge badge-in-stock">{{ $product->quantity_on_hand }}</span>
                                    @endif
                                </td>
                                <td>{{ $product->minimum_stock }}</td>
                                <td>
                                    @if($product->status === 'active')
                                        <span class="badge badge-active">Active</span>
                                    @else
                                        <span class="badge badge-inactive">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
        @else
            <p class="text-muted text-center py-5">No products found. <a href="{{ route('products.create') }}">Create one now.</a></p>
        @endif
    </div>
</div>
@endsection
