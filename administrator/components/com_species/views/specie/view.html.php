<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_specie
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * View to edit a specie.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_specie
 * @since       1.6
 */
class SpeciesViewSpecie extends JViewLegacy
{
	protected $form;

	protected $item;

	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		// Initialise variables.
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state            = $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		if ($this->getLayout() == 'modal')
		{
			$this->form->setFieldAttribute('language', 'readonly', 'true');
			$this->form->setFieldAttribute('catid', 'readonly', 'true');
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since   1.6
	 */
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);

		// Since we don't track these assets at the item level, use the category id.
		$canDo		= JHelperContent::getActions('com_species', 'category', $this->item->catid);

		JToolbarHelper::title(JText::_('COM_SPECIES_MANAGER_SPECIES'), 'address specie');

		// Build the actions for new and existing records.
		if ($isNew)
		{
			// For new records, check the create permission.
			if ($isNew && (count($user->getAuthorisedCategories('com_species', 'core.create')) > 0))
			{
				JToolbarHelper::apply('specie.apply');
				JToolbarHelper::save('specie.save');
				JToolbarHelper::save2new('specie.save2new');
			}

			JToolbarHelper::cancel('specie.cancel');
		}
		else
		{
			// Can't save the record if it's checked out.
			
				// Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
				if ($canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId))
				{
					JToolbarHelper::apply('specie.apply');
					JToolbarHelper::save('specie.save');

					// We can save this record, but check the create permission to see if we can return to make a new one.
					if ($canDo->get('core.create'))
					{
						JToolbarHelper::save2new('specie.save2new');
					}
				}
			

			// If checked out, we can still save
			if ($canDo->get('core.create'))
			{
				JToolbarHelper::save2copy('specie.save2copy');
			}

			if ($this->state->params->get('save_history', 0) && $user->authorise('core.edit'))
			{
				JToolbarHelper::versions('com_specie.specie', $this->item->id);
			}

			JToolbarHelper::cancel('specie.cancel', 'JTOOLBAR_CLOSE');
		}

		JToolbarHelper::divider();
		JToolbarHelper::help('JHELP_COMPONENTS_SPECIES_SPECIES_EDIT');
	}
}
