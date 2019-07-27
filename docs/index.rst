.. php-propublica-congress-sdk documentation master file, created by
   sphinx-quickstart on Fri Jan  4 14:54:59 2019.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

.. toctree::
   :maxdepth: 4
   :caption: TESTING!


#######################################
PHP SDK for Propublica's Congress API
#######################################


Something Here!

*************
Installation
*************

Requirements
=============
* php >= 7.2
* illuminate/contracts 5.1.*|5.2.*|5.3.*|5.4.*|5.5.*|5.6.*
* illuminate/support 5.1.*|5.2.*|5.3.*|5.4.*|5.5.*|5.6.*,
* guzzlehttp/guzzle ^6.3

Project Setup
==============
.. code-block:: console

   composer install developingsonder/propublica-congress

Next you'll need to get an API Key from `Propublica.org <https://projects.propublica.org/api-docs/congress-api/#get-an-api-key>`_.
Once you've received you API KEY place it in the .env file in the root of your project.

.. code-block:: console

   PROPUBLICA_API_KEY=
   PROPUBLICA_API_VERSION=v1

At the time of this documentation, the Propublica Congress API's version is v1 and is the default used by ``DevelopingSonder\\PropublicaCongress\\Http\\Connection::class()``.
If you're using v1, you can remove that line, though we recommend you leave it for ease of upgrade later. The PROPUBLICA_API_KEY is required here.

***************
HTTP Structure
***************
Something to follow here.

The Connection Singleton
=========================
Something Here.

The Response Class
===================
Something here.

**************
The Resources
**************
The models represent each endpoint in the Propublica Congress API. Below you'll find references for all that are completed in our sdk.

Each request by the models returns result sets of 20. An offset can be supplied for pagination. The offset number must be a multiplier of 20.

************
The Clients
************
The Client classes hold the logic required to connect to the API. Their main purpose is to mirror the ProPublica Congress API and handle the response. Each endpoint will return the
items from the "results" key of the response data.

Additionally the Client will retain the last response. The response can be accessed as ``$client->response()``. The ``Developing\Sonder\Http\Response::class`` is a
wrapper for the guzzleHttp response that provides easier access to information from the body stream. This can be useful when you want to repeat a call or for pagination of data as some endpoints will only return one page of 20 results at the time.

.. code-block:: php
   :linenos:

   $client = new VotesClient;

   // Votes is an array containing STD objects of vote information.
   $votes = $client->recent('senate');

   // The $lastResponse variable is publicly accessible.
   $responseStatus = $client->response()->status;

**Propublica's Pagination** returns page's of 20. The client classes contain a ``$offset`` variable that allows you effectively designate a page of results to be returned. The
``$page`` variables index starts at 1.

The clients also include ``$client->nextPage()`` and ``$client->previousPage()`` methods that allow to quickly increment and decrement
the offset before immediately rerunning the last request.

.. code-block:: php
   :linenos:

      use DevelopingSonder\Clients\VotesClient;

      $client = new VotesClient;

      // Returns most recent twenty recent votes
      $response = $voteManager->recent('senate');
      $votes = $response->results();

      // Return the next 20 recent votes
      $response = $voteManager->nextPage();
      $votes = $response->results();

      // Return the previous 20 recent votes
      $response = $voteManager->previousPage();
      $votes = $response->results();

      // Return only the results array of the Response
      $votes = $voteClient->nextPage(true);

      // Convert response data to Resource Collection.
      $collection = VotesCollection::make($recentVotes);

Votes Client
=============
The Votes Model gives you access to Congresses voting records.

Recent Votes
-------------

.. code-block:: php
   :linenos:

   use DevelopingSonder\Clients\VotesClient;

   $client = new VotesClient;

   // Returns most recent twenty recent votes
   $recentVotes = $voteManager->recent('senate');

   // Return the next 20 recent votes
   $recentVotes = $voteManager->nextPage();

   // Convert response data to Resource Collection.
   $collection = VotesCollection::make($recentVotes);

Members Client
===============
Members Client

Find
-----
Add Here

Bills
======
The Bills Client allows you to access the /bills endpoint of the Propublica Congress API. A ``DevelopingSonder\PropublicaCongress\Helpers\BillsCollection`` class
also exists to help convert array data into Bill's resources.

When a ``$type`` argument is present on a method you may pass one of the six following bill statuses:

``introduced`` ``updated`` ``active`` ``passed`` ``enacted`` ``vetoed``

Recent Bills
-------------
``recent($congress, $chamber, $type)``

.. code-block:: php
   :linenos:

      use DevelopingSonder\Bills;

      $bClient = new BillsClient;

      // Return the Bills from the 115th Congress that passed in the Senate.
      $bills = $bClient->recent('115', 'senate', 'passed');


Recent Bills By Member
-----------------------
``recentByMember($memberId, $type)``

.. code-block:: php
   :linenos:

         use DevelopingSonder\BillsClient;

         $bClient = new BillsClient;

         // Return the Bills from the 115th Congress that passed in the Senate.
         $bills = $bClient->recentByMember('R000595', 'passed');

         // Alternatively you can pass an instance of a Member Resource
         $member = MemberClient::find('R000595')->results();
         $bills = $bClient->recentByMember($member, 'introduced');


Recent Bills By Subject
------------------------
``recentBySubject($subject)``

.. code-block:: php
   :linenos:

            use DevelopingSonder\BillsClient;
            $bClient = new BillsClient;

            // Return the recent Bills that include a subject of 'climate'
            $bills = $bClient->recentBySubject('climate');

Upcoming Bills
---------------
``recentBySubject($chamber)``

.. code-block:: php
   :linenos:

               use DevelopingSonder\BillsClient;
               $bClient = new BillsClient;

               // Return the upcoming bills in the House.
               $bills = $bClient->upcoming('house');


Amendments
-----------
``recentBySubject($billSlug, $congress, $onlyAmendments = true)``

.. code-block:: php
   :linenos:

               use DevelopingSonder\BillsClient;
               $bClient = new BillsClient;

               // Return the Bills from the 115th Congress that passed in the Senate.
               $amendments = $bClient->amendments('hr21', '115');

               // Full Response Result object that includes Bill information
               $billWithAmendments = $bClient->amendments('hr21', '115', false);

Subjects
---------
``recentBySubject($chamber)``

.. code-block:: php
   :linenos:

                  use DevelopingSonder\BillsClient;
                  $bClient = new BillsClient;

                  // Return the upcoming bills in the House.
                  $bills = $bClient->upcoming('house');

Related Bills
--------------
`Propublica Documentation <https://projects.propublica.org/api-docs/congress-api/bills/#get-related-bills-for-a-specific-bill>`_

Get Bills related to a specific bill. The bill_slug is used as the reference for this relationship.

``recentBySubject($billSlug, $congress)``

.. code-block:: php
   :linenos:

                  use DevelopingSonder\BillsClient;
                  $bClient = new BillsClient;

                  // Return the upcoming bills in the House.
                  $bills = $bClient->related('hr21', '115');



