# amplo
### A sandbox environment for dev and innovation

##Requirements

* [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
* [Vagrant](https://www.vagrantup.com/downloads.html)

##Setup
1. Install all the [Requirements](#requirements)
2. Clone the Git repo to your website directory (any directory really)
3. from the amplo root directory, run `vagrant up`
    * If you run into problems initializing the virtual server see the [Troubleshooting](#troubleshooting) section.
    
##Troubleshooting

* Problems initializing the vagrant virtual server?
    * Try `vagrant destroy --force` then `vagrant up` again
    * Try enabling Hardware virtualization by turning on the setting in your BIOS (Intel Virtualization Technology / Intel VT or AMD-V)
    * Make sure your firewall is not blocking the VirtualBox connection
    * You can always try a different virtual server instead of VirtualBox (eg: VMWare, Parallels, etc), just change the `provider` config in `Homestead.yaml` to the correct virtual 
    * See [Laravel Homestead](https://laravel.com/docs/5.3/homestead) for more information
