.. php-propublica-congress-sdk documentation master file, created by
   sphinx-quickstart on Fri Jan  4 14:54:59 2019.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

PHP SDK for Propublica's Congress API
=======================================================

.. toctree::
   :maxdepth: 3
   :caption: Contents:

Something Here!

Installation
============
.. code-block:: console

   composer install developingsonder/propublica-congress

Next you'll need to get an API Key from `Propublica.org <https://projects.propublica.org/api-docs/congress-api/#get-an-api-key>`_.
Once you've received you API KEY place it in the .env file in the root of your project.

.. code-block:: console

   PROPUBLICA_API_KEY=
   PROPUBLICA_API_VERSION=v1

At the time of this documentation, the Propublica Congress API's version is v1 and is the default used by **DevelopingSonder\\PropublicaCongress\\Http\\Connection::class()**.
If you're using v1, you can remove that line, though we recommend you leave it for ease of upgrade later. The PROPUBLICA_API_KEY is required here.

Requirements
------------
* php >= 7.2
* illuminate/contracts 5.1.*|5.2.*|5.3.*|5.4.*|5.5.*|5.6.*
* illuminate/support 5.1.*|5.2.*|5.3.*|5.4.*|5.5.*|5.6.*,
* guzzlehttp/guzzle ^6.3

HTTP Structure
==============


The Models
==========
The models represent each endpoint in the Propublica Congress API. Below you'll find references for all that are completed in our sdk.

Each request by the models returns result sets of 20. An offset can be supplied for pagination. The offset number must be a multiplier of 20.

Votes
-----
The Votes Model gives you access to Congresses voting records.

Recent Votes
************

.. code-block:: php
   :linenos:

   use DevelopingSonder\Votes;

   $voteManager = new Votes;

   // Returns most recent twenty recent votes
   $recentVotes = $voteManager->recent('senate');

   // Return the next 20 recent votes
   $recentVotes = $voteManager->nextPage();

Members
-------

Bills
-----

