<?php
namespace Josercl\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Routing\UrlGenerator;

class AdminBuilder{

    protected $url;
    protected $view;

    protected $idField="id";
    protected $list;
    protected $fields=[
        [
            "title"=>"Field Title",
            "name"=>"Field Name"
        ]
    ];
    protected $operations=[
        [
            "url"=>null,
            "action"=>null,
            "text"=>"This is text",
            "attributes"=>[]
        ]
    ];

    public function __construct(UrlGenerator $url = null, Factory $view)
    {
        $this->url = $url;
        $this->view = $view;
    }

    public function list(){return $this -> list;}
    public function setList($list){$this -> list = $list;}
    public function fields(){return $this -> fields;}
    public function setFields($fields){$this -> fields = $fields;}
    public function idField(){return $this -> idField;}
    public function setIdField($idField){$this -> idField = $idField;}

    public function operations(){return $this -> operations;}
    public function setOperations($operations){$this -> operations = $operations;}

    public function showOperation($record, $operation){
        //$operation=$this->operations[$n];
        $operation_url=null;
        $id=$this->idField;

        if(isset($operation["action"]) && !is_null($operation["action"])){
            $operation_url=$this->url->action($operation["action"],[$record->$id]);
        }
        if(isset($operation["url"]) && !is_null($operation["url"])){
            $operation_url=$this->url->to($operation["url"],[$record->$id]);
        }

        $html='<a href="'.$operation_url.'"';
        foreach($operation["attributes"] as $attr=>$val){
            $html.=' '.$attr.'="'.$val.'"';
        }
        $html.='>'.$operation["text"].'</a>';

        return $html;
    }

}