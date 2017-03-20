<?php

class admin extends medoo
{
	public function cat_list()
	{
		$datas = $this->select("shop_cat", [
			"id",
			"catname"
		], [
			"ORDER" => "id"
		]);

		return $datas;
	}

	public function cat_add( $catname )
	{
		$last_cat_id = $this->insert("shop_cat", [
			"catname" => $catname
		]);

		return $last_cat_id;
	}

	public function cat_update( $cat )
	{
		$update_num = $this->update("shop_cat", [
			"catname" => $cat['catname']
		], [
			"id[=]" => $cat['id']
		]);

		return $update_num;
	}

	public function data_delete( $table , $id )
	{
		$delete_num = $this->delete($table, [
			"id[=]" => $id
		]);

		return $delete_num;
	}

	public function content_list( $deadline )
	{
		$datas = $this->select("shop_content", [
			"id",
			"title",
			"cat",
			"date",
			"picture",
			"url"
		], [
			"date[>]" => $deadline,
			"ORDER" => "date DESC",
			"ORDER" => "id DESC"
		]);

		return $datas;
	}

	public function dead_list( $deadline )
	{
		$datas = $this->select("shop_content", [
			"id",
			"title",
			"cat",
			"date",
			"picture",
			"url"
		], [
			"date[<=]" => $deadline,
			"ORDER" => "date DESC"
		]);

		return $datas;
	}

	public function content_add( $content )
	{
		$last_content_id = $this->insert("shop_content", [
			"title" => $content['title'],
			"cat" => $content['cat'],
			"date" => $content['date'],
			"picture" => $content['picture'],
			"url" => $content['url'],
		]);

		return $last_content_id;
	}

	public function get_content_by_id( $id )
	{
		$datas = $this->select("shop_content", [
			"id",
			"title",
			"cat",
			"date",
			"picture",
			"url"
		], [
			"id[=]" => $id
		]);

		return $datas;
	}

	public function content_update( $content )
	{
		$update_num = $this->update("shop_content", [
			"title" => $content['title'],
			"cat" => $content['cat'],
			"date" => $content['date'],
			"picture" => $content['picture'],
			"url" => $content['url']
		], [
			"id[=]" => $content['id']
		]);

		return $update_num;
	}

	public function passwd_update( $passwd )
	{
		$update_num = $this->update("shop_user", [
			"password" => $passwd
		], [
			"username[=]" => $_SESSION['user']
		]);

		return $update_num;
	}

	public function cat_to_name( $catid )
	{
		$datas = $this->select("shop_cat", [
			"catname"
		], [
			"id[=]" => $catid
		]);

		return $datas[0]['catname'];
	}
	public function cus_list()
	{
		$datas = $this->select("customers", [
			"cus_no",
			"comp_name",
			"cus_name",
			"phone_no",
			"sales_man",
			"update_time"
		], [
			"ORDER" => "cus_no"
		]);

		return $datas;
	}

	public function get_cuss_by_no( $id )
	{
		$datas = $this->select("customers", [
			"cus_no",
			"comp_name",
			"cus_name",
			"phone_no",
			"sales_man",
			"update_time"
		], [
			"cus_no[=]" => $id
		]);

		return $datas;
	}
		public function cus_add( $content )
	{
		$last_cus_no = $this->insert("customers", [
			"cus_no" => $content['cus_no'],
			"comp_name" => $content['comp_name'],
			"cus_name" => $content['cus_name'],
			"phone_no" => $content['phone_no'],
			"sales_man" => $content['sales_man'],
			"update_time" => $content['update_time']
		]);

		return $last_cus_no;
	}
	public function cuss_update( $cuss )
        {
                $update_num = $this->update("customers", [
                        "comp_name" => $cuss['comp_name'],
                        "cus_name" => $cuss['cus_name'],
                        "phone_no" => $cuss['phone_no'],
                        "sales_man" => $cuss['sales_man'],
                        "update_time" => $cuss['update_time']
                ], [    
                        "cus_no[=]" => $cuss['cus_no']
                ]);

                return $update_num;
        }


