<?php

namespace KnpU\CodeBattle\Tests;

use Guzzle\Http\Client;
use PHPUnit_Framework_TestCase;

/**
 *
 * @author Norman
 */
class ProgrammerControllerTest extends PHPUnit_Framework_TestCase
{
    public function testPOST()
    {
        // create our http client (Guzzle)
        $client = new Client('http://rest', array(
            'request.options' => array(
                'exceptions' => false,
            )
        ));

        $nickname = 'ObjectOrienter' . rand(0,999);
        $data = array(
            'nickname' => $nickname,
            'avatarNumber' => 5,
            'tagLine' => 'A test dev!'
        );

        $request = $client->post('/api/programmers', null, json_encode($data));
        $response = $request->send();
        
        $this->assertEquals( 201, $response->getStatusCode() );
        $this->assertTrue( $response->hasHeader('Location') );        
        $data = json_decode($response->getBody(true), true);
        $this->assertArrayHasKey('nickname', $data);
    }
}
