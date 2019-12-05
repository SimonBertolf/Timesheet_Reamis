<?php


class class_time
{
    private $start;
    private $stop;
    private $diff;
    private $work_time;

    public function work_time($start_time,$stop_time){

        $this->start = new DateTime($start_time);
        $this->stop = new DateTime($stop_time);

        $this->diff = $this->start->diff($this->stop);

        $this->work_time = $this->diff->format("%h").'.'.$this->diff->format("%I")/6*10;
        return $this->work_time;
    }

}
