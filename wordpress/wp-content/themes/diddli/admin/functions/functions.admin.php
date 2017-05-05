<?php

function of_head() { do_action( 'of_head' ); }


function of_option_setup()	
{
	global $of_options, $options_machine;
	$options_machine = new Options_Machine($of_options);
		
	if (!of_get_options())
	{
		of_save_options($options_machine->Defaults);
	}
}


function optionsframework_admin_message() { 
	
		?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p>This theme comes with an <a href="<?php echo admin_url('admin.php?page=optionsframework'); ?>">options panel</a> to configure settings. This theme also supports widgets, please visit the <a href="<?php echo admin_url('widgets.php'); ?>">widgets settings page</a> to configure them.</p>';
    	jQuery('.themes-php #message2').html(message);
    
    });
    </script>
    <?php
	
}


function of_get_header_classes_array() 
{
	global $of_options;
	
	foreach ($of_options as $value) 
	{
		if ($value['type'] == 'heading')
			$hooks[] = str_replace(' ','',strtolower($value['name']));	
	}
	
	return $hooks;
}


function of_get_options($key = null, $data = null) {
	global $smof_data;

	do_action('of_get_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	if ($key != null) { 		$data = get_theme_mod($key, $data);
	} else { 		$data = get_theme_mods();	
	}
	$data = apply_filters('of_options_after_load', $data);
	if ($key == null) {
		$smof_data = $data;
	} else {
		$smof_data[$key] = $data;
	}
	do_action('of_option_setup_before', array(
		'key'=>$key, 'data'=>$data
	));
	return $data;

}



function of_save_options($data, $key = null) {
	global $smof_data;
    if (empty($data))
        return;	
    do_action('of_save_options_before', array(
		'key'=>$key, 'data'=>$data
	));
	$data = apply_filters('of_options_before_save', $data);
	if ($key != null) { 		if ($key == BACKUPS) {
			unset($data['smof_init']); 		}
		set_theme_mod($key, $data);
	} else { 		foreach ( $data as $k=>$v ) {
			if (!isset($smof_data[$k]) || $smof_data[$k] != $v) { 				set_theme_mod($k, $v);
			} else if (is_array($v)) {
				foreach ($v as $key=>$val) {
					if ($key != $k && $v[$key] == $val) {
						set_theme_mod($k, $v);
						break;
					}
				}
			}
	  	}
	}
    do_action('of_save_options_after', array(
		'key'=>$key, 'data'=>$data
	));

}
$data = of_get_options();
if (!isset($smof_details))
	$smof_details = array();