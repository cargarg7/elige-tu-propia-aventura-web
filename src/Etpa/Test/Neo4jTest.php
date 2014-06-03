<?php

namespace Etpa\Test;

use Everyman\Neo4j\Relationship;

class Neo4jTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function goFromPageWithNoTransitionsToOtherPageShouldThrowAnException()
    {
        $client = new \Everyman\Neo4j\Client('localhost', 7474);
        print_r($client->getServerInfo());

        $page1 = $client->makeNode();
        $page1->setProperty('name', 'Page 1')
            ->setProperty('content', 'Description')
            ->save();

        $page2 = $client->makeNode();
        $page2->setProperty('name', 'Page 2')
            ->setProperty('content', 'Description')
            ->save();

        $page3 = $client->makeNode();
        $page3->setProperty('name', 'Page 3')
            ->setProperty('content', 'Description')
            ->save();

        $page1
            ->relateTo($page3, 'GOES')
            ->setProperty('text', 'Enter the door...')
            ->save();

        $page1
            ->relateTo($page2, 'GOES')
            ->setProperty('text', 'Leave the room...')
            ->save();

        print_r($page1->getRelationships(array(), Relationship::DirectionOut));
    }
}
