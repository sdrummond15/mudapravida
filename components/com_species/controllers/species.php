<?php
/**
 * @version		$Id: contact.php 21991 2011-08-18 15:43:40Z infograf768 $
 * @package		Joomla.Site
 * @subpackage	Contact
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');
class SpeciesControllerSpecies extends JControllerForm
{
	public function enviarspecies()
	{
		// Check for request forgeries.

		// Initialise variables.
		$model              = $this->getModel('species');
		$params             = JComponentHelper::getParams('com_species');
		$evento             = JRequest::getVar('event');
                $nomesconfimados    = JRequest::getVar('names_confirm');
                $quantidade         = JRequest::getVar('number');
                $telefone           = JRequest::getVar('tel');
                $email              = JRequest::getVar('email');
             PHP_email::email_orcamento($nomesconfimados, $quantidade, $telefone, $email);
	return true;
	}
}
require_once(JPATH_SITE . DIRECTORY_SEPARATOR .'libraries'. DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer.php');
$doc = JFactory::getDocument();
$doc->addStyleSheet('components/com_species/css/stylespecies.css');

class PHP_email extends PHPMailer{

        function email_orcamento($nomesconfimados, $quantidade, $telefone, $email){

                        $app		= JFactory::getApplication();
			//$mailfrom	= 'contato@lumiarcerimonial.com.br';
            $mailfrom	= 'contato@mudapravida.com.br';
			$fromname	= 'Contato Site Muda pra Vida';
			$sitename	= $app->getCfg('sitename');

                        $mail = JFactory::getMailer();
			$mail->addRecipient($mailfrom);
			$mail->addReplyTo(array($email, $nomeconvite));
			$mail->setSender(array($mailfrom, $fromname));
                        $mail->IsHTML();
			$mail->setSubject("Solicitação de Mudas");
			$mail->setBody('<html>
                                            <body>
                                                <table width="55%" align="center">
                                                   
                                                    <tr>
                                                        <td align=left colspan=2>
                                                        <font size="4" face="Verdana" color="#0F0F73">
                                                            <b>Nome do Convite: </b> ' . $nomesconfimados . '
                                                        </font>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                        <font size="4" face="Verdana" color="#0F0F73">
                                                            <b>Quantidade de Convites Individuais: </b> ' . $quantidade . '
                                                        </font>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td align=left colspan=2>
                                                        <font size="4" face="Verdana" color="#0F0F73">
                                                            <b>Telefone: </b>' . $telefone . '
                                                        </font>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                        <font size="4" face="Verdana" color="#0F0F73">
                                                            <b>E-mail:</b> ' . $email . '
                                                        </font>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                        <font size="4" face="Verdana" color="#0F0F73">
                                                            <b>Data do Envio: </b>' . date ("d/m/Y H:i:s ") . '
                                                        </font>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    </tr>
                                                </table>
                                            </body>
                                        </html>');
                       $sent = $mail->Send();
                       echo '<div class="confirm"><h1>Confirma&ccedil;&atilde;o Enviada com Sucesso.</h1><h1>Obrigado!</h1><br /><a href="index.php" rel="pagina inicial Lumiar Cerimonial">Voltar</a></div>';

	}
                
}