<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_muda
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

$app = JFactory::getApplication();
$assoc = JLanguageAssociations::isEnabled();

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_mudas/assets/css/muda.css');
$document->addScript('components/com_mudas/assets/js/jquery.maskcpfcnpj.js');
?>
<script type="text/javascript">
    Joomla.submitbutton = function (task)
    {
        if (task == 'muda.cancel' || document.formvalidator.isValid(document.id('muda-form')))
        {
            Joomla.submitform(task, document.getElementById('muda-form'));
        }
    }
</script>
<script type="text/javascript">
    jQuery.noConflict();
    jQuery(function (cep) {
        jQuery("#jform_cep").mask("99.999-999");
    });
</script>
<form action="<?php echo JRoute::_('index.php?option=com_mudas&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="muda-form" class="form-validate">

    <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
    <div class="form-personalizado">
        <div class="form-horizontal">
            <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>

            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', empty($this->item->id) ? JText::_('COM_muda_NEW_muda', true) : JText::_('COM_muda_EDIT_muda', true)); ?>
            <div class="row-fluid">
                <div class="span9">
                    <div class="row-fluid form-horizontal-desktop">
                        <div class="span6">
                            <?php echo $this->form->renderField('tipo'); ?>
                            <?php echo $this->form->renderField('idalbum'); ?>
                            <?php echo $this->form->renderField('destaque'); ?>
                            <?php echo $this->form->renderField('endereco'); ?>
                            <?php echo $this->form->renderField('complemento'); ?>
                            <?php echo $this->form->renderField('idbairro'); ?>
                            <?php echo $this->form->renderField('idcidade'); ?>
                            <?php echo $this->form->renderField('cep'); ?>
                            <?php echo $this->form->renderField('latitude'); ?>
                            <?php echo $this->form->renderField('longitude'); ?>
                            <?php echo $this->form->renderField('valor'); ?>
                            <?php echo $this->form->renderField('fase'); ?>
                            <?php echo $this->form->renderField('percent_vendido'); ?>
                            <?php echo $this->form->renderField('projeto'); ?>
                            <?php echo $this->form->renderField('fundacao'); ?>
                            <?php echo $this->form->renderField('estrutura'); ?>
                            <?php echo $this->form->renderField('alvenaria'); ?>
                            <?php echo $this->form->renderField('instalacoes'); ?>
                            <?php echo $this->form->renderField('acabamento'); ?>                            
                            <?php echo $this->form->renderField('documentacao'); ?>
                            <?php echo $this->form->renderField('habitese'); ?>
                            <?php echo $this->form->renderField('descricao'); ?>                                                
                        </div>
                    </div>
                </div>
                <div class="span3">
                    <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                </div>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>



            <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('JGLOBAL_FIELDSET_PUBLISHING', true)); ?>
            <div class="row-fluid form-horizontal-desktop">
                <div class="span6">
                    <?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
                </div>
                <div class="span6">
                    <?php echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
                </div>
            </div>
            <?php echo JHtml::_('bootstrap.endTab'); ?>



            <?php if ($assoc) : ?>
                <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'associations', JText::_('JGLOBAL_FIELDSET_ASSOCIATIONS', true)); ?>
                <?php echo $this->loadTemplate('associations'); ?>
                <?php echo JHtml::_('bootstrap.endTab'); ?>
            <?php endif; ?>

            <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        </div>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>
