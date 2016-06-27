<!doctype html>
<html class="<?php include __DIR__ . '/../../tpl/themeName.php'; ?>">
<head>
    <?php include __DIR__ . '/../../tpl/head.php'; ?>
</head>
<body>
<section class="body">

    <!-- start: header -->
    <?php include __DIR__ . '/../../tpl/header.php'; ?>
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <?php include __DIR__ . '/../../tpl/nav.php'; ?>
        <!-- end: sidebar -->
        <section role="main" class="content-body">
            <?php include __DIR__ . '/../../tpl/page-header.php'; ?>

            <!-- start: page -->
            <section class="panel">
                <header class="panel-heading">
                    <a href="<?= $base_class->getUiUrls("add", true) ?>" class="mb-xs mt-xs mr-xs btn btn-primary"><i
                            class="fa fa-plus"></i> Add</a>
                </header>
                <div class="panel-body">
                    <table class="table table-bordered table-striped mb-none data-table server" data-source="<?=$base_class->getCtrlUrls("dataTable", true)?>" data-pages="6">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th width="90%">Title</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </section>
            <!-- end: page -->
        </section>
    </div>
</section>

<?= $base_class->loadBtmJs() ?>
</body>
</html>