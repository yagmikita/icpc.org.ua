<!DOCTYPE html>
<html lang="<?=\yii::app()->language?>">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?=$this->pageTitle?></title>
    <link rel="icon" type="image/x-icon" href="<?=\yii::app()->theme->baseUrl?>/favicon.ico" />

    <?php
        $cs = \yii::app()->getClientScript();

        // jQuery
        $cs->registerCoreScript('jquery');

        // Bootsrtap
        $cs->registerCoreScript('bootstrap');

        // App JS
        $cs->registerScriptFile($cs->getCoreScriptUrl() . '/min/?g=js&v=' . \yii::app()->params['version']);
        $cs->registerCssFile($cs->getCoreScriptUrl() . '/min/?g=css&theme=' . \yii::app()->theme->name . '&v=' . \yii::app()->params['version']);

        // JS global vars
        $this->widget('\web\widgets\HeadScript');
    ?>

</head>


<body>

    <?php $this->widget('\web\widgets\AppEnv'); ?>

    <div id="main">

        <div class="container">
            <div class="header-title">
                <table>
                    <tr>
                        <td>
                            <img src="<?=\yii::app()->theme->baseUrl?>/images/layout/icpc.png" style="width: 98px;" />
                        </td>
                        <td>
                            <?=\yii::t('app', 'Ukranian Collegiate Programming Contest')?>
                        </td>
                        <td>
                            <img src="<?=\yii::app()->theme->baseUrl?>/images/layout/acm-icpc.gif" style="width: 95px;" />
                        </td>
                    </tr>
                </table>
            </div>
            <div class="slogan">
                &mdash; «<?=\yii::t('app', 'Do it with us, do it like us, do it better than us!')?>»
            </div>
            <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?=\yii::app()->baseUrl?>/"></a>
                </div>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <?php $this->widget('\web\widgets\Nav', array(
                        'class'      => 'nav navbar-nav',
                        'activeItem' => $this->getNavActiveItem('main'),
                        'itemList'   => array(
                            'news' => array(
                                'href'      => '/',
                                'caption'   => \yii::t('app', 'News'),
                            ),
                            'docs' => array(
                                'href'      => '#',
                                'caption'   => \yii::t('app', 'Docs'),
                                'itemList'  => array(
                                    'docs-regulations' => array(
                                        'href'      => $this->createUrl('/docs/regulations'),
                                        'caption'   => \yii::t('app', 'Regulations'),
                                    ),
                                    'docs-guidance' => array(
                                        'href'      => $this->createUrl('/docs/guidance'),
                                        'caption'   => \yii::t('app', 'Guidance'),
                                    ),
                                ),
                            ),
                            'results' => array(
                                'href'      => '/results',
                                'caption'   => \yii::t('app', 'Results'),
                            ),
                            'staff' => array(
                                'href'      => $this->createUrl('/staff'),
                                'caption'   => \yii::t('app', 'Staff'),
                                'rbac'      => \common\models\User::ROLE_COORDINATOR_UKRAINE,
                            ),
                            'lang' => array(
                                'href'      => $this->createUrl('/staff/lang'),
                                'caption'   => \yii::t('app', 'Langs'),
                                'rbac'      => \common\models\User::ROLE_ADMIN,
                            ),
                        ),
                    )); ?>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (\yii::app()->user->isGuest): ?>
                            <li><a href="<?=$this->createUrl('/auth/login')?>"><?=\yii::t('app', 'Login')?></a></li>
                        <?php else: ?>
                            <li>
                                <p class="navbar-text">
                                    <?=\yii::t('app', 'Hello')?>,
                                    <a href="<?=$this->createUrl('/user/me')?>"><?=\yii::app()->user->getInstance()->firstName?></a>
                                </p>
                            </li>
                            <li><a href="<?=$this->createUrl('/auth/logout')?>"><?=\yii::t('app', 'Logout')?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
            <?=$content?>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-static-bottom" role="navigation">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li>
                    &copy; 2013 <a href="http://www.dataart.ua" target="_blank" class="inline">DataArt</a>
                </li>
                <li>
                    <a href="https://github.com/uaoleg/icpc.org.ua" target="_blank" class="inline">
                        <span class="img-layout-github-24"></span></a>
                    <a href="https://github.com/uaoleg/icpc.org.ua" target="_blank" class="inline">GitHub</a>
                </li>
                <li>
                    <a href="https://twitter.com/IcpcOrgUa" target="_blank" class="inline">
                        <span class="img-layout-twitter-24"></span></a>
                    <a href="https://twitter.com/IcpcOrgUa" target="_blank" class="inline">Twitter</a>
                </li>
                <li>
                    <span class="img-layout-mail-24"></span>
                    <a href="mailto:info@icpc.org.ua" class="inline">info@icpc.org.ua</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown dropup language-select">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-decoration: none;">
                        <span class="img-language-<?=\yii::app()->language?>-16"></span>
                        <?=isset(\yii::app()->params['languages'][\yii::app()->language])
                            ? \yii::app()->params['languages'][\yii::app()->language]
                            : \yii::t('app', 'Language')
                        ?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <?php foreach (\yii::app()->params['languages'] as $langKey => $langVal): ?>
                        <li>
                            <a href="<?=$this->createUrl('/setting/lang', array(
                                'code' => $langKey,
                            ))?>" data-lang="<?=$langKey?>">
                                <span class="img-language-<?=$langKey?>-16"></span>
                                <?=$langVal?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <?php $this->widget('\web\widgets\GoogleAnalytics'); ?>

</body>

</html>