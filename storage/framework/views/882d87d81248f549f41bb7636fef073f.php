

<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-box-seam"></i> Products</h1>
            <p>Manage your product inventory</p>
        </div>
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Product
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($products->count() > 0): ?>
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
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($product->sku); ?></strong></td>
                                <td>
                                    <?php echo e($product->name); ?>

                                </td>
                                <td><?php echo e($product->category->name); ?></td>
                                <td><?php echo e($product->unit); ?></td>
                                <td>
                                    <?php if($product->isLowStock()): ?>
                                        <span class="badge badge-low-stock"><?php echo e($product->quantity_on_hand); ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-in-stock"><?php echo e($product->quantity_on_hand); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($product->minimum_stock); ?></td>
                                <td>
                                    <?php if($product->status === 'active'): ?>
                                        <span class="badge badge-active">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-inactive">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
        <?php else: ?>
            <p class="text-muted text-center py-5">No products found. <a href="<?php echo e(route('products.create')); ?>">Create one now.</a></p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Inventory Management System\inventory-system\resources\views/products/index.blade.php ENDPATH**/ ?>