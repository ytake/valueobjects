<?php
declare(strict_types=1);

namespace ValueObjects\Web;

use ValueObjects\StringLiteral\StringLiteral;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

/**
 * Class Url
 */
class Url implements ValueObjectInterface
{
    /** @var SchemeName */
    protected $scheme;

    /** @var StringLiteral */
    protected $user;

    /** @var StringLiteral */
    protected $password;

    /** @var Domain */
    protected $domain;

    /** @var Path */
    protected $path;

    /** @var PortNumber */
    protected $port;

    /** @var QueryString */
    protected $queryString;

    /** @var FragmentIdentifier */
    protected $fragmentIdentifier;

    /**
     * Returns a new Url object from a native url string
     *
     * @param ...string $url
     *
     * @return Url|ValueObjectInterface
     */
    public static function fromNative(): ValueObjectInterface
    {
        $urlString = \strval(\func_get_arg(0));

        $user = \parse_url($urlString, PHP_URL_USER);
        $pass = \parse_url($urlString, PHP_URL_PASS);
        $host = \parse_url($urlString, PHP_URL_HOST);
        $queryString = \parse_url($urlString, PHP_URL_QUERY);
        $fragmentId = \parse_url($urlString, PHP_URL_FRAGMENT);
        $port = \parse_url($urlString, PHP_URL_PORT);

        $scheme = new SchemeName(\parse_url($urlString, PHP_URL_SCHEME));
        $user = $user ? new StringLiteral($user) : new StringLiteral('');
        $pass = $pass ? new StringLiteral($pass) : new StringLiteral('');
        $domain = Domain::specifyType($host);
        $path = \parse_url($urlString, PHP_URL_PATH);
        if (is_null($path)) {
            $path = '';
        }
        $path = new Path($path);
        $portNumber = $port ? new PortNumber($port) : new NullPortNumber();
        $query = $queryString ? new QueryString(\sprintf('?%s', $queryString)) : new NullQueryString();
        $fragment = $fragmentId ? new FragmentIdentifier(\sprintf('#%s', $fragmentId)) : new NullFragmentIdentifier();

        return new static($scheme, $user, $pass, $domain, $portNumber, $path, $query, $fragment);
    }

    /**
     * Returns a new Url object
     *
     * @param SchemeName          $scheme
     * @param StringLiteral       $user
     * @param StringLiteral       $password
     * @param Domain              $domain
     * @param Path                $path
     * @param PortNumberInterface $port
     * @param QueryString         $query
     * @param FragmentIdentifier  $fragment
     */
    public function __construct(
        SchemeName $scheme,
        StringLiteral $user,
        StringLiteral $password,
        Domain $domain,
        PortNumberInterface $port,
        Path $path,
        QueryString $query,
        FragmentIdentifier $fragment
    ) {
        $this->scheme = $scheme;
        $this->user = $user;
        $this->password = $password;
        $this->domain = $domain;
        $this->path = $path;
        $this->port = $port;
        $this->queryString = $query;
        $this->fragmentIdentifier = $fragment;
    }

    /**
     * Tells whether two Url are sameValueAs by comparing their components
     *
     * @param  Url|ValueObjectInterface $url
     *
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $url): bool
    {
        if (false === Util::classEquals($this, $url)) {
            return false;
        }

        return $this->getScheme()->sameValueAs($url->getScheme()) &&
            $this->getUser()->sameValueAs($url->getUser()) &&
            $this->getPassword()->sameValueAs($url->getPassword()) &&
            $this->getDomain()->sameValueAs($url->getDomain()) &&
            $this->getPath()->sameValueAs($url->getPath()) &&
            $this->getPort()->sameValueAs($url->getPort()) &&
            $this->getQueryString()->sameValueAs($url->getQueryString()) &&
            $this->getFragmentIdentifier()->sameValueAs($url->getFragmentIdentifier());
    }

    /**
     * Returns the domain of the Url
     *
     * @return Hostname|IPAddress
     */
    public function getDomain(): Domain
    {
        return clone $this->domain;
    }

    /**
     * Returns the fragment identifier of the Url
     *
     * @return FragmentIdentifier
     */
    public function getFragmentIdentifier(): FragmentIdentifier
    {
        return clone $this->fragmentIdentifier;
    }

    /**
     * Returns the password part of the Url
     *
     * @return StringLiteral
     */
    public function getPassword(): StringLiteral
    {
        return clone $this->password;
    }

    /**
     * Returns the path of the Url
     *
     * @return Path
     */
    public function getPath(): Path
    {
        return clone $this->path;
    }

    /**
     * Returns the port of the Url
     *
     * @return PortNumberInterface
     */
    public function getPort(): PortNumberInterface
    {
        return clone $this->port;
    }

    /**
     * Returns the query string of the Url
     *
     * @return QueryString
     */
    public function getQueryString(): QueryString
    {
        return clone $this->queryString;
    }

    /**
     * Returns the scheme of the Url
     *
     * @return SchemeName
     */
    public function getScheme(): SchemeName
    {
        return clone $this->scheme;
    }

    /**
     * Returns the user part of the Url
     *
     * @return StringLiteral
     */
    public function getUser(): StringLiteral
    {
        return clone $this->user;
    }

    /**
     * Returns a string representation of the url
     *
     * @return string
     */
    public function __toString(): string
    {
        $userPass = '';
        if (false === $this->getUser()->isEmpty()) {
            $userPass = \sprintf('%s@', $this->getUser());

            if (false === $this->getPassword()->isEmpty()) {
                $userPass = \sprintf('%s:%s@', $this->getUser(), $this->getPassword());
            }
        }

        $port = '';
        if (false === NullPortNumber::create()->sameValueAs($this->getPort())) {
            $port = \sprintf(':%d', $this->getPort()->toNative());
        }

        $urlString = \sprintf('%s://%s%s%s%s%s%s', $this->getScheme(), $userPass, $this->getDomain(), $port,
            $this->getPath(), $this->getQueryString(), $this->getFragmentIdentifier());

        return $urlString;
    }
}
