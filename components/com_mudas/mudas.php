<?php

defined('_JEXEC') or die;

$controller = JControllerLegacy::getInstance('Mudas');
$controller->execute(JRequest::getVar('task', 'click'));
$controller->redirect();
