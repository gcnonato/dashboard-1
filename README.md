AnyTV Dashboard
===============

The core of this uses the [Slim Framework](http://www.slimframework.com/) which is a very thin (hence the name) microframework for PHP.
It makes for very simple routing and is as extensible as you want it to be.

Also included is a templating engine called [Twig](http://twig.sensiolabs.org/) which sort of
looks like Jinja (a popular Python templating language) which was used to create page templates
for the site.

A wrapper API for HasOffers was also made, but mostly incomplete (and a still bit inelegant, at this
point). It already implements creating Offers, accessing the application, and a rudimentary importer
implementation.