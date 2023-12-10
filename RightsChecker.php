<?php

namespace YaleREDCap\ApiUserRights;

class RightsChecker
{
    private ApiUserRights $module;
    private string $username;
    private array $methods;
    private array $rightsToCheck;
    public $badMethods = [];
    public $goodUsers = [];
    public $goodMethods = [];
    public $badUsers = [];
    public $errorMessages = [];
    private $valid = true;
    private int $projectId;
    private bool $default;
    public function __construct(ApiUserRights $module, string $username, array $rightsToCheck, $projectId = null, $default = false)
    {
        $this->module        = $module;
        $this->username      = $username;
        $this->rightsToCheck = $rightsToCheck;
        $this->projectId     = (int) ($projectId ?? $module->framework->getProject()->getProjectId());
        $this->methods       = $this->module->getTableHeader()['methodOrder'];
        $this->default       = $default;
    }

    private function verifyMethods()
    {
        foreach ( $this->rightsToCheck as $method => $value ) {
            if ( !in_array($method, $this->methods, true) ) {
                $this->badMethods[] = $this->module->framework->escape($method);
                $this->valid        = false;
            } elseif ( in_array($method, $this->goodMethods, true) ) {
                $this->errorMessages[] = 'Duplicate method: ' . $this->module->framework->escape($method);
                $this->valid           = false;
            } else {
                $this->goodMethods[] = $method;
            }
        }
    }

    private function verifyValues()
    {
        foreach ( $this->rightsToCheck as $method => $value ) {
            $intValue = (int) $value;
            if ( !in_array($intValue, [ 0, 1 ], true) ) {
                $this->errorMessages[] = 'Invalid value for ' . $method . ': ' . $this->module->framework->escape($value);
                $this->valid           = false;
            }
        }
    }

    private function checkUsername()
    {
        $username = trim($this->username);
        if ( empty($username) ) {
            $this->valid      = false;
            $this->badUsers[] = $this->module->framework->escape($username);
        } elseif ( in_array($username, $this->goodUsers, true) ) {
            $this->errorMessages[] = 'Duplicate username: ' . $this->module->framework->escape($username);
            $this->valid           = false;
        } else {
            $this->goodUsers[] = $username;
        }

        return $username;
    }

    private function checkUser($username)
    {
        $user       = $this->module->framework->getUser($username);
        $userRights = $user->getRights();
        if ( is_null($userRights) ) {
            $this->badUsers[] = $this->module->framework->escape($username);
            $this->valid      = false;
        }
    }

    public function isValid()
    {
        $this->valid = true;

        // Check user
        if ( !$this->default ) {
            $thisUsername = $this->checkUsername();
            $this->checkUser($thisUsername);
        }

        // Check methods
        $this->verifyMethods();

        // Check values
        $this->verifyValues();

        if ( !empty($this->badUsers) ) {
            $this->errorMessages[] = 'Invalid username';
            $this->valid           = false;
        }

        if ( !empty($this->badMethods) ) {
            $this->errorMessages[] = 'Invalid API methods';
            $this->valid           = false;
        }

        $this->errorMessages = array_values(array_unique($this->errorMessages));
        return $this->valid;
    }

    public function getErrorMessages()
    {
        return $this->errorMessages;
    }
}