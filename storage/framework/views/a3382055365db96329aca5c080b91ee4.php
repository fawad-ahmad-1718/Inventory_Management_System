<?php $__env->startSection('title', 'User Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-people"></i> User Management</h1>
            <p>Manage system users and their roles</p>
        </div>
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-light">
            <i class="bi bi-person-plus"></i> Add New User
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-people"></i> All Users (<?php echo e($users->total()); ?>)</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="usersTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar" style="width:36px;height:36px;border-radius:50%;background:<?php echo e($user->isAdmin() ? '#3498db' : '#27ae60'); ?>;color:white;display:flex;align-items:center;justify-content:center;font-weight:600;font-size:14px;flex-shrink:0;">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                    <strong><?php echo e($user->name); ?></strong>
                                    <?php if($user->id === auth()->id()): ?>
                                        <span class="badge" style="background:#f39c12;color:white;font-size:10px;">You</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php if($user->isAdmin()): ?>
                                    <span class="badge" style="background-color:#3498db;color:white;">
                                        <i class="bi bi-shield-check"></i> Admin
                                    </span>
                                <?php else: ?>
                                    <span class="badge" style="background-color:#27ae60;color:white;">
                                        <i class="bi bi-person"></i> Staff
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('users.edit', $user)); ?>"
                                       class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <?php if($user->id !== auth()->id()): ?>
                                        <form action="<?php echo e(route('users.destroy', $user)); ?>" method="POST"
                                              onsubmit="return confirm('Delete user <?php echo e(addslashes($user->name)); ?>? This action cannot be undone.')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled title="Cannot delete your own account">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-people fs-3 d-block mb-2"></i>
                                No users found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <small class="text-muted">
                Showing <?php echo e($users->firstItem()); ?>–<?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> users
            </small>
            <?php echo e($users->links()); ?>

        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function () {
    // Live search filter
    $('#userSearch').on('keyup', function () {
        var val = $(this).val().toLowerCase();
        $('#usersTable tbody tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(val) > -1);
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Inventory_Management_System\inventory-management-system\resources\views/users/index.blade.php ENDPATH**/ ?>