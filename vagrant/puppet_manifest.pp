class ansible {
    package { "python-dev":
        ensure => present
    }
    package { "python-pip":
        ensure => present,
        require => Package['python-dev']
    }
    exec { 'install ansible':
        command => "/usr/bin/pip install PyYAML Jinja2 paramiko ansible",
        require => Package['python-pip']
    }
    file { '/etc/ansible':
        ensure => 'directory',
        require => Exec['install ansible']
    }
    file { '/etc/ansible/hosts':
        ensure => 'file',
        source => "/vagrant/vagrant/ansible/hosts",
        mode => "666",
        require => File['/etc/ansible']
    }
    file { '/etc/hosts':
        ensure => 'file',
        source => "/vagrant/vagrant/hosts",
        require => File['/etc/ansible/hosts']
    }
    file { '/home/vagrant/.ssh':
        ensure => 'directory',
        require => File['/etc/hosts']
    }
    file { '/home/vagrant/.ssh/id_rsa':
        ensure => 'file',
        source => "/vagrant/vagrant/.ssh/id_rsa",
        mode => "600",
        require => File['/home/vagrant/.ssh']
    }
    file { '/home/vagrant/.ssh/id_rsa.pub':
        ensure => 'file',
        source => "/vagrant/vagrant/.ssh/id_rsa.pub",
        require => File['/home/vagrant/.ssh/id_rsa']
    }
    exec { 'authorized_keys':
        command => "/bin/cat /home/vagrant/.ssh/id_rsa.pub >> /home/vagrant/.ssh/authorized_keys",
        require => File['/home/vagrant/.ssh/id_rsa.pub']
    }
}
include ansible