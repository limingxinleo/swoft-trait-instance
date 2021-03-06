<?php
// +----------------------------------------------------------------------
// | InstanceTrait.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Swoft\Traits;

use Swoft\Core\RequestContext;

trait InstanceTrait
{
    protected $instanceKey;

    public static function instance($child = 'default', $params = [], $refresh = false)
    {
        $key = get_called_class();
        $instance = RequestContext::getContextDataByChildKey($key, $child);
        if ($refresh || is_null($instance) || !$instance instanceof static) {
            $instance = new static(...$params);
            $instance->setInstanceKey($child);
            RequestContext::setContextDataByChildKey($key, $child, $instance);
        }

        return $instance;
    }

    /**
     * @return mixed
     */
    public function getInstanceKey()
    {
        return $this->instanceKey;
    }

    /**
     * @param mixed $instanceKey
     */
    public function setInstanceKey($instanceKey)
    {
        $this->instanceKey = $instanceKey;
    }
}