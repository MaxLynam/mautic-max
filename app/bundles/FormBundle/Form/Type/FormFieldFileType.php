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
	public function Getextension()
	{
		$stri=dirname(__FILE__)."/../../../../config/local.php";
		include($stri);
		$result = array();
		foreach($parameters['allowed_extensions'] as $key=>$value)
		{
			$result[$value]=$value; 
		}
		return $result;
	} 
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
		$array_extension = $this->Getextension();
        $builder->add('AllowType', 'choice', array(

            'choices'      => $array_extension,
			
			'multiple' =>true,

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

