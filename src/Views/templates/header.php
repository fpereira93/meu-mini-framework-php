<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($page_title) ? $page_title : 'Title' ?></title>

    <script src="./public/AngularJS/angular.min.js"></script>

    <link href="./public/bootstrap4.0/bootstrap.min.css" rel="stylesheet">
    <link href="./public/css/home.css" rel="stylesheet">
    <link href="./public/css/custom.css" rel="stylesheet">
    <link href="./public/font-awesome/css/font-awesome.css" rel="stylesheet">

    <script src="./public/jQuery3.2.1/jquery.min.js"></script>
    <script src="./public/jQuery3.2.1/jquery.mask.js"></script>
    <script src="./public/bootstrap4.0/bootstrap.min.js"></script>

    <link href="./public/toastr/toastr.min.css" rel="stylesheet">
    <script src="./public/toastr/toastr.min.js"></script>

    <script src="./public/js/app.js"></script>

    <script src="./public/js/components/modal/script.js"></script>
    <script src="./public/js/components/confirmation-delete/script.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <a href="#menu-toggle" id="menu-toggle" class="navbar-brand">
            <span class="navbar-toggler-icon"></span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="<?= Classes\Route::url('home.index') ?>" class="nav-link">Manager</a>
                </li>

                <li class="nav-item active">
                    <a href="<?= Classes\Route::url('login.logout') ?>" class="nav-link" title="Click here to logout system">
                        Logout (<?= Classes\SessionUser::get('name') ?>)
                    </a>
                </li>
            </ul>
            <form class="form-inline my-2 my-md-0"> </form>
        </div>
    </nav>
    <div id="wrapper" class="toggled">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li> <a href="<?= Classes\Route::url('customers.index') ?>">List Customers</a> </li>
                <li> <a href="<?= Classes\Route::url('customers.register') ?>">Register Customers</a> </li>
            </ul>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
