<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Ecs\EcsClient;
use Aws\Ec2\Ec2Client;
use Aws\Rds\RdsClient;
use Aws\Efs\EfsClient;
use Aws\ElasticLoadBalancingV2\ElasticLoadBalancingV2Client;

class CreateClusterController extends Controller
{
    function createStore(){

        $name= "example";

        // Amazon ECS
        $ecs_client = new EcsClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
               
            ],
        ]);

        // Amazon EC2
        $ec2_client = new Ec2Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
             
            ],
        ]);

        //Amazon RDS
        $rds_client = new RdsClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                
            ],
        ]);

        //Amazon Efs
        $efs_client = new EfsClient([
            'version' => '2015-02-01',
            'region' => 'us-east-1',
            'credentials' => [
                
            ]
        ]);

        $elb_client = new ElasticLoadBalancingV2Client([
            'version' => '2015-12-01',
            'region' => 'us-east-1',
            'credentials' => [
               
            ]
        ]);

        try{

            /*
            $result =$elb_client->createLoadBalancer([
                'Type' => 'application',
                'Name' => 'example-load-balancer',
                'Scheme' => 'internet-facing',
                'SecurityGroups' => ['sg-0eba60f8f8cc0aa1f'],
                'Subnets' => [
                    'subnet-04cac83d6d53eafd3',
                    'subnet-06ff2f3b3d3b55511'
                ]
            ]);
            */

            //create service
            $result = $ecs_client->createService([
                'cluster' => 'arn:aws:ecs:us-east-1:645251799591:cluster/prueba_cluster',
                'serviceName' => 'wordpress_service',
                'taskDefinition' => 'task-wordpress',
                'desiredCount' => 1,
                'launchType' => 'FARGATE',
                'platformVersion' => 'LATEST',
                'schedulingStrategy' => 'REPLICA',                
                'networkConfiguration' => [
                    'awsvpcConfiguration' => [
                        'assignPublicIp' => 'ENABLED',
                        'securityGroups' => ['sg-051e62f73c9bdc467'],
                        'subnets' => [
                            'subnet-0e307d45cf20150ff'
                        ]
                    ]
                ]
            ]);

            /*
            // create task definition
            $result = $ecs_client->registerTaskDefinition([
                'containerDefinitions' => [
                    [
                        'name' => 'wordpress',
                        'cpu' => 1024,
                        'essential' => true,
                        'image' => 'alex0369/wordpress',
                        'portMappings' => [
                            [
                                'name' => 'wordpress-80-tcp',
                                'containerPort' => 80,
                                'hostPort' => 80,
                                'protocol' => 'tcp',
                                'appProtocol' => 'http',
                            ],
                        ],
                        'logConfiguration' => [
                            'logDriver' => 'awslogs',
                            'options' => [
                                'awslogs-create-group' => 'true',
                                'awslogs-group' => '/prueba/example',
                                'awslogs-region' => 'us-east-1',
                                'awslogs-stream-prefix' => 'ecs',
                            ]
                        ]
                    ]
                ],
                'executionRoleArn' => 'arn:aws:iam::645251799591:role/ecsTaskExecutionRole',
                'taskRoleArn' => 'arn:aws:iam::645251799591:role/ecsTaskExecutionRole',
                'networkMode' => 'awsvpc',
                'family' => 'example_task_definition',
                'revision' => 1,
                'cpu' => '1024',
                'memory' => '3072',
                'compatibilities' => ['FARGATE'],
                'requiresCompatibilities' => ['FARGATE'],
                'runtimePlatform' => [
                    'cpuArchitecture' => 'X86_64',
                    'operatingSystemFamily' => 'LINUX'
                ],
                'volumes' => [
                    [
                        'name' => 'efs_example',
                        'efsVolumeConfiguration' => [
                            'FileSytemId' => '',
                            'rootDirectory' => '/'
                        ]
                    ]
                ]
            ]);
            */

        
            echo '<pre>';
            print_r($result);
            echo '</pre>';

            
            
            /*

            //describe subnets from vpc
            $result =$ec2_client->describeSubnets([
                'Filters' => [
                    [
                        'Name' => 'vpc-id',
                        'Values' => ['vpc-08d1a1642423c4983']
                    ]
                ]
            ]);


            //create filesystem
            $result = $efs_client->createFileSystem([
                'Backup' => true,
                'CreationToken' => 'tokenString',
                'Encrypted' => true,
                'PerformanceMode' => 'generalPurpose',
                'Tags' => [
                    [
                        'Key' => 'Name',
                        'Value' => 'example_filesystem'
                    ]
                ]
            ]);

            //create cluster
            $result = $ecs_client->createCluster([
                'capacityProviders' => ['FARGATE','FARGATE_SPOT'],
                'clusterName' => $name,
            ]); 


           

            //create vpc
            $create_vpc = $ec2_client->createVpc([
                'CidrBlock' => "10.0.0.0/16",
                'TagSpecifications' => [
                    [
                        'ResourceType' => 'vpc',
                        'Tags' => [
                            [
                                'Key' => 'Name',
                                'Value' => $name.'_vpc_network'
                            ]
                        ],
                    ],  
                ]
            ]);

            //create database
            $create_database = $rds_client->createDBInstance([
                'AllocatedStorage' => 10,
                'DBInstanceClass' => 'db.t3.micro',
                'DBInstanceIdentifier' => $example.'_instance_db',
                'Engine' => 'mysql',
                'MasterUserPassword' => 'secret99',
                'MasterUsername' => 'admin',
            ]);
            */
        
        }catch(Exception $e){
            var_dump($e->getMessage());       
        }
    }

    function deleteAll(){

        $ecs_client = new EcsClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAZMPABDIT4J3YUQ6P',
                'secret' => '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'
            ],
        ]);

       

        
        $create_cluster = $ecs_client->createCluster([
            'capacityProviders' => ['FARGATE','FARGATE_SPOT'],
            'clusterName' => 'example',
        ]); 
    }
}
