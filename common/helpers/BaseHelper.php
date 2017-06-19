<?php

namespace common\helpers;

/**
 * 
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class BaseHelper
{
    /** @var integer flag for inactive status */
    const STATUS_INACTIVE = 0;
    /** @var integer flag for active status */
    const STATUS_ACTIVE = 1;
    
    /** @var integer TTL forever */
    const TTL_FOREVER = 0;
    /** @var integer TTL 5 minutes duration */
    const TTL_5_MIN = 300;
    /** @var integer TTL 10 minutes duration */
    const TTL_10_MIN = 600;
    /** @var integer TTL 15 minutes duration */
    const TTL_15_MIN = 900;
    /** @var integer TTL 30 minutes duration */
    const TTL_30_MIN = 1800;
    /** @var integer TTL 45 minutes duration */
    const TTL_45_MIN = 2700;
    /** @var integer TTL 60 minutes duration */
    const TTL_60_MIN = 3600;
}
