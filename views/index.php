<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- Primary Meta Tags -->
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Dashboard">
    <!--<meta name="author" content="Themesberg">-->
    <!--<meta name="description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">-->
    <!--<meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />-->
    <!--<link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">-->


    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="/views/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/views/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/views/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/views/assets/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- Sweet Alert -->
    <link type="text/css" href="/views/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Notyf -->
    <link type="text/css" href="/views/vendor/notyf/notyf.min.css" rel="stylesheet">

    <!-- Volt CSS -->
    <link type="text/css" href="/views/css/volt.css" rel="stylesheet">

    <!-- Data tables -->
    <link rel="stylesheet" href="/views/utils/DataTables/DataTables-1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- <link rel="stylesheet" href="/views/utils/DataTables/datatables.css"> -->

    <!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
    <link rel="stylesheet" href="/views/css/el-llano-styles.css">

</head>

<body>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->
<?php echo $navBar?>
<?php echo $sideBar?>

<main class="content">

    <?php echo $menuBar?>

    <div id="mainContent">

    <?php echo $content?>

    </div>
</main>

<!-- Core -->
<script src="/views/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="/views/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="/views/vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="/views/vendor/nouislider/dist/nouislider.min.js"></script>

<!-- Smooth scroll -->
<script src="/views/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Charts -->
<script src="/views/vendor/chartist/dist/chartist.min.js"></script>
<script src="/views/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="/views/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Sweet Alerts 2 -->
<script src="/views/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="/views/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Notyf -->
<script src="/views/vendor/notyf/notyf.min.js"></script>

<!-- Simplebar -->
<script src="/views/vendor/simplebar/dist/simplebar.min.js"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="/views/assets/js/volt.js"></script>

<!-- Data tables -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="/views/utils/jQuery-3.6.0/jquery-3.6.0.js"></script>
<!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="/views/utils/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script> -->
<script src="/views/utils/DataTables/datatables.js"></script>
<script src="/views/utils/DataTables/DataTables-1.13.4/js/dataTables.bootstrap5.js"></script>

<script src="/controllers/dashboard.controller.js" type="module"></script>

</body>

</html>
