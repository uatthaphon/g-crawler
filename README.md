# g-crawler
A simple php Web Scraper that wrap up Guzzle and DomCrawler

## Installation

Add package dependency to your project

```bash
composer require uatthaphon/g-crawler
```

## Usage

**In your PHP project**

Once GCrawler is included in your project you may add it to any class by simply init.

```php
use GCrawler\GCrawler;


class Example {
    protected $_gCrawler;
    
    public function __construct()
    {
            $this->_gCrawler = new GCrawler($config);
    }
    
    public function run()
    {
            $crawler = $_gCrawler->crawler('https://www.example.com/');
            $text = $crawler->filter('div.here')
                ->each(function ($node) {
                        return $node->text();
                };
                
            return $text;
    }
    
```

Or init with config

```php
use GCrawler\GCrawler;


class Example {
    protected $_gCrawler;
    
    public function __construct()
    {
            $config = [
                'headers' => [
                    'User-Agent' => 'testing/1.0',
                    'Accept' => 'application/json',
                    'X-Foo' => ['Bar', 'Baz'],
                ]
            ];
            $this->_gCrawler = new GCrawler($config);
    }
    
    public function run()
    {
            $crawler = $_gCrawler->crawler('https://www.example.com/');
            $text = $crawler->filter('div.here')
                ->each(function ($node) {
                        return $node->text();
                };
                
            return $text;
    }
    
```

## License

g-crawler is released under the MIT License.
