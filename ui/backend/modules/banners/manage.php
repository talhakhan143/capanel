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
                    <table class="table table-bordered table-striped mb-none data-table">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th width="90%">Title</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sno = 1;
                        foreach($gridData as $item){ ?>
                        <tr>
                            <td><?=$sno?></td>
                            <td><?=$item[$base_class->getDbPrefix("title")]?></td>
                            <td class="center light-box">
                                <a href="<?=$base_class->getUploadDir(true).$item[$base_class->getDbPrefix("image")]?>">
                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td class="center"><a href="<?= $base_class->getUiUrls("edit", true) ?>/<?=$item[$base_class->getDbPrefix("id")]?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                            <td class="center"><a href="#" onclick="deleteGrid('<?=$base_class->getCtrlUrls("delete", true)?>/<?=$item[$base_class->getDbPrefix("id")]?>',this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        </tr>
                        <?php $sno++;
                        } ?>
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