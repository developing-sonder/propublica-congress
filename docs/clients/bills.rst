*************
Bills Client
*************

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

