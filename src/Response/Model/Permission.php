<?php

namespace Stelin\Response\Model;

/**
 * Permission Class
 *
 * Parsing permission key
 */
class Permission
{
    private $permission = [];
    private $childMenu = [];

    public function __construct($decoded)
    {
        foreach ($decoded as $key => $value) {
            $this->_parseChildMenu($value->childMenu);
            $menuName = $value->menuName;
            $this->permission[$menuName] = [
                'id'        => $value->id,
                'isEnabled' => $value->isEnabled,
                'state'     => $value->state,
                'childMenu' => $value->childMenu
            ];
        }
    }

    /**
     * Get menu name by menu name
     *
     * @param  string $menuName
     * @return array
     */
    public function getMenuNamePermission($menuName)
    {
        return $this->permission[$menuName];
    }

    /**
     * Get menu name value
     *
     * @return array
     */
    public function getMenuName()
    {
        return array_keys($this->permission);
    }

    private function _parseChildMenu($parentChildMenu)
    {
        foreach ($parentChildMenu as $key => $value) {
            array_push($this->childMenu, $value->menuName);
        }
    }

    /**
     * Get All Child Menu
     *
     * @return array
     */
    public function getAllChildMenu()
    {
        return $this->childMenu;
    }
}
