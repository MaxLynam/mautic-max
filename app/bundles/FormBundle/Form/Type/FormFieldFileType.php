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
			
				'csv'=>'csv',
				'doc'=>'doc',
				'docx'=>'docx',
				'epub'=>'epub',
				'gif'=>'gif',
				'jpg'=>'jpg',
				'jpeg'=>'jpeg',
				'mpg'=>'mpg',
				'mpeg'=>'mpeg',
				'mp3'=>'mp3',
				'odt'=>'odt',
				'odp'=>'odp',
				'ods'=>'ods',
				'pdf'=>'pdf',
				'png'=>'png',
				'ppt'=>'ppt',
				'pptx'=>'pptx',
				'tif'=>'tif',
				'tiff'=>'tiff',
				'txt'=>'txt',
				'xls'=>'xls',
				'xlsx'=>'xlsx',
				'wav'=>'wav'
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

