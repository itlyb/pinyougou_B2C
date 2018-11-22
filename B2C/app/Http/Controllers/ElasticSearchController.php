<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Elasticsearch;

class ElasticSearchController extends Controller
{   
    public static function Goodsave($data,$orderBy,$orderWay='desc')
    {   
        // $params= [
        //     'index' => 'good_news',
        // ];
        
        // Elasticsearch::indices() -> create($params);



        $indexParam['index'] = 'good_new';
        $indexParam['type'] = 'goods';
        $mapParam = array(
            
            'properties' => array(
                // 'title' => array(
                //         'type' => 'string',//field_name_1值为string类型
                //         'analyzer' => 'standard'//分析
                //     ),
                // 'score' => array(
                //         'type' => 'float',//分数为float
                //         'index' => 'not_analyzed'
                //     ),
                // 'url' => array(
                //         'type' => 'string',
                //         'no-index'=>'not_analyzed'//不进行索引,默认就是不索引
                // ),
                'created_at' => [
                    'type' => 'date',
                    'format' => 'YYYY-MM-DD HH:MM:SS OO:OO:OO'
                ]
                ),
            );
            //index为db,type为table
            //mapp就相当与给table分配字段以及属性
            $indexParam['body'][$indexParam['type']] = $mapParam;
            $ret = Elasticsearch::indices() -> putMapping($indexParam);
            dd($ret);
	// p($ret);
	//Array
	// (
	//     [acknowledged] => 1
	// )
 
	//查看刚才创建的mapping
 
	// $ret =Elasticsearch::indices() -> getMapping($indexParam);
	
        foreach($data as $v){
            $params = [
                'index' => "good_new",
                'type' => 'goods',
                'body' => [
                    'created_at' => $v['created_at']
                ],
                'id' => $v['id'],
            ];
            Elasticsearch::index($params);
        }
        $params = [
            'index' => "good_new",
            'type' => 'goods',
            
                
        ];
        return $results = Elasticsearch::search($params);
    }
    public function elastic()
    {   
        $data = Good::get();
        foreach($data as $k => $v)
        {
            
        }    
        $params = [
            'index' => 'good',
            'type' => 'goods',
            'body' => [
                'query' => [
                    'match' => [
                        'name' => '测试'
                    ]
                ]
            ]
        ];
        

       
        // return $results = Elasticsearch::search($params);
        $delete = ['index' => 'my_index'];
        Elasticsearch::indices()->delete($delete);
        return $results = Elasticsearch::search($params);
        // $client = ClientBuilder::create()->build();
        // $return = $client->index($data);
        
    }
}
