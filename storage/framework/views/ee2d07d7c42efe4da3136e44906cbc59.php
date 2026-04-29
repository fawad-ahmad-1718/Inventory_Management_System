<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> - Inventory Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --danger-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
        }

        .sidebar {
            background-color: var(--primary-color);
            color: white;
            min-height: 100vh;
            padding: 20px 0;
        }

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            border-radius: 4px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: var(--secondary-color);
            color: white;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .content-wrapper {
            padding: 30px;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .page-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
        }

        .page-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0;
            padding: 20px;
            font-weight: 600;
        }

        .stat-card {
            text-align: center;
            padding: 30px;
            border-left: 4px solid var(--secondary-color);
        }

        .stat-card h3 {
            margin: 10px 0 0 0;
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-card p {
            color: #7f8c8d;
            margin: 5px 0 0 0;
        }

        .btn {
            border-radius: 4px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-success:hover {
            background-color: #229954;
            border-color: #229954;
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: #e67e22;
            border-color: #e67e22;
            color: white;
        }

        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead {
            background-color: #ecf0f1;
            border-bottom: 2px solid #bdc3c7;
        }

        .table thead th {
            color: var(--primary-color);
            font-weight: 600;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            border-color: #ecf0f1;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-active {
            background-color: var(--success-color);
            color: white;
        }

        .badge-inactive {
            background-color: #95a5a6;
            color: white;
        }

        .badge-low-stock {
            background-color: var(--danger-color);
            color: white;
        }

        .badge-in-stock {
            background-color: var(--success-color);
            color: white;
        }

        .form-control, .form-select {
            border-radius: 4px;
            border: 1px solid #bdc3c7;
            padding: 10px 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-label {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .alert {
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination .page-link {
            color: var(--secondary-color);
            border-color: #bdc3c7;
            border-radius: 4px;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            background-color: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                top: 0;
                width: 250px;
                height: 100vh;
                z-index: 1000;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .content-wrapper {
                padding: 20px;
            }

            .page-header h1 {
                font-size: 1.5rem;
            }
        }

        .form-section {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="bi bi-box2-heart"></i> Inventory Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> <?php echo e(Auth::user()->name); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php if(auth()->guard()->check()): ?>
        <div class="d-flex">
            <!-- Sidebar -->
            <nav class="sidebar" id="sidebar">
                <div class="ps-2 pe-2">
                    <h6 class="text-uppercase fs-7 mb-3">Main Menu</h6>
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                    
                    <h6 class="text-uppercase fs-7 mb-3 mt-4">Inventory</h6>
                    <a href="<?php echo e(route('stock-in')); ?>" class="nav-link <?php echo e(request()->routeIs('stock-in') ? 'active' : ''); ?>">
                        <i class="bi bi-plus-circle"></i> Stock In
                    </a>
                    <a href="<?php echo e(route('stock-out')); ?>" class="nav-link <?php echo e(request()->routeIs('stock-out') ? 'active' : ''); ?>">
                        <i class="bi bi-dash-circle"></i> Stock Out
                    </a>
                    <a href="<?php echo e(route('stock.history')); ?>" class="nav-link <?php echo e(request()->routeIs('stock.history') ? 'active' : ''); ?>">
                        <i class="bi bi-clock-history"></i> Stock History
                    </a>

                    <h6 class="text-uppercase fs-7 mb-3 mt-4">Reports</h6>
                    <a href="<?php echo e(route('reports.current-stock')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.current-stock') ? 'active' : ''); ?>">
                        <i class="bi bi-file-earmark-bar-graph"></i> Current Stock
                    </a>
                    <a href="<?php echo e(route('reports.stock-movement')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.stock-movement') ? 'active' : ''); ?>">
                        <i class="bi bi-arrow-left-right"></i> Stock Movement
                    </a>
                    <a href="<?php echo e(route('reports.stock-summary')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.stock-summary') ? 'active' : ''); ?>">
                        <i class="bi bi-graph-up"></i> Stock Summary
                    </a>

                    <?php if(Auth::user()->isAdmin()): ?>
                        <h6 class="text-uppercase fs-7 mb-3 mt-4">Administration</h6>
                        <a href="<?php echo e(route('products.index')); ?>" class="nav-link <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">
                            <i class="bi bi-box-seam"></i> Products
                        </a>
                        <a href="<?php echo e(route('suppliers.index')); ?>" class="nav-link <?php echo e(request()->routeIs('suppliers.*') ? 'active' : ''); ?>">
                            <i class="bi bi-shop"></i> Suppliers
                        </a>
                    <?php endif; ?>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="flex-grow-1">
                <div class="content-wrapper">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <strong>Oops! Something went wrong.</strong>
                            <ul class="mb-0 mt-2">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="bi bi-check-circle"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="bi bi-exclamation-circle"></i> <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="content-wrapper">
            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <strong>Oops! Something went wrong.</strong>
                    <ul class="mb-0 mt-2">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    <?php endif; ?>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Inventory Management System. All rights reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\Inventory Management System\inventory-system\resources\views/layouts/base.blade.php ENDPATH**/ ?>