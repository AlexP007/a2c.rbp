<?php


namespace A2C\RBP\Component;


use CComponentEngine;

/**
 * Class complex
 * @package A2C\RBP\Component
 *
 * @license MIT
 *
 * @author AlexP007
 * @email alex.p.panteleev@gmail.com
 * @link https://github.com/AlexP007/a2c.rbp
 */
abstract class Complex extends Basic
{
    abstract protected function arDefaultUrlTemplates404(): array;

    abstract protected function arComponentVariables(): array;

    protected function InitComponentVariables(): array
    {

        $arParams = $this->arParams;

        $arDefaultUrlTemplates404 = $this->arDefaultUrlTemplates404();
        $arDefaultVariableAliases404 = [];

        $arComponentVariables = $this->arComponentVariables();
        $arDefaultVariableAliases = [];

        $SEF_FOLDER = '';
        $arUrlTemplates = [];
        $arVariables = [];
        $arVariableAliases = [];
        $componentPage = 'iblock';

        if ($arParams['SEF_MODE'] == 'Y') {
            $arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates(
                $arDefaultUrlTemplates404,
                $arParams['SEF_URL_TEMPLATES']
            );

            $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
                $arDefaultVariableAliases404,
                $arParams['VARIABLE_ALIASES']
            );

            if ($page = CComponentEngine::ParseComponentPath(
                $arParams['SEF_FOLDER'],
                $arUrlTemplates,
                $arVariables
            )) {
                $componentPage = $page;
            }

            CComponentEngine::InitComponentVariables(
                $componentPage,
                $arComponentVariables,
                $arVariableAliases,
                $arVariables);

            $SEF_FOLDER = $arParams['SEF_FOLDER'];
        } else {
            $arVariableAliases = CComponentEngine::MakeComponentVariableAliases(
                $arDefaultVariableAliases,
                $arParams['VARIABLE_ALIASES']
            );

            CComponentEngine::InitComponentVariables(
                false,
                $arComponentVariables,
                $arVariableAliases,
                $arVariables
            );

            if (intval($arVariables['ELEMENT_ID']) > 0) {
                $componentPage = 'detail';
            } else {
                $componentPage = 'section';
            }
        }

        return [
            'SEF_FOLDER' => $SEF_FOLDER,
            'TEMPLATES' => $arUrlTemplates,
            'VARIABLES' => $arVariables,
            'VARIABLE_ALIASES' => $arVariableAliases,
            'PAGE' => $componentPage,
        ];
    }
}
