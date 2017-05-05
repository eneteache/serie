<?php
function of_filter_save_media_upload($data) {

    if(!is_array($data)) return $data;
    
    foreach ($data as $key => $value) {
        if (is_string($value)) {
            $data[$key] = str_replace(
                array(
                    site_url('', 'http'),
                    site_url('', 'https'),
                ),
                array(
                    '[site_url]',
                    '[site_url_secure]',
                ),
                $value
            );
        }
    }

    return $data;
}
add_filter('of_options_before_save', 'of_filter_save_media_upload');


function of_filter_load_media_upload($data) {
    
    if(!is_array($data)) return $data;

    foreach ($data as $key => $value) {
        if (is_string($value) && preg_match("/\[site_url(_url_secure)?\]/", $value)) {
            $data[$key] = str_replace(
                array(
                    '[site_url]', 
                    '[site_url_secure]',
                ),
                array(
                    site_url('', 'http'),
                    site_url('', 'https'),
                ),
                $value
            );
        }
    }

    return $data;
}
add_filter('of_options_after_load', 'of_filter_load_media_upload');
