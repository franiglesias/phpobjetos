<?php

/**
 * A Domain Model class. It composes Group,
 * which in turn may compose other objects which may compose other ones,
 * to the point that serializing an user involves the entire state of the application.
 *
 * ORMs usually break the reconstitution of the whole object graph by putting
 * lazy-loading proxies on the boundaries of the needed subgraph.
 */
class User 
{
    private $_name;
    private $_groups = array();

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->_role;
    }

    public function setRole($role)
    {
        $this->_role = $role;
    }

    public function addGroup(Group $group)
    {
        $this->_group = $group;
    }

    public function getGroups()
    {
        return $this->_groups;
    }
}

/**
 * Another Domain Model class.
 */
class Group
{
    private $_name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }
}

/**
 * The Data Transfer Object for User.
 * It stores the mandatory data for a particular use case - for example ignoring the groups,
 * and ensuring easy serialization.
 */
class UserDTO
{
    /**
     * In more complex implementations, the population of the DTO can be the responsibilty
     * of an Assembler object, which would also break any dependency between User and UserDTO.
     */
    public function __construct(User $user)
    {
        $this->_name = $user->getName();
        $this->_role = $user->getRole();
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getRole()
    {
        return $this->_role;
    }
    
    // there are no setters because this use cases does not require modification of data
    // however, in general DTOs do not need to be immutable.
}

// client code
$user = new User();
$user->setName('Giorgio');
$user->setRole('Author');
$user->addGroup(new Group('Authors'));
$user->addGroup(new Group('Editors'));
// many more groups
$dto = new UserDTO($user);
// this value is what will be stored in the session, or in a cache...
var_dump(serialize($dto));