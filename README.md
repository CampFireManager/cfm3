# CampFireManager 3

CampFireManager 3 is the latest itteration of the CampFireManager Scheduler for conferences, barcamps and other events. It runs in PHP 5.4, using a MySQL backend, and will have plugins for at least SMS interaction (using Gammu's SMS Daemon), Twitter and hopefully other two-way communication systems such as IRC or XMPP.

We are currently migrating to a [ZF2](http://framework.zend.com/ "Zend Framework") based platform from the previous non-framework based platform, and as such, this is very much the bleeding-edge version. [CFM2](https://github.com/CampFireManager/cfm2 "CFM2") is still our Stable version.

## Installation

This project is looking to use a combination of [Vagrant](http://www.vagrantup.com "Vagrant by HashiCorp") and [Puppet](https://puppetlabs.com/puppet/puppet-open-source/ "Puppet by Puppet Labs"), and as such you can get started with a local instance very easily!

1.  Install [Vagrant](http://downloads.vagrantup.com/ "Download link for Vagrant")
2.  Install git (if you haven't already!)
3.  Clone this repository to your system
4.  From the cloned directory, run the following command: `vagrant up`
5.  Ensure the virtual machine has powered up OK (no red lines), and then navigate to http://192.0.2.100 (this is the defined IP address of this Vagrant machine - change it in [the configuration file](Vagrantfile "the Vagrant config file for this project"))

## Getting involved

Please feel free to fork this code on github and we would be very interested in pull requests. If 
you're not a coder, but you can submit bug reports, or can perform triage on issues, or want to 
help with documentation, or translations... please jump in and either submit tickets in our github 
tracker, or post to the 
[general mailing list](https://groups.google.com/group/campfiremanager "CampFireManager Google Group"). 

If you want to keep on top of when changes are committed to the repository, join the 
[internals mailing list](https://groups.google.com/group/campfiremanager-internals "CampFireManager Interals Mailing List").
