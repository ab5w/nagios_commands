# nagios_commands
PHP class to give commands to nagios.

Usage:

    include 'nagios_commands.class.php';
    $nagios = new nagios_commands('/path/to/nagios.cmd');

Acknowledge a service problem.

    $nagios->ackService($host,$service,$user,$comment);

Acknowledge a host problem.

    $nagios->ackHost($host,$user,$comment);

Schedule downtime for a service (duration in minutes).

    $nagios->serviceDowntime($host,$service,$duration,$user,$comment);

Schedule downtime for a host (duration in minutes).

    $nagios->hostDowntime($host,$duration,$user,$comment);

Schedule downtime for all services on a host (duration in minutes).

    $nagios->allserviceDowntime($host,$duration,$user,$comment);

Force recheck a service.

    $nagios->recheckService($host,$service);

Force recheck all services on a host.

    $nagios->recheckAllServices($host);

Force recheck a host.

    $nagios->recheckHost($host);
