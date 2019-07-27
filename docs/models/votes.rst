***********
Votes
***********

Introduction
==============

The Following List of Functions will help you Quickly Retrieve Votes.

Recent Votes
-------------

.. code-block:: php
   :linenos:

   use DevelopingSonder\Votes;

   $voteManager = new Votes;

   // Returns most recent twenty recent votes
   $recentVotes = $voteManager->recent('senate');

   // Return the next 20 recent votes
   $recentVotes = $voteManager->nextPage();