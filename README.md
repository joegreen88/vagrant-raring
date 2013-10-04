vagrant-raring
==============

A vagrant box running ubuntu 13 (raring) with apache and php. Provisioned with puppet and setup with ansible.

 1. Install [vagrant](http://www.vagrantup.com/) and [virtualbox](https://www.virtualbox.org/) on your host machine.
 2. Clone this repository with `git clone https://github.com/joegreen88/vagrant-raring`.
 3. Add this line to your hosts file: `127.0.0.1    raring`
 4. Cd into the project root and spin up a vagrant instance with `vagrant up`.
 5. When vagrant has done it's thing ssh into the VM with `vagrant ssh`.
 6. Run `ansible-playbook /vagrant/vagrant/ansible/playbooks/setup.yml` to set up the apache & php and download the composer dependencies.
 7. Go to [http://raring:8080](http://raring:8080) in your web browser to verify a successful operation.

### Installed

 - ansible
 - apache2
 - php
 - git
 - composer