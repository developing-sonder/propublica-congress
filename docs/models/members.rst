********
Members
********

Member Party Affiliation
=========================

.. code-block:: php
   :linenos:

   use DevelopingSonder\Members;

   $memberManager = new Members;

   // Returns most recent twenty recent votes
   $members = $memberManager->members();

    //-- Get the party affiliation of the first member
    $party = $members->first()->party();

    //-- Output
    //-- Republican, Democrat, Independent, or Unknown