<?php

namespace Stormpath\Resource;

use Stormpath\Resource\AbstractResource;
use Stormpath\Service\StormpathService;
use Stormpath\Collections\ResourceCollection;
use Zend\Http\Client;
use Zend\Json\Json;

class Account extends AbstractResource
{
    protected $_url = 'https://api.stormpath.com/v1/accounts';

    protected $username;
    protected $email;
    protected $password;
    protected $givenName;
    protected $middleName;
    protected $surname;
    protected $status;
    protected $groups;
    protected $directory;
    protected $tenant;

    public function getUsername()
    {
        $this->_load();
        return $this->username;
    }

    public function setUsername($value)
    {
        $this->_load();
        $this->username = $value;
        return $this;
    }

    public function getEmail()
    {
        $this->_load();
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->_load();
        $this->email = $value;
        return $this;
    }

    public function getPassword()
    {
        $this->_load();
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->_load();
        $this->password = $value;
        return $this;
    }

    public function getGivenName()
    {
        $this->_load();
        return $this->givenName;
    }

    public function setGivenName($value)
    {
        $this->_load();
        $this->givenName = $value;
        return $this;
    }

    public function getMiddleName()
    {
        $this->_load();
        return $this->middleName;
    }

    public function setMiddleName($value)
    {
        $this->_load();
        $this->middleName = $value;
        return $this;
    }

    public function getSurname()
    {
        $this->_load();
        return $this->surname;
    }

    public function setSurname($value)
    {
        $this->_load();
        $this->surname = $value;
        return $this;
    }

    public function getStatus()
    {
        $this->_load();
        return $this->status;
    }

    public function setStatus($value)
    {
        $this->_load();
        $this->status = $value;
        return $this;
    }

    public function setGroups(ResourceCollection $value)
    {
        $this->_load();
        $this->groups = $value;
        return $this;
    }

    public function getGroups()
    {
        $this->_load();
        return $this->groups;
    }

    public function setDirectory(Directory $value)
    {
        $this->_load();
        $this->directory = $value;
        return $this;
    }

    public function getDirectory()
    {
        $this->_load();
        return $this->directory;
    }

    public function setTenant(Tenant $value)
    {
        $this->_load();
        $this->tenant = $value;
        return $this;
    }

    public function getTenant()
    {
        $this->_load();
        return $this->tenant;
    }

    public function exchangeArray($data)
    {
        $this->setHref(isset($data['href']) ? $data['href']: null);
        $this->setUsername(isset($data['username']) ? $data['username']: null);
        $this->setEmail(isset($data['email']) ? $data['email']: null);
        $this->setPassword(isset($data['password']) ? $data['password']: null);
        $this->setGivenName(isset($data['givenName']) ? $data['givenName']: null);
        $this->setMiddleName(isset($data['middleName']) ? $data['middleName']: null);
        $this->setSurname(isset($data['surname']) ? $data['surname']: null);
        $this->setStatus(isset($data['status']) ? $data['status']: null);

        $this->setGroups(new ResourceCollection($this->getResourceManager(), 'Stormpath\Resource\Group', $data['groups']['href']));

        $directory = new \Stormpath\Resource\Directory;
        $directory->_lazy($this->getResourceManager(), substr($data['directory']['href'], strrpos($data['directory']['href'], '/') + 1));
        $this->setDirectory($directory);

        $tenant = new \Stormpath\Resource\Tenant;
        $tenant->_lazy($this->getResourceManager(), substr($data['tenant']['href'], strrpos($data['tenant']['href'], '/') + 1));
        $this->setTenant($tenant);
    }

    public function getArrayCopy()
    {
        $this->_load();

        return array(
            'href' => $this->getHref(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'givenName' => $this->getGivenName(),
            'middleName' => $this->getMiddleName(),
            'surname' => $this->getSurname(),
            'status' => $this->getStatus(),
        );
    }
}
