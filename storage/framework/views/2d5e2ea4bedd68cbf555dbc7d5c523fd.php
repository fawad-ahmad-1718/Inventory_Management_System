

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-house"></i> Dashboard</h1>
    <p>Welcome back, <?php echo e(Auth::user()->name); ?>! Here's an overview of your inventory.</p>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card">
            <i class="bi bi-box-seam" style="font-size: 2.5rem; color: var(--secondary-color);"></i>
            <h3><?php echo e($totalProducts); ?></h3>
            <p>Total Products</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card">
            <i class="bi bi-exclamation-triangle-fill" style="font-size: 2.5rem; color: var(--danger-color);"></i>
            <h3><?php echo e($lowStockProducts); ?></h3>
            <p>Low Stock Items</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card stat-card">
            <i class="bi bi-shop" style="font-size: 2.5rem; color: var(--success-color);"></i>
            <h3><?php echo e($totalSuppliers); ?></h3>
            <p>Total Suppliers</p>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <?php if(Auth::user()->isAdmin()): ?>
        <a href="<?php echo e(route('users.index')); ?>" style="text-decoration:none;">
        <?php endif; ?>
        <div class="card stat-card">
            <i class="bi bi-people" style="font-size: 2.5rem; color: var(--primary-color);"></i>
            <h3><?php echo e($totalUsers); ?></h3>
            <p>System Users</p>
        </div>
        <?php if(Auth::user()->isAdmin()): ?>
        </a>
        <?php endif; ?>
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
                <?php if($recentTransactions->count() > 0): ?>
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
                                <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo e($transaction->product->name); ?></strong><br>
                                            <small class="text-muted"><?php echo e($transaction->product->sku); ?></small>
                                        </td>
                                        <td>
                                            <?php if($transaction->type === 'in'): ?>
                                                <span class="badge" style="background-color: var(--success-color);">Stock In</span>
                                            <?php else: ?>
                                                <span class="badge" style="background-color: var(--danger-color);">Stock Out</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?php echo e($transaction->quantity); ?></strong></td>
                                        <td><?php echo e($transaction->transaction_date->format('M d, Y')); ?></td>
                                        <td><?php echo e($transaction->user->name); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-4">No transactions yet.</p>
                <?php endif; ?>
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
                <?php
                    $lowStockItems = $products->filter(function($p) { 
                        return $p->isLowStock(); 
                    })->take(10);
                ?>

                <?php if($lowStockItems->count() > 0): ?>
                    <ul class="list-group list-group-flush">
                        <?php $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?php echo e($product->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($product->sku); ?></small>
                                </div>
                                <span class="badge badge-low-stock"><?php echo e($product->quantity_on_hand); ?>/<?php echo e($product->minimum_stock); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted text-center py-4">All items are well stocked.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card mt-3">
            <div class="card-header">
                <i class="bi bi-lightning"></i> Quick Actions
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('stock-in')); ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Record Stock In
                    </a>
                    <a href="<?php echo e(route('stock-out')); ?>" class="btn btn-danger">
                        <i class="bi bi-dash-circle"></i> Record Stock Out
                    </a>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add New Product
                        </a>
                        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add New Supplier
                        </a>
                        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-outline-primary">
                            <i class="bi bi-person-plus"></i> Add New User
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Inventory_Management_System\inventory-management-system\resources\views/dashboard.blade.php ENDPATH**/ ?>