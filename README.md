# TagField Module

[![Build Status](https://secure.travis-ci.org/chillu/silverstripe-tagfield.png?branch=master)](https://travis-ci.org/chillu/silverstripe-tagfield)

## Maintainer Contact

 * Ingo Schommer (Nickname: ischommer) <ingo (at) silverstripe (dot) com>

## Requirements

 * SilverStripe 3.1 or newer
 * Database: MySQL 5+, SQLite3, Postgres 8.3, SQL Server 2008

## Download/Information

 * http://silverstripe.org/tag-field-module

## Introduction

Provides a Formfield for saving a string of tags into either a many_many relationship or a text property. By default, tags are separated by whitespace. Check out a [http://remysharp.com/wp-content/uploads/2007/12/tagging.php](demo of the javascript interface).

## Features

  * Bundled with jQuery-based autocomplete library ([http://remysharp.com/2007/12/28/jquery-tag-suggestion/](website)) which is applied to a textfield
  * Autosuggest functionality (currently JSON only)
  * Saving in many_many relation, or in textfield
  * Static list of tags without hitting the server
  * Tab-autocompletion of tags
  * Customizeable tag layout through css
  * Unobtrusive - still saves with Javascript disabled
  * Full unit test coverage
