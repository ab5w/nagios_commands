<?php

class nagios_commands {

    private $cmdfile;

    public function __construct($file) {

        $this->cmdfile = $file;

    }

    private function execute($command) {

        $time = time();

        $payload = '[' . $time . '] ' . $command . "\n";

        file_put_contents($this->cmdfile, $payload);

    }

    public function ackService($host,$service,$user,$comment) {

        $command = 'ACKNOWLEDGE_SVC_PROBLEM;' . $host . ';' . $service . ';2;1;1;' . $user . ';' . $comment;

        $this->execute($command);

    }

    public function ackHost($host,$user,$comment) {

        $command = 'ACKNOWLEDGE_HOST_PROBLEM;' . $host . ';2;1;1;' . $user . ';' . $comment;

        $this->execute($command);

    }

    public function serviceDowntime($host,$service,$duration,$user,$comment) {

        $start = time();
        $duration = $duration * 60;
        $end = $start + $duration;

        $command = 'SCHEDULE_SVC_DOWNTIME;' . $host . ';' . $service . ';' . $start . ';' . $end . ';1;0;' . $duration . ';' . $user . ';' . $comment;

        $this->execute($command);

    }

    public function hostDowntime($host,$duration,$user,$comment) {

        $start = time();
        $duration = $duration * 60;
        $end = $start + $duration;

        $command = 'SCHEDULE_HOST_DOWNTIME;' . $host . ';' . $start . ';' . $end . ';1;0;' . $duration . ';' . $user . ';' . $comment;

        $this->execute($command);

    }

    public function allserviceDowntime($host,$duration,$user,$comment) {

        $start = time();
        $duration = $duration * 60;
        $end = $start + $duration;

        $command = 'SCHEDULE_HOST_SVC_DOWNTIME;' . $host . ';' . $start . ';' . $end . ';1;0;' . $duration . ';' . $user . ';' . $comment;

        $this->execute($command);

    }

    public function recheckService($host,$service) {

        $command = 'SCHEDULE_FORCED_SVC_CHECK;' . $host . ';' . $service . ';' . time();

        $this->execute($command);

    }

    public function recheckAllServices($host) {

        $command = 'SCHEDULE_FORCED_HOST_SVC_CHECKS;' . $host . ';' . time();

        $this->execute($command);

    }

    public function recheckHost($host) {

        $command = 'SCHEDULE_FORCED_HOST_CHECK;' . $host . ';' . time();

        $this->execute($command);

    }

}