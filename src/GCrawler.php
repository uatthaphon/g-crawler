<?php

/*
 * This file is part of GCrawler.
 *
 * (c) Atthaphon Urairat <u.atthaphon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GCrawler;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * This is the GCrawler class.
 *
 * @author Atthaphon Urairat <u.atthaphon@gmail.com>
 */
class GCrawler implements GCrawlerInterface
{
    /**
     * The Guzzle client instance
     * @var GuzzleHttp\Client
     */
    protected $client;

    /**
     * Guzzle Client default request options
     * @var array
     */
    protected $config;

    /**
     * The Dom Crawler instance
     * @var Symfony\Component\DomCrawler\Crawler
     */
    protected $crawler;

    public function __construct($config = [])
    {
        $this->client = new Client($config);
        $this->config = $config;
    }

    public function __call($method, $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException('Magic request methods require a URI and optional options array');
        }

        $uri = $args[0];
        $opts = isset($args[1]) ? $args[1] : [];

        return substr($method, -5) === 'Async'
            ? $this->client->requestAsync(substr($method, 0, -5), $uri, $opts)
            : $this->client->request($method, $uri, $opts);
    }

    public function crawler($arg)
    {
        $content = '';

        if (filter_var($arg, FILTER_VALIDATE_URL)) {
            $response = $this->get($arg);
            $content = $response->getBody()->getContents();
        } else {
            $content = $arg;
        }

        return new Crawler($content);
    }
}
