<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_mapa_empreendimentos
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';
require_once dirname(__FILE__).'/GoogleMap.php';
require_once dirname(__FILE__).'/JSMin.php';

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base(true) . '/modules/mod_mapa_mudas/assets/css/style_mapa_mudas.css');
$document->addScript(JURI::base(true) . '/modules/mod_mapa_mudas/assets/js/travamapa.js');

$mapa_mudas = modMapa_MudasHelper::getMapa_Mudas();

require JModuleHelper::getLayoutPath('mod_mapa_mudas', $params->get('layout', 'default'));


