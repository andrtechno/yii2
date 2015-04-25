<?php

use app\system\assets\AdminAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title>Adminka</title>
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>

    </head>

    <body>
        <?php $this->beginBody() ?>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php //$this->widget('mod.admin.widgets.EngineMainMenu');   ?>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../navbar/">Default</a></li>
                        <li class="active"><a href="./">Static top <span class="sr-only">(current)</span></a></li>
                        <li><a href="../navbar-fixed-top/">Fixed top</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">


                <ul id="sidebar_menu" class="sidebar-nav">
                    <li class="sidebar-brand"><a id="menu-toggle" href="#">Menu<i class="icon fa-menu"></i></a></li>
                </ul>

                <ul class="sidebar-nav" style="display: none;">
                    <li>
                        <a href="#">Dashboard</a>
                    </li>
                    <li>
                        <a href="#">Shortcuts</a>
                    </li>
                    <li>
                        <a href="#">Overview</a>
                    </li>
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12 module-header">
                            <div class="pull-left">
                                <h1><?= Html::encode($this->context->pageName) ?></h1>
                            </div>


                            <div class="pull-right">
                                <?php
                                if (!isset($this->context->buttons)) {
                                    echo Html::a(Yii::t('app', 'CREATE'), ['create'], ['title' => Yii::t('app', 'CREATE'), 'class' => 'btn btn-success']);
                                } else {
                                    if ($this->context->buttons == true) {
                                        if (is_array($this->context->buttons)) {
                                            foreach ($this->context->buttons as $button) {
                                                if (isset($button['icon'])) {
                                                    $icon = '<i class="fa ' . $button['icon'] . '"></i>';
                                                } else {
                                                    $icon = '';
                                                }
                                                echo Html::a($icon . $button['label'], $button['url'], $button['options']);
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div class="clearfix"></div>
                        <div id="page-nav">
                            <?php
                            echo Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                'options' => ['class' => 'breadcrumbs pull-left']
                            ]);
                            ?>


                            <div class="clearfix"></div>
                        </div>

                        <div class="col-lg-12">
                                <?php if(Yii::$app->session->hasFlash('success')){ ?>
        <div class="alert alert-success" role="alert">

            <?= Yii::$app->session->getFlash('success')[0] ?>
        </div>
    <?php } ?>
                            
                            <?= $content ?>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <p class="col-md-12 text-center">

                    <?= Yii::t('app','COPYRIGHT',[
                        'year'=>date('Y'),
                        'v'=>'0.0.1b'
                        ]);?>
                    
                    </p>
                </footer>
            </div>
            <!-- /#page-content-wrapper -->

        </div>
        <script>
            (function($) {
                $.fn.hasScrollBar = function() {
                    return this.get(0).scrollHeight > this.height();
                }
            })(jQuery);
            (function($) {
                $.fn.has_scrollbar = function() {
                    var divnode = this.get(0);
                    if(divnode.scrollHeight > divnode.clientHeight)
                        return true;
                }
            })(jQuery);
            $(".panel-heading .grid-toggle").click(function(e) {
                e.preventDefault();
                $(this).find('i').toggleClass("fa-chevron-down");
            

            });       
            $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("active");
            

            });
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>