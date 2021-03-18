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

class MudasControllerMudas extends JControllerForm {

    public function maisinf() {

        $model = $this->getModel('mudas');
        $params = JComponentHelper::getParams('com_mudas');
        $nome = JRequest::getVar('nome');
        $telefone = JRequest::getVar('tel');
        $email = JRequest::getVar('email');
        $msg = JRequest::getVar('msg');        
        $nomeimovel = JRequest::getVar('nomeimovel');
        $id = JRequest::getInt('id');

        PHP_email::email_maisinf($nome, $telefone, $email, $msg, $nomeimovel, $id);

        return true;
    }

}

class PHP_email extends PHPMailer {

    function email_maisinf($nome, $email, $telefone, $msg, $nomeimovel, $id) {

        $app = JFactory::getApplication();
        $mailfrom = $app->get('mailfrom');
        $fromname = $app->get('fromname');
        $sitename = $app->get('sitename');

        $mail = JFactory::getMailer();
        $mail->addRecipient($mailfrom);
        $mail->setSender(array($mailfrom, $fromname));
        $mail->isHtml();
        $mail->setSubject("Mais Informações sobre o imóvel : $nomeimovel");
        $mail->setBody('<html>
                                            <body>
                                                <table width="55%" align="center">
                                                    <tr>
                                                        <th colspan="2">
                                                            <font size="4" face="Arial" color="#0F0F73">
                                                                Mais Informações - Muda pra Vida<br />
                                                            </font>
                                                         </th>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                            <b>Imóvel Interessado: </b>' . $nomeimovel . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                            <b>Nome: </b>' . $nome . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                            <b>E-mail: </b> ' . $email . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                            <b>Telefone: </b>' . $telefone . '
                                                        </td>
                                                    </tr>
                                                     <tr>
                                                        <td align=left colspan=2>
                                                            <b>Mensagem: </b>' . $msg . '
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align=left colspan=2>
                                                            <b>Data do Envio: </b>' . date("d/m/Y H:i:s ") . '
                                                        </td>
                                  </tr>

                                  <tr>



                                  </tr></table></body></html>');

        $sent = $mail->Send();
        header('Location: index.php/imoveis?view=muda&msg=1&id=' . $id);

        echo '<div class="emailenviado"><h3>Em breve entraremos em contato. Obrigado!</h3><p><a href="#" onClick="history.go(-2)">Voltar</a></p>';
    }

}
