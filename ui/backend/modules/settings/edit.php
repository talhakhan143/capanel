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
                            <form class="form-horizontal form-bordered" action="<?=$frmAction?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?=$editData[$base_class->getDbPrefix("id")]?>" />
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="">Title</label>

                                    <div class="col-md-6">
                                        <input disabled type="text" name="title" value="<?=$editData[$base_class->getDbPrefix("title")]?>" required class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="">Value</label>

                                    <div class="col-md-6">
                                        <?php if($editData[$base_class->getDbPrefix("type")] == "textarea"){ ?>
                                        <textarea class="form-control" name="value" rows="3" required><?=$editData[$base_class->getDbPrefix("value")]?></textarea>
                                        <?php }else{ ?>
                                        <input type="<?=$editData[$base_class->getDbPrefix("type")]?>" name="value" value="<?=$editData[$base_class->getDbPrefix("value")]?>" required class="form-control" />
                                        <?php } ?>
                                    </div>
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