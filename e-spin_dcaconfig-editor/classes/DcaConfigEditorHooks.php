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

namespace DcaConfigEditor;

/**
 * Class DcaConfigEditorHooks
 *
 * Provide methods to handle hooks.
 */
class DcaConfigEditorHooks
{

    /**
     * Remove the
     * @param array
     * @return array
     */
    public function getUserNavigation($arrModules)
    {
        if (!\BackendUser::getInstance()->isAdmin) {
            unset($arrModules['system']['modules']['dcaconfig_editor']);
        }

        return $arrModules;
    }
}
