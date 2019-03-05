<?php

namespace Stelin\Response;

class NotificationAllResponse
{
    private $notifications;

    public function __construct($decoded)
    {
        $this->notifications = $decoded->notifications;
    }
    
    /**
     * get all notif
     *
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

}
