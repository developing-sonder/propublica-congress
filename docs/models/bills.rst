*******
Bills
*******

Introduction
=============

Something about Bills.

.. code-block:: php
   :linenos:

   use DevelopingSonder\Members;

   $memberManager = new Members;

   // Returns most recent twenty recent votes
   $recentVotes = $memberManager->members();

   // Return the next 20 recent votes
   $recentVotes = $voteManager->nextPage();