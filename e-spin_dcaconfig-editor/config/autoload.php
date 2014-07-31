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
 * Register the namespace
 */
ClassLoader::addNamespace('DcaConfigEditor');

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    'DcaConfigEditor\DcaConfigEditorHooks'  => 'system/modules/e-spin_dcaconfig-editor/classes/DcaConfigEditorHooks.php',
    'DcaConfigEditor\ModuleDcaConfigEditor' => 'system/modules/e-spin_dcaconfig-editor/modules/ModuleDcaConfigEditor.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'be_mod_dcaconfigeditor' => 'system/modules/e-spin_dcaconfig-editor/templates/backend',
));
