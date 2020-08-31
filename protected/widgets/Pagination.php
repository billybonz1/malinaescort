<?php
class Pagination extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        $forms=Form::model()->getFormsList($_GET);
        $count=sizeof($forms);
        $limit = 20;
        $page=1;
        if(isset($_GET['limit'])&&!empty($_GET['limit'])){
            $limit=(int)$_GET['limit'];
        }
        if($count!=0){
            $pages = ceil($count/$limit);
        }
        if(isset($_GET['page'])&&!empty($_GET['page'])){
            $page=(int)$_GET['page'];
        }

        if($count!=0){
            $this->render('Pagination',[
                    'pages'=>$pages,
                    'page'=>$page,
                    'limit'=>$limit,
                ]);
        }
    }
}