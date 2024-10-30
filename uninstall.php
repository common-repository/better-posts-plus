<?php

/*
 * Trigger this file when plugin uninstall
 */


// Check if called from good place:

if (!defined('WP_UNINSTALL_PLUGIN'))
    die();

delete_option('rp-aimweb');