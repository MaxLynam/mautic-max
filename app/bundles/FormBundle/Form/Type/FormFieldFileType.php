<?php
/**
 * @package     Mautic
 * @copyright   2014 Mautic Contributors. All rights reserved.
 * @author      Mautic
 * @link        http://mautic.org
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace Mautic\FormBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FormFieldButtonType
 */
class FormFieldFileType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('AllowType', 'choice', array(
            'choices'      => array(
                'PDF'     => 'pdf',
                'DOC'      => 'doc'
            ),'multiple' =>true,
            'label'        => 'Allow Type',
            'label_attr'   => array('class' => 'control-label'),
            'required' => false,
            'empty_value' => false,
            'attr'     => array(
                'class'         => 'form-control'
            )
        ));
		
		 $builder->add('directory', 'text', array(
                'label'      => ('Directory'),
                'label_attr' => array('class' => 'control-label'),
                'attr'       => array(
                    'class'   => 'form-control',
                ),
                'required'   => false
            ));
			
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "formfield_file";
    }
}
