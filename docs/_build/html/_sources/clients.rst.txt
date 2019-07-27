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


Pagination
------------
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