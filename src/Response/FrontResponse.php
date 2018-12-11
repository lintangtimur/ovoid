<?php

namespace Stelin\Response;

class FrontResponse
{
    /**
     * Balance Model
     *
     * @var \Stelin\Response\Model\Balance
     */
    private $balance;

    /**
     * Permission Model
     *
     * @var \Stelin\Response\Model\Permission
     */
    private $permission;

    /**
     * Pofile Model
     *
     * @var \Stelin\Response\Model\Profile
     */
    private $profile;

    public function __construct($data)
    {
        $this->balance = new \Stelin\Response\Model\Balance($data->balance);
        $this->permission = new \Stelin\Response\Model\Permission($data->permissions);
        $this->profile = new \Stelin\Response\Model\Profile($data->profile);
    }

    /**
     * Get balance Model
     *
     * @return \Stelin\Response\Model\Balance
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Get balance Model
     *
     * @return \Stelin\Response\Model\Permission
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Get balance Model
     *
     * @return \Stelin\Response\Model\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
