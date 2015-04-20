<?php

/**

 * @package     Mautic

 * @copyright   2014 Mautic Contributors. All rights reserved.

 * @author      Mautic

 * @link        http://mautic.org

 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html

 */

$fields   = $form->getFields();

$formName = \Mautic\CoreBundle\Helper\InputHelper::alphanum($form->getName());

?>

<script type="text/javascript">

jQuery('.mauticform-hidden').append('<div class="display-file"></div>');

jQuery('input[type=file]').each(function (){

	jQuery('.mauticform-hidden').append("<input type='text' style='display:none' name=mauticform[file_name] value='"+jQuery(this).attr('name').slice(0, -2)+"'></input>");

	jQuery('.mauticform-hidden').append("<input type='text' style='display:none' name=mauticform[file_directory] value='"+jQuery(this).attr('directories')+"'></input>");

	jQuery('.mauticform-hidden').append("<input type='text' id='"+jQuery(this).attr('name').slice(0, -2)+"' style='display:none' name=mauticform["+jQuery(this).attr('name').slice(0, -2)+"] value=''></input>");

	});

function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) return bytes + ' ' + sizes[i]; 
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};

jQuery('input[type=file]').change(function()

{

	var name = jQuery(this).attr('name').slice(0, -2);
	var dir = jQuery(this).attr('directories');
	var html = "<table border='1'><tbody><tr><td style='padding:3px;'>File Name</td><td style='padding:3px;'>File Size</td></tr>";
	dir = dir+ "/.dirspace./";
	var file_name = "";
	for(var i=0;i<jQuery(this)[0].files.length;i++)
		{
			var size=bytesToSize(jQuery(this)[0].files[i].size);
			html+='<tr><td style="padding:3px;">'+jQuery(this)[0].files[i].name+'</td><td style="padding:3px;">'+size+'</td></tr>'
			if(i<jQuery(this)[0].files.length-1)
			{
			 	file_name += jQuery(this)[0].files[i].name + "/.space./";
			}
			else
			{
				file_name += jQuery(this)[0].files[i].name;
			}
		}
	html+="</tbody></table>";
	jQuery('.display-file').html(html);
	jQuery('[name="mauticform['+name+']"]').val(dir+file_name);
});

	

	function validateFile(ele_file) {
			var str = jQuery(ele_file).attr('allowtype');
			var temp = new Array();
			temp = str.split(";");
			var count = 1;
			if(str=="")
				return 0;
				
			for(var i=0;i<jQuery(ele_file)[0].files.length;i++)
				{
					var file = jQuery(ele_file)[0].files[i].name;
					var filetype = file.substr((~-file.lastIndexOf(".") >>> 0) + 2);
					if(temp.indexOf(filetype)>-1)
					{
						count = 0;
					}
					else
					{
						return 1;
					}
				}
			return count;		
        }

	

	 jQuery("#mauticform_<?php echo $formName; ?>").submit(function(event){

		if(jQuery('input[type=file]').val())
		{
			var file_error = 0;
			jQuery('input[type=file]').each(function (){file_error+=validateFile(this);})
			if(file_error>0)
			{	
				alert("Wrong Type")
        		event.preventDefault();
			}
		}

    }); 



var MauticForm_<?php echo $formName; ?> = {

    formId: "mauticform_<?php echo $formName; ?>",

    validateForm: function () {

        var formValid = true;



        function validateOptions(elOptions) {

            var optionsValid = false;

            var i = 0;

            while (!optionsValid && i < elOptions.length) {

                if (elOptions[i].checked) optionsValid = true;

                i++;

            }

            return optionsValid;

        }

		

		 function validateEmail(email) {

            var atpos = email.indexOf("@");

            var dotpos = email.lastIndexOf(".");

            var valid = (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) ? false : true;

            return valid;

        }


        function markError(containerId, valid) {

            var elContainer = document.getElementById(containerId);

            var elErrorSpan = elContainer.querySelector('.mauticform-errormsg');

            elErrorSpan.style.display = (valid) ? 'none' : '';

        }



        var elForm = document.getElementById(this.formId);

		

        <?php foreach ($fields as $f):

        if ($f->isRequired()):

        $name = "mauticform[".$f->getAlias()."]";

        $id   = 'mauticform_' . $f->getAlias();

        $type = $f->getType();

        switch ($type):

        case 'select':

        case 'country':

            $properties = $f->getProperties();

            $multiple   = $properties['multiple'];

            if ($multiple)

                $name .= '[]';

        ?>

        var valid = (elForm.elements["<?php echo $name; ?>"].value != '');

        <?php

        break;

        case 'radiogrp':

        case 'checkboxgrp':

            if ($type == 'checkboxgrp') $name .= '[]';

        ?>



        var elOptions = elForm.elements["<?php echo $name; ?>"];

        var valid = validateOptions(elOptions);

        <?php

        break;

        case 'email':

        ?>



        var valid = validateEmail(elForm.elements["<?php echo $name; ?>"].value);

        <?php

        break;

        default:

        ?>



        var valid = (elForm.elements["<?php echo $name; ?>"].value != '');

        <?php

        break;

        endswitch;

        ?>

        markError('<?php echo $id; ?>', valid);

        if (!valid) formValid = false;

        <?php

        endif;

        endforeach;

        ?>



        if (formValid) {

            document.getElementById('mauticform_<?php echo $formName ?>_return').value = document.URL;

        }

        return formValid;

    },

    checkMessages: function() {

        var query = {};

        location.search.substr(1).split("&").forEach(function(item) {query[item.split("=")[0]] = item.split("=")[1]});

        if (typeof query.mauticError !== 'undefined') {

            var errorContainer = document.getElementById('mauticform_<?php echo $formName; ?>_error');

            errorContainer.innerHTML = decodeURIComponent(query.mauticError);

        } else if (typeof query.mauticMessage !== 'undefined') {

            var messageContainer = document.getElementById('mauticform_<?php echo $formName; ?>_message');

            messageContainer.innerHTML = decodeURIComponent(query.mauticMessage);

        }

    }

}

MauticForm_<?php echo $formName; ?>.checkMessages();
</script>