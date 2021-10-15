ValueObjects
============

[![Build Status](http://img.shields.io/travis/ytake/valueobjects/master.svg?style=flat-square)](https://travis-ci.org/ytake/valueobjects)
[![Coverage Status](http://img.shields.io/coveralls/ytake/valueobjects/master.svg?style=flat-square)](https://coveralls.io/r/ytake/valueobjects?branch=master)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/ytake/valueobjects.svg?style=flat-square)](https://scrutinizer-ci.com/g/ytake/valueobjects/?branch=master)

[![License](http://img.shields.io/packagist/l/ytake/valueobjects.svg?style=flat-square)](https://packagist.org/packages/ytake/valueobjects)
[![Latest Version](http://img.shields.io/packagist/v/ytake/valueobjects.svg?style=flat-square)](https://packagist.org/packages/ytake/valueobjects)
[![Total Downloads](http://img.shields.io/packagist/dt/ytake/valueobjects.svg?style=flat-square)](https://packagist.org/packages/ytake/valueobjects)
[![StyleCI](https://styleci.io/repos/88750136/shield?branch=master)](https://styleci.io/repos/88750136)

[![Codacy Badge](https://img.shields.io/codacy/grade/3a3d7d2e4cfb497b911316b61cc2aa95.svg?style=flat-square)](https://www.codacy.com/app/yuuki-takezawaOrganization/valueobjects?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=ytake/valueobjects&amp;utm_campaign=Badge_Grade)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/414e9e8f-4854-43b4-8c98-5d248e803bb3/mini.png)](https://insight.sensiolabs.com/projects/414e9e8f-4854-43b4-8c98-5d248e803bb3)

A PHP library/collection of classes aimed to help developers using and undestanding immutable objects.

This is fork of the educational package nicolopignatelli/valueobjects that aims to provide more functionality for basic tasks and act as a object oriented wrapper for PHP types.

# Install

Supports >= PHP 7.0

```bash
$ composer require ytake/valueobjects
```

# Develop

To run tests, checks and get a shell to the development environment you need `docker`, `docker-compose` and `make`.

## Run composer and docker 

Running `make up` will build the php docker image and run composer install as part of it.

You can also open a shell inside the container, for instance to perform some commands like composer changes and updates
by running `make bash`

## Run tests

You can run unit

`make tests`

code style checks and fixes

`make phpcs` and `make phpcbf

or the security checker with

`make securitychecker`
