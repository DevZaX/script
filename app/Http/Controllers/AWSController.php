<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\Process\Process;

class AWSController extends Controller
{
    public function DescribeInstances()
    {
    	$s3 = $this->setupeClient(request("region"),request("key"),request("secret"),request("token"));

		$r = $s3->describeInstances();

        if( count($r["Reservations"]) > 0 )  return collect($r["Reservations"][0]["Instances"])->pluck("InstanceId");

    }

    public function createClient()
    {
        if( request("key") != "" ) $credentials["key"]=request("key");
        if( request("secret") != "" ) $credentials["secret"]=request("secret");
        if( request("token") != "" ) $credentials["token"]=request("token");

        $ec2 = new \Aws\Ec2\Ec2Client([
            'region' => request("region"),
            'version' => 'latest',
            'credentials' => $credentials
        ]);

        return $ec2;
    }

    public function setupeClient($region,$key,$secret,$token)
    {
        if( $key != "" ) $credentials["key"]=$key;
        if( $secret != "" ) $credentials["secret"]=$secret;
        if( $token != "" ) $credentials["token"]=$token;

        $ec2 = new \Aws\Ec2\Ec2Client([
            'region' => $region,
            'version' => 'latest',
            'credentials' => $credentials
        ]);

        return $ec2;
    }

    public function stopInstances($client,$ids)
    {
        $client->stopInstances($ids);
    }

    public function startInstances($client,$ids)
    {
        $client->startInstances($ids);
    }

    public function start()
    {
        foreach(request("data") as $item)
        {
            $id = $this->saveItem($item);
            $cmd = 'php '.config('artisan')['cmd'].' '.$id.' &'; 
            $process = new Process($cmd);
            $process->start();
            while($process->isRunning()){}
            //$this->executeScript($item);
        }
    }

    public function saveItem($item)
    {
        return \DB::table("items")->insertGetId([
            "region"=>$item["region"],
            "key"=>$item["account"]["key"],
            "secret"=>$item["account"]["secret"],
            "token"=>$item["account"]["token"],
            "ids"=>$this->toString($item["ids"])
        ]);
    }

    public function toString($ids)
    {
        return implode(",", $ids);
    }

    public function getItem($id)
    {
        return \DB::table("items")->find($id);
    }

    public function executeScript($id)
    {
        $item = \DB::table("items")->find($id);

        $client = $this->setupeClient(
            $item->region,
            $item->key,
            $item->secret,
            $item->token
        );

        $ids = explode(",", $item->ids);

        $client->stopInstances($ids);
        $client->startInstances($ids);

        sleep(420);

        $client->stopInstances($ids);
        $client->startInstances($ids);

    }
}
