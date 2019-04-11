# Laravel Namespace Dispatcher
[![Build Status](https://travis-ci.org/mineko-io/laravel-namespace-dispatcher.svg?branch=master)](https://travis-ci.org/mineko-io/laravel-namespace-dispatcher) [![Maintainability](https://api.codeclimate.com/v1/badges/356beaeb24fd03b86963/maintainability)](https://codeclimate.com/github/mineko-io/laravel-namespace-dispatcher/maintainability) [![Test Coverage](https://api.codeclimate.com/v1/badges/356beaeb24fd03b86963/test_coverage)](https://codeclimate.com/github/mineko-io/laravel-namespace-dispatcher/test_coverage) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Extends the `Illuminate\Bus\Dispatcher` class to load handlers for Jobs by convention from namespace. 
Handlers for jobs should be than named like job / command name concated with "Handler" in the same namespace. No config needed.

## Install
Using composer:
```bash
composer require "mineko-io/laravel-namespace-dispatcher"
```