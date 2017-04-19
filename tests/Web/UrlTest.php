<?php

namespace ValueObjects\Tests\Web;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Tests\TestCase;
use ValueObjects\Web\FragmentIdentifier;
use ValueObjects\Web\NullPortNumber;
use ValueObjects\Web\Path;
use ValueObjects\Web\PortNumber;
use ValueObjects\Web\QueryString;
use ValueObjects\Web\SchemeName;
use ValueObjects\Web\Url;
use ValueObjects\Web\Hostname;

class UrlTest extends TestCase
{
    /** @var Url */
    protected $url;

    public function setup()
    {
        $this->url = new Url(
            new SchemeName('http'),
            new StringLiteral('user'),
            new StringLiteral('pass'),
            new Hostname('foo.com'),
            new PortNumber(80),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );
    }

    public function testFromNative()
    {
        $nativeUrlString = 'http://user:pass@foo.com:80/bar?querystring#fragmentidentifier';
        $fromNativeUrl   = Url::fromNative($nativeUrlString);

        $this->assertTrue($this->url->sameValueAs($fromNativeUrl));

        $nativeUrlString = 'http://www.test.com';
        $fromNativeUrl   = Url::fromNative($nativeUrlString);

        $this->assertSame($nativeUrlString, $fromNativeUrl->__toString());

        $nativeUrlString = 'http://www.test.com/bar';
        $fromNativeUrl   = Url::fromNative($nativeUrlString);

        $this->assertSame($nativeUrlString, $fromNativeUrl->__toString());

        $nativeUrlString = 'http://www.test.com/?querystring';
        $fromNativeUrl   = Url::fromNative($nativeUrlString);

        $this->assertSame($nativeUrlString, $fromNativeUrl->__toString());

        $nativeUrlString = 'http://www.test.com/#fragmentidentifier';
        $fromNativeUrl   = Url::fromNative($nativeUrlString);

        $this->assertSame($nativeUrlString, $fromNativeUrl->__toString());
    }

    public function testSameValueAs()
    {
        $url2 = new Url(
            new SchemeName('http'),
            new StringLiteral('user'),
            new StringLiteral('pass'),
            new Hostname('foo.com'),
            new PortNumber(80),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );

        $url3 = new Url(
            new SchemeName('git+ssh'),
            new StringLiteral(''),
            new StringLiteral(''),
            new Hostname('github.com'),
            new NullPortNumber(),
            new Path('/nicolopignatelli/valueobjects'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );

        $this->assertTrue($this->url->sameValueAs($url2));
        $this->assertTrue($url2->sameValueAs($this->url));
        $this->assertFalse($this->url->sameValueAs($url3));

        $mock = $this->getMock('ValueObjects\ValueObjectInterface');
        $this->assertFalse($this->url->sameValueAs($mock));
    }

    public function testGetDomain()
    {
        $domain = new Hostname('foo.com');
        $this->assertTrue($this->url->getDomain()->sameValueAs($domain));
    }

    public function testGetFragmentIdentifier()
    {
        $fragment = new FragmentIdentifier('#fragmentidentifier');
        $this->assertTrue($this->url->getFragmentIdentifier()->sameValueAs($fragment));
    }

    public function testGetPassword()
    {
        $password = new StringLiteral('pass');
        $this->assertTrue($this->url->getPassword()->sameValueAs($password));
    }

    public function testGetPath()
    {
        $path = new Path('/bar');
        $this->assertTrue($this->url->getPath()->sameValueAs($path));
    }

    public function testGetPort()
    {
        $port = new PortNumber(80);
        $this->assertTrue($this->url->getPort()->sameValueAs($port));
    }

    public function testGetQueryString()
    {
        $queryString = new QueryString('?querystring');
        $this->assertTrue($this->url->getQueryString()->sameValueAs($queryString));
    }

    public function testGetScheme()
    {
        $scheme = new SchemeName('http');
        $this->assertTrue($this->url->getScheme()->sameValueAs($scheme));
    }

    public function testGetUser()
    {
        $user = new StringLiteral('user');
        $this->assertTrue($this->url->getUser()->sameValueAs($user));
    }

    public function testToString()
    {
        $this->assertSame('http://user:pass@foo.com:80/bar?querystring#fragmentidentifier', $this->url->__toString());
    }

    public function testAuthlessUrlToString()
    {
        $nativeUrlString = 'http://foo.com:80/bar?querystring#fragmentidentifier';
        $authlessUrl = new Url(
            new SchemeName('http'),
            new StringLiteral(''),
            new StringLiteral(''),
            new Hostname('foo.com'),
            new PortNumber(80),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );
        $this->assertSame($nativeUrlString, $authlessUrl->__toString());

        $fromNativeUrl = Url::fromNative($nativeUrlString);
        $this->assertSame($nativeUrlString, Url::fromNative($authlessUrl)->__toString());
    }

    public function testNullPortUrlToString()
    {
        $nullPortUrl = new Url(
            new SchemeName('http'),
            new StringLiteral('user'),
            new StringLiteral(''),
            new Hostname('foo.com'),
            new NullPortNumber(),
            new Path('/bar'),
            new QueryString('?querystring'),
            new FragmentIdentifier('#fragmentidentifier')
        );
        $this->assertSame('http://user@foo.com/bar?querystring#fragmentidentifier', $nullPortUrl->__toString());
    }
}
