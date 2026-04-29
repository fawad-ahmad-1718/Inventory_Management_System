

<?php $__env->startSection('title', 'Stock History'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-clock-history"></i> Stock Transaction History</h1>
    <p>View all stock movements in the system</p>
</div>

<div class="card">
    <div class="card-body">
        <?php if($transactions->count() > 0): ?>
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
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transaction->transaction_date->format('M d, Y')); ?></td>
                                <td>
                                    <?php if($transaction->type === 'in'): ?>
                                        <span class="badge" style="background-color: var(--success-color);">
                                            <i class="bi bi-plus-circle"></i> Stock In
                                        </span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: var(--danger-color);">
                                            <i class="bi bi-dash-circle"></i> Stock Out
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo e($transaction->product->name); ?></strong><br>
                                    <small class="text-muted"><?php echo e($transaction->product->sku); ?></small>
                                </td>
                                <td>
                                    <?php echo e($transaction->supplier->name ?? '-'); ?>

                                </td>
                                <td>
                                    <strong><?php echo e($transaction->quantity); ?> <?php echo e($transaction->product->unit); ?></strong>
                                </td>
                                <td><?php echo e($transaction->user->name); ?></td>
                                <td><?php echo e($transaction->remarks ?? '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                <?php echo e($transactions->links()); ?>

            </div>
        <?php else: ?>
            <p class="text-muted text-center py-5">No stock transactions found.</p>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Inventory Management System\inventory-system\resources\views/stock/history.blade.php ENDPATH**/ ?>