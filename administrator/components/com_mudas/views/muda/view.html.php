<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_mudas
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/**
 * View to edit a muda.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_mudas
 * @since       1.6
 */
class mudasViewmuda extends JViewLegacy {

    protected $form;
    protected $item;
    protected $state;

    /**
     * Display the view
     */
    public function display($tpl = null) {
        // Initialise variables.
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));
            return false;
        }

        if ($this->getLayout() == 'modal') {
            $this->form->setFieldAttribute('language', 'readonly', 'true');
        }

        $this->addToolbar();
        parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @since   1.6
     */
    protected function addToolbar() {
        JFactory::getApplication()->input->set('hidemainmenu', true);

        $user = JFactory::getUser();
        $userId = $user->get('id');
        $isNew = ($this->item->id == 0);

        $canDo = mudasHelper::getActions();

        JToolbarHelper::title(JText::_('COM_mudaS_MANAGER_mudaS'), 'address muda');

        // Build the actions for new and existing records.
        if ($isNew) {

            JToolbarHelper::apply('muda.apply');
            JToolbarHelper::save('muda.save');
            JToolbarHelper::save2new('muda.save2new');

            JToolbarHelper::cancel('muda.cancel');
        } else {
            // Can't save the record if it's checked out.
            // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
            if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId)) {
                JToolbarHelper::apply('muda.apply');
                JToolbarHelper::save('muda.save');

                // We can save this record, but check the create permission to see if we can return to make a new one.
                if ($canDo->get('core.create')) {
                    JToolbarHelper::save2new('muda.save2new');
                }
            }


            // If checked out, we can still save
            if ($canDo->get('core.create')) {
                JToolbarHelper::save2copy('muda.save2copy');
            }

            if ($this->state->params->get('save_history', 0) && $user->authorise('core.edit')) {
                JToolbarHelper::versions('com_muda.muda', $this->item->id);
            }

            JToolbarHelper::cancel('muda.cancel', 'JTOOLBAR_CLOSE');
        }

        JToolbarHelper::divider();
        JToolbarHelper::help('JHELP_COMPONENTS_mudaS_mudaS_EDIT');
    }

}
