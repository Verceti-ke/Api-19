<?php
/**
 * Author: Daniel Mason
 * Package: Api
 */

namespace AyeAye\Api\Tests;


use AyeAye\Api\Status;

class StatusTest extends TestCase
{

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage Status '9001' does not exist
     */
    public function testInvalidStatusCode()
    {
        new Status(9001);
    }

//    /**
//     * @expectedException        \Exception
//     * @expectedExceptionMessage Status '9001' does not exist
//     */
//    public function testInvalidMessageCode()
//    {
//        Status::getMessageForCode(9001);
//    }

    public function testGetCode()
    {
        $status = new Status();
        $this->assertSame(
            200,
            $status->getCode()
        );

        $status = new Status(500);
        $this->assertSame(
            500,
            $status->getCode()
        );
    }

    public function testGetMessage()
    {
        $status = new Status();
        $this->assertSame(
            'OK',
            $status->getMessage()
        );

        $status = new Status(500);
        $this->assertSame(
            'Internal Server Error',
            $status->getMessage()
        );
    }

    public function testGetMessageForCode()
    {

        $this->assertSame(
            'OK',
            Status::getMessageForCode(200)
        );

        $this->assertSame(
            'Internal Server Error',
            Status::getMessageForCode(500)
        );
    }

    public function testGetHttpHeader()
    {
        $status = new Status();
        $this->assertSame(
            'HTTP/1.1 200 OK',
            $status->getHttpHeader()
        );

        $status = new Status(500);
        $this->assertSame(
            'HTTP/1.1 500 Internal Server Error',
            $status->getHttpHeader()
        );
    }

    public function testJsonSerialize()
    {
        $status = new Status();
        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'code' => 200,
                'message' => 'OK',
            ]),
            json_encode($status)
        );

        $status = new Status(500);
        $this->assertSame(
            json_encode([
                'code' => 500,
                'message' => 'Internal Server Error',
            ]),
            json_encode($status)
        );
    }
}