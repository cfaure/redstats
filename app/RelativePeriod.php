<?php namespace App;

abstract class RelativePeriod
{
    const __default = 1;

    const PREVIOUS       = 1;
    const YESTERDAY      = '1 DAY';
    const LAST_WEEK      = '7 DAY';
    const LAST_MONTH     = '1 MONTH';
    const LAST_TRIMESTER = '3 MONTH';
    const LAST_SEMESTER  = '6 MONTH';
    const LAST_YEAR      = '1 YEAR';
}
