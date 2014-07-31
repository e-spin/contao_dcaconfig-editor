<?php

/**
 * e-spin_dcaconfig-editor extension for Contao Open Source CMS
 *
 * Copyright (C) 2014 e-spin
 *
 * @package e-spin_dcaconfig-editor
 * @author  e-spin <http://e-spin.de>
 * @author  Ingolf Steinhardt <contao@e-spin.de> 
 * @author  Codefog <http://codefog.pl>
 * @author  Kamil Kuzminski <kamil.kuzminski@codefog.pl>
 * @license CC by-nc-sa
 */

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['system'], 3, array
(
    'e-spin_dcaconfig-editor' => array
    (
        'callback' => 'DcaConfigEditor\ModuleDcaConfigEditor',
        'icon'     => 'system/themes/default/images/editor.gif'
    )
));

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getUserNavigation'][] = array('DcaConfigEditor\DcaConfigEditorHooks', 'getUserNavigation');
