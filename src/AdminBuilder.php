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
        /*[
            "header"=>"Field Header",
            "name"=>"Field Name"
        ]*/
    ];
    protected $operations=[
        /*[
            "url"=>null,
            "action"=>null,
            "text"=>"This is text",
            "attributes"=>[],
            "condition"=>[
                "column"=>"column_name",
                "test"=>" > 1"
            ],
            "alt_url"=>null,
            "alt_action"=>null,
            "alt_text"=>"This is text",
        ]*/
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

    public function processField($record, $field_name,$field_separator="."){
        $field_pieces = explode($field_separator,$field_name);
        $value=$record;
        foreach($field_pieces as $f){
            $value = $value->$f;
        }
        return $value;
    }

    public function showOperation($record, $operation){
        $operation_url=null;
        $html="";
        $condition=TRUE;

        $id=$this->idField;

        if(isset($operation["condition"]) && is_array($operation["condition"])){
            $condition_field=$operation["condition"]["column"];
            $value=$record->$condition_field;
            eval("\$condition=('".$value."'".$operation["condition"]["test"].");");
        }

        $url="url";
        $action="action";
        $text="text";

        if(!$condition){
            $action="alt_".$action;
            $operation_url="alt_".$operation_url;
            $text="alt_".$text;
        }

        if(isset($operation[$action]) && !is_null($operation[$action])){
            $operation_url=$this->url->action($operation[$action],[$record->$id]);
        }else if(isset($operation[$url]) && !is_null($operation[$url])){
            $operation_url=$this->url->to($operation[$url],[$record->$id]);
        }

        $html='<a href="'.$operation_url.'"';
        foreach($operation["attributes"] as $attr=>$val){
            $html.=' '.$attr.'="'.$val.'"';
        }
        $html.='>'.$operation[$text].'</a>';

        return $html;
    }

}