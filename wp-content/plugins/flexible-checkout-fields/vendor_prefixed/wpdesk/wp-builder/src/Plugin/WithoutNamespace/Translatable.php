<?php

namespace FcfVendor;

if (!\interface_exists('FcfVendor\\WPDesk_Translable')) {
    require_once 'Translable.php';
}
interface WPDesk_Translatable extends \FcfVendor\WPDesk_Translable
{
    /** @return string */
    public function get_text_domain();
}
