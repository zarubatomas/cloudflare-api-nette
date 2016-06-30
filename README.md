# Cloudflare API for Nette

[![Build Status](https://travis-ci.org/zarubatomas/cloudflare-api-nette.svg?branch=master)](https://travis-ci.org/zarubatomas/cloudflare-api-nette)

Implementation of [jamesryanbell/cloudflare](https://github.com/jamesryanbell/cloudflare) for Nette framework.


## Install

```sh
composer require tomaszaruba/cloudflare-api-nette
```

Register extensions in `config.neon`:

```yaml
extensions:
    cloudflare: TomasZaruba\Cloudflare\Nette\DI\CloudflareExtension
```


## Configuration

Example `config.neon` 

```yaml
cloudflare:
    email: email@email.com  # required email - Cloudflare login
    key: apiKey             # required API key - check Cloudflare administration for more information
    defaultCache: true      # optional true/false if true, creates service Cloudflare\Zone\Cache by default
    identifier: something   # optional - other optional configuration available
```


## Example
```php
use TomasZaruba\Cloudflare\Nette\Api;
use Cloudflare\Zone\Cache;

class ExampleClass
{

    
    public function __construct(Api $cloudflareApi, Cache $cloudflareCache){
        $this->cloudflareApi = $cloudflareApi;
        $this->cloudflareCache = $cloudflareCache; // cache autoloads if there is defaultCache: true in config.neon
    }
    
    
    public function exampleCloudflare() {
    
        $dns = new Cloudflare\Zone\Dns($this->cloudflareApi);
        $dns->create('12345678901234567890', 'A', 'name.com', '127.0.0.1', 120);
    
        $this->cloudflareCache->purge_files(
            $this->cloudflareApi->getParameter('identifier'), 
            array($files)
        );
            
    }
}
```
