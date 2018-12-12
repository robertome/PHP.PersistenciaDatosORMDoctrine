<?php
/**
 * PHP version 7.2
 * tests/Entity/UserTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends TestCase
{
    const USERNAME = 'username';
    const EMAIL = 'email@upm.es';
    const PASSWORD = 'password';
    const ENABLED = true;
    const NO_ADMIN = false;

    const USERNAME2 = 'username2';
    const EMAIL2 = 'email2@upm.es';
    /**
     * @var User $user
     */
    private $user;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->user = new User(self::USERNAME, self::EMAIL, self::PASSWORD, self::ENABLED, self::NO_ADMIN);
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     */
    public function testConstructor(): void
    {
        self::assertEquals(self::USERNAME, $this->user->getUsername());
        self::assertEquals(self::EMAIL, $this->user->getEmail());
        self::assertTrue($this->user->validatePassword(self::PASSWORD));
        self::assertEquals(self::ENABLED, $this->user->isEnabled());
        self::assertEquals(self::NO_ADMIN, $this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId(): void
    {
        self::assertEquals(0, $this->user->getId());
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername(): void
    {
        $this->user->setUsername(self::USERNAME2);
        self::assertEquals(self::USERNAME2, $this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail(): void
    {
        $this->user->setEmail(self::EMAIL2);
        self::assertEquals(self::EMAIL2, $this->user->getEmail());
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled(): void
    {
        $this->user->setEnabled(false);
        self::assertFalse($this->user->isEnabled());
    }

    /**
     * @covers \MiW\Results\Entity\User::setIsAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin
     */
    public function testIsSetAdmin(): void
    {
        $this->user->setIsAdmin(true);
        self::assertTrue($this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testSetValidatePassword(): void
    {
        self::assertTrue($this->user->validatePassword(self::PASSWORD));
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString(): void
    {
        $toString = 'id: ' . $this->user->getId()
            . ', username: ' . $this->user->getUsername()
            . ', email: ' . $this->user->getEmail()
            . ', enabled: ' . $this->user->isEnabled()
            . ', isAdmin: ' . $this->user->isAdmin();

        self::assertEquals($this->user->__toString(), $toString);
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $jsonSerialize = array(
            'id' => $this->user->getId(),
            'username' => utf8_encode($this->user->getUsername()),
            'email' => utf8_encode($this->user->getEmail()),
            'enabled' => $this->user->isEnabled(),
            'admin' => $this->user->isAdmin()
        );

        self::assertEquals($this->user->jsonSerialize(), $jsonSerialize);
    }
}