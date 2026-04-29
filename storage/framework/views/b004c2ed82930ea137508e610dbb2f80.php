

<?php $__env->startSection('title', 'Current Stock Report'); ?>

<?php $__env->startSection('content'); ?>
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
        <?php if($products->count() > 0): ?>
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
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($product->sku); ?></strong></td>
                                <td><?php echo e($product->name); ?></td>
                                <td><?php echo e($product->category->name); ?></td>
                                <td><?php echo e($product->unit); ?></td>
                                <td><?php echo e($product->minimum_stock); ?></td>
                                <td>
                                    <?php if($product->isLowStock()): ?>
                                        <span class="badge badge-low-stock"><?php echo e($product->quantity_on_hand); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-in-stock"><?php echo e($product->quantity_on_hand); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($product->isLowStock()): ?>
                                        <span class="badge" style="background-color: var(--danger-color);">
                                            <i class="bi bi-exclamation-circle"></i> Low Stock
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-active">Adequate</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php echo e($products->links()); ?>

            </div>

            <!-- Summary -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Total Products: <strong><?php echo e($products->total()); ?></strong></h6>
                            <h6>Low Stock Items: <strong class="text-danger"><?php echo e($products->filter(fn($p) => $p->isLowStock())->count()); ?></strong></h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Generated: <?php echo e(now()->format('M d, Y H:i A')); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted text-center py-5">No products found.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Inventory_Management_System\inventory-management-system\resources\views/reports/current-stock.blade.php ENDPATH**/ ?>