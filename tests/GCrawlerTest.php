<?php

/*
 * This file is part of GCrawler.
 *
 * (c) Atthaphon Urairat <u.atthaphon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GCrawler\Tests;

use GCrawler\GCrawler;
use PHPUnit\Framework\TestCase;

/**
 * This is the hashids test class.
 *
 * @author Atthaphon Urairat <u.atthaphon@gmail.com>
 */
class GCrawlerTest extends TestCase
{
    /** @test */
    public function testTest()
    {
        $gc = new GCrawler([]);
        $gc->crawler('https://www.google.com/');
    }

    public function testResponseIsInstanceOfPsr7Response()
    {
        $gc = new GCrawler([]);
        $response = $gc->get('https://www.google.com');

        $this->assertInstanceOf(get_class($response), new \GuzzleHttp\Psr7\Response);
    }

    public function testShouldThrowGuzzleHttpClientExceptionWhenRequestFail()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);

        $gc = new GCrawler([]);
        $gc->get('https://www.google.com/NothingHere');
    }

    /** @test */
    public function testShouldThrowInvalidArgumentExceptionWhenMagicMethodCallWithOutArgs()
    {
        $this->expectException(\InvalidArgumentException::class);

        $gc = new GCrawler([]);
        $gc->get();
    }
}
