*************
Installation
*************


Instructions
-------------
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