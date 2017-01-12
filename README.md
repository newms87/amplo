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
    * If you are using Hyper-V on a UEFI system you may additionally need to disable Hyper-V in order to access VT-x.
    * Make sure your firewall is not blocking the VirtualBox connection
    * If vagrant seems to hang / timeout while connecting to the virtual machine, try opening up VirtualBox GUI and check the preview for the machine. It may be waiting for input (eg: to choose which OS to load). Try opening up a GUI to the machine to provide input to the machine, to allow it to continue booting.
    * You can always try a different virtual server instead of VirtualBox (eg: VMWare, Parallels, etc), just change the `provider` config in `Homestead.yaml` to the correct virtual 
    * See [Laravel Homestead](https://laravel.com/docs/5.3/homestead) for more information
