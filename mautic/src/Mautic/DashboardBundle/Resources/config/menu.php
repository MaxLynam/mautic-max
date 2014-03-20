<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic, NP. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

$items = array(
    "Dashboard" => array(
        "options" => array(
            "route"    => "mautic_dashboard_index",
            "uri"      => "javascript: void(0)",
            "linkAttributes" => array(
                "onclick" =>
                    "loadMauticContent('" . $this->container->get("router")->generate("mautic_dashboard_index") . "', this);"
            ),
            "labelAttributes" => array(
                "class"   => "nav-item-name"
            ),
            "extras"=> array("icon" => "th")

        )
    )
);