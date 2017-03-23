<?php

class index extends medoo
{
    public function get_customers()
    {
        $datas = $this->select("customers", [
            "cus_no",
            "comp_name",
            "sales_man",
            "cus_name",
            "phone_no",
            "update_time"
        ], [
            "ORDER" => "cus_no"
        ]);

        return $datas;
    }

    public function get_cats()
    {
        $datas = $this->select("shop_cat", [
            "id",
            "catname"
        ], [
            "ORDER" => "id"
        ]);

        return $datas;
    }

    public function get_contents( $time )
    {
        $datas = $this->select("shop_content", [
            "id",
            "title",
            "cat",
            "date",
            "picture",
            "url"
        ], [
            "date[=]" => $time,
            "ORDER" => "id DESC"
        ]);

        return $datas;
    }

    public function cat_contents( $catid )
    {
        $today = date('Y-m-d',time());
        $deadline = date('Y-m-d',strtotime('-3 day'));

        $datas = $this->select("shop_content", [
            "id",
            "title",
            "cat",
            "date",
            "picture",
            "url"
        ], [
            "AND" => [
                "cat[=]" => $catid,
                "date[>]" => $deadline,
                "date[<=]" => $today
            ]
        ]);

        return $datas;
    }

    public function get_more( $data )
    {
        // Create instance of picture database with 10 items per page and our data as source
        $pictureDatabase = new picture($data, 10);

        $result = array(
            'success' => TRUE,
            'message' => 'Retrieved pictures',
            'data' => array()
        );

        $callback = isset($_REQUEST['callback']) ? $_REQUEST['callback'] : false;

        // Get requested page number from request and return error message if parameter is not a number
        $page = 1;
        try {
            $page = intval($_REQUEST['page']);
        } catch (Exception $e) {
            $result['success'] = FALSE;
            $result['message'] = 'Parameter page is not a number';
        }

        // Get data from database
        $result['data'] = $pictureDatabase->getPage($page);

        if (count($result['data']) == 0 || $page >= $pictureDatabase->getNumberOfPages()) {
            $result['success'] = TRUE;
            $result['message'] = 'No more pictures';
        }

        // Encode data as json or jsonp and return it
        if ($callback) {
            header('Content-Type: application/javascript');
            $result_data =  $callback.'('.json_encode($result).')';
        } else {
            header('Content-Type: application/json');
            $result_data = json_encode($result);
        }
        return $result_data;
    }
}
