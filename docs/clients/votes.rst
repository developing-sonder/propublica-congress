*************
Votes Client
*************

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