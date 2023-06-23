<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Language\Text;

class plgUserRestrictUsername extends CMSPlugin
{
    public function onUserBeforeSave($user, $isnew, $new)
    {
        $username = $new['username'];

        // Add your restriction logic here
        if ($this->isRestrictedUsername($username)) {
            $this->displayErrorMessage('Invalid username. Please choose another one.');
            return false; // Prevent user from being saved
        }

        return true; // Allow user to be saved
    }

    private function isRestrictedUsername($username)
    {
        // Add your restriction logic here
        // Return true if the username is restricted, false otherwise
        // For example:
        if (preg_match('/[A-Z]/', $username)) {
            // Contains a capitalized letter
            return true;
        }

        if (preg_match('/[^a-zA-Z0-9@.]/', $username)) {
            // Contains a special character
            return true;
        }

        return false;
    }

    private function displayErrorMessage($message)
    {
        Factory::getApplication()->enqueueMessage(Text::_($message), 'error');
    }
}
