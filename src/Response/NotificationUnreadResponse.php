<?php

namespace Stelin\Response;

class NotificationUnreadResponse
{
    private $total = 0;

    public function __construct($data)
    {
        $this->total = $data->total;
    }

    /**
     * Get total unread messages
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}
