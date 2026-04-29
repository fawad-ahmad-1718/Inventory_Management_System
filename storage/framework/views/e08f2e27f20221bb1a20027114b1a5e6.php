

<?php $__env->startSection('title', 'Suppliers'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-shop"></i> Suppliers</h1>
            <p>Manage your suppliers</p>
        </div>
        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Supplier
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($suppliers->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Supplier Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($supplier->name); ?></strong></td>
                                <td><?php echo e($supplier->contact_person ?? '-'); ?></td>
                                <td><?php echo e($supplier->email ?? '-'); ?></td>
                                <td><?php echo e($supplier->phone ?? '-'); ?></td>
                                <td><?php echo e(Str::limit($supplier->address ?? '-', 50)); ?></td>
                                <td>
                                    <?php if($supplier->status === 'active'): ?>
                                        <span class="badge badge-active">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-inactive">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('suppliers.destroy', $supplier)); ?>" method="POST" style="display: inline;">
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
                <?php echo e($suppliers->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-muted text-center py-5">No suppliers found. <a href="<?php echo e(route('suppliers.create')); ?>">Create one now.</a></p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-shop"></i> Suppliers</h1>
            <p>Manage your suppliers</p>
        </div>
        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Supplier
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <?php if($suppliers->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contact Person</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($supplier->name); ?></strong></td>
                                <td><?php echo e($supplier->contact_person ?? '-'); ?></td>
                                <td><?php echo e($supplier->phone ?? '-'); ?></td>
                                <td><?php echo e($supplier->email ?? '-'); ?></td>
                                <td>
                                    <?php if($supplier->status === 'active'): ?>
                                        <span class="badge badge-active">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-inactive">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('suppliers.edit', $supplier)); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="<?php echo e(route('suppliers.destroy', $supplier)); ?>" method="POST" style="display: inline;">
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
                <?php echo e($suppliers->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-muted text-center py-5">No suppliers found. <a href="<?php echo e(route('suppliers.create')); ?>">Add one now.</a></p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Inventory Management System\inventory-system\resources\views/suppliers/index.blade.php ENDPATH**/ ?>