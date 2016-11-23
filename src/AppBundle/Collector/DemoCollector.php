<?php
/**
 * Created by PhpStorm.
 * User: sylva
 * Date: 31/10/2016
 * Time: 18:18
 */

namespace AppBundle\Collector;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class DemoCollector extends DataCollector
{
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {

    }

    public function getName()
    {
        return 'demo';
    }

}