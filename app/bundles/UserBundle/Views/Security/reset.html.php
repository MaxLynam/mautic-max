<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!$app->getRequest()->isXmlHttpRequest()) {
    $view->extend('MauticUserBundle:Security:base.html.php');
} else {
    $view->extend('MauticUserBundle:Security:ajax.html.php');
}
?>

<div class="alert alert-warning"><?php echo $view['translator']->trans('mautic.user.user.passwordreset.info'); ?></div>
<?php
echo $view['form']->start($form);
echo $view['form']->row($form['identifier']);
echo $view['form']->widget($form['submit']);
echo $view['form']->end($form);
?>

<div class="mt-sm">
    <a href="<?php echo $view['router']->generate('login'); ?>"><?php echo $view['translator']->trans('mautic.user.user.passwordreset.back'); ?></a>
</div>
