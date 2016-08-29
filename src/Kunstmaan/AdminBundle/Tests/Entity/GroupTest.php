<?php

namespace Kunstmaan\AdminBundle\Tests\Entity;

use Kunstmaan\AdminBundle\Entity\Group;

use Kunstmaan\AdminBundle\Entity\Role;
use Symfony\Component\Validator\Validation;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-08-28 at 17:50:57.
 */
class GroupTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Group
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Group('group');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::getId
     */
    public function testGetId()
    {
        $this->assertEquals(null, $this->object->getId());
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::__toString
     */
    public function test__toString()
    {
        $this->assertEquals('group', $this->object->__toString());
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::getRoles
     */
    public function testGetRoles()
    {
        /* @var $role Role */
        $role = $this->getRole();
        $this->object->addRole($role);

        $this->assertEquals(array('role1'), $this->object->getRoles());
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::getRolesCollection
     */
    public function testGetRolesCollection()
    {
        /* @var $role Role */
        $role = $this->getRole();
        $this->object->addRole($role);

        $collection = new \Doctrine\Common\Collections\ArrayCollection();
        $collection->add($role);

        $this->assertEquals($collection, $this->object->getRolesCollection());
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::getRole
     */
    public function testGetRole()
    {
        /* @var $role Role */
        $role = $this->getRole();
        $this->object->addRole($role);

        $result = $this->object->getRole('role1');
        $this->assertEquals($role, $result);

        $result = $this->object->getRole('role2');
        $this->assertEquals(null, $result);
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::hasRole
     */
    public function testHasRole()
    {
        /* @var $role Role */
        $role = $this->getRole();
        $this->object->addRole($role);

        $this->assertTrue($this->object->hasRole('role1'));
        $this->assertFalse($this->object->hasRole('role2'));
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::addRole
     * @covers Kunstmaan\AdminBundle\Entity\Group::removeRole
     */
    public function testRemoveRole()
    {
        /* @var $role Role */
        $role = $this->getRole();
        $this->object->addRole($role);
        $this->assertTrue($this->object->hasRole('role1'));

        $this->object->removeRole('role1');
        $this->assertFalse($this->object->hasRole('role1'));
    }

    /**
     * @expectedException \InvalidArgumentException
     * @covers Kunstmaan\AdminBundle\Entity\Group::addRole
     */
    public function testAddRoleWithInvalidParameter()
    {
        /* @var $role Role */
        $role = new \StdClass();
        $this->object->addRole($role);
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::setRoles
     */
    public function testSetRoles()
    {
        $role1 = $this->getRole('role1');
        $role2 = $this->getRole('role2');
        $role3 = $this->getRole('role3');
        $roles = array($role1, $role2, $role3);
        $this->object->setRoles($roles);

        $this->assertEquals(3, count($this->object->getRoles()));
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::setRolesCollection
     */
    public function testSetRolesCollection()
    {
        $role1 = $this->getRole('role1');
        $role2 = $this->getRole('role2');
        $role3 = $this->getRole('role3');

        $roles = new \Doctrine\Common\Collections\ArrayCollection();
        $roles->add($role1);
        $roles->add($role2);
        $roles->add($role3);

        $this->object->setRolesCollection($roles);
        $this->assertEquals(3, $this->object->getRolesCollection()->count());
    }

    /**
     * @covers Kunstmaan\AdminBundle\Entity\Group::__construct
     * @covers Kunstmaan\AdminBundle\Entity\Group::getName
     * @covers Kunstmaan\AdminBundle\Entity\Group::setName
     */
    public function testConstructorAndGetSetName()
    {
        $object = new Group('testgroup');
        $this->assertEquals('testgroup', $object->getName());

        $object->setName('group2');
        $this->assertEquals('group2', $object->getName());
    }

    public function testValidateGroupWithoutRole()
    {
        $group = new Group('test');

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $violations = $validator->validate($group);

        $this->assertCount(1, $violations);
    }

    public function testValidateGroupWithRole()
    {
        $group = new Group('test');
        $group->addRole(new Role('role'));

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $violations = $validator->validate($group);

        $this->assertCount(0, $violations);
    }

    /**
     * @param string $name
     *
     * @return \Kunstmaan\AdminBundle\Entity\Role
     */
    protected function getRole($name = 'role1')
    {
        $role = $this->getMockBuilder('Kunstmaan\AdminBundle\Entity\Role')
            ->disableOriginalConstructor()
            ->getMock();
        $role->expects($this->any())
            ->method('getRole')
            ->will($this->returnValue($name));

        return $role;
    }
}
