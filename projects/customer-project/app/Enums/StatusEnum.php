<?php

namespace App\Enums;

abstract class StatusEnum {
    const ERROR = 0;
    const SUCCESS = 1;

    const ACTIVE = 'active';
    const PASSIVE = 'passive';
    const NULL = null;
}
