<?php
namespace frontend\service;

use yii;
use Elasticsearch\ClientBuilder;
class EsService
{

    public  $index;
    public  $type;
    public  $client;
    public   function __construct($index, $type){
        $this->index = $index;
        $this->type = $type;
        $hosts = yii::$app->params['elasticsearch'];
        $this->client = ClientBuilder::create()->setHosts($hosts)->build();
    }

    /**
     * 创建索引
     */
    public function createIndex(){
        $params = [
            'index' => $this->index,
            'body' => [
                'settings' => [
                    'number_of_shards' => 2,    //分片数
                    'number_of_replicas' => 0   //副本数
                ]
            ]
        ];

        $response = $this->client->indices()->create($params);
        return $response;
    }

    /**
     * 删除索引
     */
    public function deleteIndex(){
        $params = ['index' => $this->index];
        $response = $this->client->indices()->delete($params);
        return $response;

    }

    /**
     * 添加文档
     */
    public function createDocument($id, $data){
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $id,
            'body' => $data
        ];

        $response = $this->client->index($params);
        return $response;
    }

    /**
     * 批量添加文档
     */
    public function batchCreateDoc($data){
        foreach ($data as  $value){
            $params = [
                'index' => $this->index,
                'type' => $this->type,
                'body' => $value
            ];
            $responses = $this->client->index($params);
        }

        return $responses;

    }

    /**
     * 查询文档
     */
    public function getDocument($id){
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'id' => $id,
            'client' => [ 'ignore' => [400, 404] ],
        ];

        $response = $this->client->get($params);
        return $response;
    }

    /**
     * 搜索文档
     */
    public function searchDocument($param){

        $tmp = [];
        foreach ($param as $key => $value) {
            $tmp[$key] = [
                "query"=> $value,
                "minimum_should_match"=> "50%",
            ];
        }

        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'body' => [
                'query' => [
                    'match' =>  $tmp
                ]
            ]
        ];

        $response = $this->client->search($params);
        return $response;
    }

    /**
     * @param $param
     * @desc 关键词搜索文档
     */
    public function keywordSearch($keyword){
        $params = [
            'index' => $this->index,
            'type' => $this->type,
            'body' => [
                'query' => [
                    'multi_match' =>  [
                        'query'=>$keyword,
                    ],
                ]
            ]
        ];
        $response = $this->client->search($params);
        return $response;
    }
}

