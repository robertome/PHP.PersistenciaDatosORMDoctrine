<?php
/**
 * PHP version 7.2
 * tests/Entity/ResultTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;

/**
 * Class ResultTest
 *
 * @package MiW\Results\Tests\Entity
 */
class ResultTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var User $user
     */
    private $user;
    private $user2;

    /**
     * @var Result $result
     */
    private $result;
    private $result2;

    private const USERNAME = 'uSeR ñ¿?Ñ';
    private const POINTS = 2018;
    private const POINTS2 = 0;

    /**
     * @var \DateTime $time
     */
    private $time;
    private $time2;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->time = new \DateTime('now');
        $this->time2 = new \DateTime('now');
        $this->user = new User();
        $this->user->setUsername(self::USERNAME);
        $this->result = new Result(
            self::POINTS,
            $this->user,
            $this->time
        );
    }

    /**
     * Implement testConstructor
     *
     * @covers \MiW\Results\Entity\Result::__construct()
     * @covers \MiW\Results\Entity\Result::getId()
     * @covers \MiW\Results\Entity\Result::getResult()
     * @covers \MiW\Results\Entity\Result::getUser()
     * @covers \MiW\Results\Entity\Result::getTime()
     *
     * @return void
     */
    public function testConstructor(): void
    {
        self::assertEquals($this->user, $this->result->getUser());
        self::assertEquals(self::POINTS, $this->result->getResult());
        self::assertEquals($this->time, $this->result->getTime());
    }

    /**
     * Implement testGet_Id().
     *
     * @covers \MiW\Results\Entity\Result::getId()
     * @return void
     */
    public function testGetId(): void
    {
        self::assertEquals(0, $this->result->getId());
    }

    /**
     * Implement testUsername().
     *
     * @covers \MiW\Results\Entity\Result::setResult
     * @covers \MiW\Results\Entity\Result::getResult
     * @return void
     */
    public function testResult(): void
    {
        $this->result->setResult(self::POINTS2);
        self::assertEquals(self::POINTS2, $this->result->getResult());
    }

    /**
     * Implement testTime().
     *
     * @covers \MiW\Results\Entity\Result::setTime
     * @covers \MiW\Results\Entity\Result::getTime
     * @return void
     */
    public function testTime(): void
    {
        $this->result->setTime($this->time2);
        self::assertEquals($this->time2, $this->result->getTime());
    }

    /**
     * Implement testTo_String().
     *
     * @covers \MiW\Results\Entity\Result::__toString
     * @return void
     */
    public function testToString(): void
    {
        $toString = sprintf(
            'id: %3d result: %3d username: %3d time: %s ',
            $this->result->getId(),
            $this->result->getResult(),
            $this->result->getUser()->getUsername(),
            $this->result->getTimeFormatted()
        );

        self::assertEquals($this->result->__toString(), $toString);
    }

    /**
     * Implement testJson_Serialize().
     *
     * @covers \MiW\Results\Entity\Result::jsonSerialize
     * @return void
     */
    public function testJsonSerialize(): void
    {
        $jsonSerialize = array(
            'id' => $this->result->getId(),
            'result' => $this->result->getResult(),
            'time' => $this->result->getTimeFormatted(),
            'user' => $this->result->getUser()
        );

        self::assertEquals($this->result->jsonSerialize(), $jsonSerialize);
    }
}
