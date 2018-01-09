<?php

function companyLogo($type='small') {
  return setting('company_logo_' . $type);
}
function getCode($title) {
    $pattern = '/[^0-9a-zA-Z\_]/';
    $title = strtoupper(str_slug($title, '_'));
    $title = preg_replace($pattern, '', $title);
    return $title;
}