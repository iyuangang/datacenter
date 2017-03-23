<?php

class indexController extends medoo
{
    function index()
    {
        $date = get('time');
        switch ($date) {
        case 'today':
            $datas['time'] = 'today';
            break;
        case 'yestoday':
            $datas['time'] = 'yestoday';
            break;
        case 'before':
            $datas['time'] = 'before';
            break;
        default:
            $datas['time'] = 'today';
            break;
        }
        $datas['title'] = 'TTMAI DATA CENTER';
        $database = new index();
        $datas['cats'] = $database->get_cats();

        $this->display( $datas );
    }

    function cat()
    {
        $catid = get('id');
        $datas['title'] = 'ttmai data center';
        $datas['catid'] = $catid;
        $database = new index();
        $datas['cats'] = $database->get_cats();

        $this->display( $datas );
    }

    function more()
    {
        $date = get('time');
        switch ($date) {
        case 'today':
            $time = date('Y-m-d',time());
            break;
        case 'yestoday':
            $time = date('Y-m-d',strtotime('-1 day'));
            break;
        case 'before':
            $time = date('Y-m-d',strtotime('-2 day'));
            break;
        }
        $database = new index();
        $datas['contents'] = $database->get_contents( $time );

        $data = $datas['contents'];

        $result = $database->get_more( $data );
        echo $result;
    }

    function cat_more()
    {
        $catid = get('id');
        $database = new index();
        $datas['contents'] = $database->cat_contents( $catid );

        $data = $datas['contents'];
        //print_r($data);

        $result = $database->get_more( $data );
        echo $result;
    }
        function custumers()
        {

            $database = new index();
            $datas['all_customers'] = $database->customers( $cus_no );

            $data = $datas['contents'];
            //print_r($data);

            $result = $database->get_more( $data );
            echo $result;
    }
}
