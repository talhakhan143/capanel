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
            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Edit <?= $base_class->getModule()->title ?></h2>
                        </header>
                        <div class="panel-body">
                            <?php $ban_img_exists = file_exists($base_class->getUploadDir().$editData[$base_class->getDbPrefix("image")]); ?>
                            <form class="form-horizontal form-bordered" action="<?=$frmAction?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=$editData[$base_class->getDbPrefix("id")]?>" />
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="">Title</label>

                                    <div class="col-md-6">
                                        <input type="text" name="title" value="<?=$editData[$base_class->getDbPrefix("title")]?>" required class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="">Link</label>

                                    <div class="col-md-6">
                                        <input type="url" name="link" value="<?=$editData[$base_class->getDbPrefix("link")]?>" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="">Image</label>
                                    <div class="col-md-<?=($ban_img_exists ? "5" : "6")?>">
                                        <input type="file" name="image" <?=(!$ban_img_exists ? "required" : "")?> class="form-control" />
                                    </div>
                                    <?php if($ban_img_exists){ ?>
                                    <div class="col-md-1 light-box edit-form">
                                        <a href="<?=$base_class->getUploadDir(true).$editData[$base_class->getDbPrefix("image")]?>">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2 pull-right">
                                        <button type="reset" class="mb-xs mt-xs mr-xs btn btn-default">Reset</button>
                                        <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>

                </div>
            </div>
            <!-- end: page -->
        </section>
    </div>
</section>

<?= $base_class->loadBtmJs() ?>
<!-- Examples -->
<script src="javascripts/dashboard/examples.dashboard.js"></script>
</body>
</html>