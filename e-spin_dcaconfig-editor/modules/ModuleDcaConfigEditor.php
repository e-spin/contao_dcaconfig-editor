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
 * Class ModuleDcaConfigEditor
 *
 * Back end module "dca config editor".
 */
class ModuleDcaConfigEditor extends \BackendModule
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'be_mod_dcaconfigeditor';

    /**
     * Generate module
     */
    protected function compile()
    {
        if (!\BackendUser::getInstance()->isAdmin) {
            $this->log('Not enough permissions to edit the "dcaconfig.php"', __METHOD__, TL_ERROR);
            $this->redirect('contao/main.php?act=error');
        }

        $objFile = new \File('system/config/dcaconfig.php', true);
        $strContent = $objFile->getContent();

        // Process the request
        if (\Input::post('FORM_SUBMIT') == 'tl_files') {

            // Save the file
            if (md5($strContent) != md5(\Input::postRaw('source'))) {
                $objFile->write(\Input::postRaw('source'));
                $objFile->close();
            }

            if (\Input::post('saveNclose'))
            {
                \System::setCookie('BE_PAGE_OFFSET', 0, 0);
                $this->redirect($this->getReferer());
            }

            $this->reload();
        }

        $codeEditor = '';

        // Prepare the code editor
        if ($GLOBALS['TL_CONFIG']['useCE'])
        {
        		if (version_compare(VERSION, '3.4', '>='))
        		{
								$selector = 'ctrl_source';
            		$type = $objFile->extension;
        		}        	
            $this->ceFields = array(array
            (
                'id' => 'ctrl_source',
                'type' => $objFile->extension
            ));

            $this->language = $GLOBALS['TL_LANGUAGE'];

            // Load the code editor configuration
            ob_start();
            include TL_ROOT . '/system/config/ace.php';
            $codeEditor = ob_get_contents();
            ob_end_clean();
        }

        \System::loadLanguageFile('tl_files');

        $this->Template->referer = array
        (
            'href' => $this->getReferer(true),
            'title' => specialchars($GLOBALS['TL_LANG']['MSC']['backBTTitle']),
            'link' => $GLOBALS['TL_LANG']['MSC']['backBT']
        );

        $this->Template->headline = sprintf($GLOBALS['TL_LANG']['tl_files']['editFile'], $objFile->basename);
        $this->Template->action = ampersand(\Environment::get('request'), true);
        $this->Template->label = $GLOBALS['TL_LANG']['tl_files']['editor'][0];
        $this->Template->description = ($GLOBALS['TL_CONFIG']['showHelp'] && strlen($GLOBALS['TL_LANG']['tl_files']['editor'][1])) ? $GLOBALS['TL_LANG']['tl_files']['editor'][1] : '';
        $this->Template->content = htmlspecialchars($strContent);
        $this->Template->save = specialchars($GLOBALS['TL_LANG']['MSC']['save']);
        $this->Template->saveNclose = specialchars($GLOBALS['TL_LANG']['MSC']['saveNclose']);
        $this->Template->codeEditor = $codeEditor;
    }
}
