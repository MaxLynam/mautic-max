<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
$form = $event['extra']['form'];
$page = $event['extra']['page'];
$submission = $event['extra']['submission'];
$results = $submission->getResults();

if ($page->getId()) {
	$link = '<a href="' . $view['router']->generate('mautic_page_action', array("objectAction" => "view", "objectId" => $page->getId())) . '" data-toggle="ajax">' . $page->getTitle() . '</a>';
}
//echo "<pre>";print_r($results);echo"</pre>";
?>

<li class="wrapper form-submitted">
	<div class="figure"><span class="fa <?php echo isset($icons['form']) ? $icons['form'] : '' ?>"></span></div>
	<div class="panel">
	    <div class="panel-body">
	    	<h3>
	    		<a href="<?php echo $view['router']->generate('mautic_form_action',
				    array("objectAction" => "view", "objectId" => $form->getId())); ?>"
				   data-toggle="ajax">
				    <?php echo $form->getName(); ?>
				</a>
			</h3>
            <p class="mb-0"><?php echo $view['translator']->trans('mautic.core.timeline.event.time', array('%date%' => $view['date']->toFullConcat($event['timestamp']), '%event%' => $event['eventLabel'])); ?></p>
	    </div>
	    <?php if (isset($event['extra'])) : ?>
	        <div class="panel-footer">
	        	<dl class="dl-horizontal">
        		<?php if (isset($link)) : ?>
					<dt><?php echo $view['translator']->trans('mautic.core.source'); ?></dt>
					<dd><?php echo $link; ?></dd>
				<?php endif; ?>
				<?php if ($form->getDescription()) : ?>
					<dt><?php echo $view['translator']->trans('mautic.core.description'); ?></dt>
					<dd><?php echo $form->getDescription(); ?></dd>
				    <?php if (isset($event['extra'])) : ?>
                        <?php if ($descr = $form->getDescription()): ?>
	                    <p><?php echo $descr; ?></p>
                    <?php endif; ?>
                    <?php endif; ?>
				<?php endif; ?>
					<dt><?php echo $view['translator']->trans('mautic.form.result.thead.referrer'); ?></dt>
					<dd><?php echo $view['assets']->makeLinks($submission->getReferer()); ?></dd>
				<?php if (is_array($results)) : ?>
					<?php foreach ($form->getFields() as $field) : ?>
						<?php if (array_key_exists($field->getAlias(), $results)) : ?>
							<dt><?php echo $field->getLabel(); ?></dt>
							<dd><?php if($field->getType()=='file')
							{
								$str = $results[$field->getAlias()];
								$cout=substr($str,-2).'</br>';
								$name=substr(substr($str,(int)$cout,-2),0,-3);
								$extension=".".substr(substr($str,(int)$cout,-2),strlen($name));
								?>
                                <a href="javascript:void(0)" onClick="window.location = '<?php echo $view['router']->generate('mautic_form_download');?>?file_name=<?php echo $name.$extension; ?>&directory=<?php echo substr($str,0,(int)$cout); ?>'"><?php echo $name.$extension; ?></a>
								<?php
								//echo "<a class='file' href='../upload/".$results[$field->getAlias()]."'>".$results[$field->getAlias()]."</a>";
							}
							else
							{
								echo $results[$field->getAlias()];
							} ?></dd>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				</dl>
	        </div>
	    <?php endif; ?>
	</div>
</li>
