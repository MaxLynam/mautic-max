<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!$app->getRequest()->isXmlHttpRequest()):
//load base template
$view->extend('MauticBaseBundle:Default:base.html.php');
endif;
?>
<div id="main-panel-header">
    <h1>Dashboard</h1>
</div>


<h5>Dashboard content</h5>