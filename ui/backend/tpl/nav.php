<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
             data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>



    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <?php foreach ($base_class->modules_config as $module){ ?>
                    <li class="<?=($module->package == $base_class->getModule()->package ? "nav-active" : "")?>">
                        <a href="<?=$base_class->base_url("module/".$module->package)?>">
                            <i class="<?=$module->icon?>" aria-hidden="true"></i>
                            <span><?=$module->title?></span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>

</aside>