	public function cus_delete( $table , $id )
	{
		$delete_num = $this->delete($table, [
			"cus_no[=]" => $id
		]);

		return $delete_num;
	}
        public function sales_all()
        {
                $datas = $this->query("SELECT sum(b.buy_price*a.sales_qty) as buy_amnt,sum(a.sales_price*a.sales_qty) as sales_amnt,(sum(a.sales_price*a.sales_qty)-sum(b.buy_price*a.sales_qty))/1.17 as net_margin,((sum(a.sales_price*a.sales_qty)-sum(b.buy_price*a.sales_qty))/1.17)/sum(a.sales_price*a.sales_qty) as net_margin_rate FROM sales a,items b WHERE a.item_no=b.item_no")->fetchALL();

                return $datas;

        }

	public function sales_daily()
	{
		$datas = $this->query("SELECT a.sales_date as sales_date,sum(b.buy_price*a.sales_qty) as buy_amnt,sum(a.sales_price*a.sales_qty) as sales_amnt,(sum(a.sales_price*a.sales_qty)-sum(b.buy_price*a.sales_qty))/1.17 as net_margin,((sum(a.sales_price*a.sales_qty)-sum(b.buy_price*a.sales_qty))/1.17)/sum(a.sales_price*a.sales_qty) as net_margin_rate FROM sales a,items b WHERE a.item_no=b.item_no group by a.sales_date order by a.sales_date desc")->fetchALL();

                return $datas;

	}
	public function ord_list()
	{
		$datas = $this->select("orders", [
			"order_no",
			"supplier_name",
			"order_date",
			"item_no",
			"item_name",
			"receive_qty",
			"receive_price",
			"sales_man"
		], [
			"ORDER" => "order_no DESC",
			"LIMIT" => 10
		]);
		return $datas;
	}
        public function sal_list()
        {
                $datas = $this->select("sales", [
                        "sales_no",
                        "sales_date",
                        "comp_name",
                        "item_no",
                        "item_name",
                        "sales_qty",
                        "sales_price",
                        "sales_man"
                ], [
                        "ORDER" => "sales_no DESC",
                        "LIMIT" => 10
                ]);
                return $datas;
        }

        public function sales_add( $content )
        {
                $last_sales_id = $this->insert("sales", [
                        "sales_no" => $content['sales_no'],
                        "sales_date" => $content['sales_date'],
                        "comp_name" => $content['comp_name'],
                        "item_no" => $content['item_no'],
                        "item_name" => $content['item_name'],
			"sales_qty" => $content['sales_qty'],
			"sales_price" => $content['sales_price'],
			"sales_man" => $content['sales_man']
                ]);

                return $last_sales_id;
        }
	public function sales_delete( $table , $id )
        {
                $delete_num = $this->delete($table, [
                        "sales_no[=]" => $id
                ]);

                return $delete_num;
        }

	public function orders_add( $content )
        {
                $last_orders_id = $this->insert("orders", [
                        "order_no" => $content['order_no'],
                        "supplier_name" => $content['supplier_name'],
                        "order_date" => $content['order_date'],
                        "item_no" => $content['item_no'],
                        "item_name" => $content['item_name'],
                        "receive_qty" => $content['receive_qty'],
                        "receive_price" => $content['receive_price'],
                        "sales_man" => $content['sales_man']
                ]);

                return $last_orders_id;
        }
	public function orders_delete( $table , $id )
        {
                $delete_num = $this->delete($table, [
                        "order_no[=]" => $id
                ]);

                return $delete_num;
        }

	public function sales_man_list()
        {
                $datas = $this->select("salesman", [
                        "sales_man_no",
                        "sales_man_name"
                ], [    
                        "ORDER" => "sales_man_no"
                ]);

                return $datas;
        }




}
