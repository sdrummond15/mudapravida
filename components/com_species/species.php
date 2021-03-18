<?php
/**
 * @package    Joomla.Tutorials
 * @subpackage Components
 * components/com_hello/hello.php
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_1
 * @license    GNU/GPL
*/
 
// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 

jimport('joomla.application.component.controller');
//Cria uma instancia do objeto
$controller = JControllerLegacy::getInstance('Species');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
