<?php 
class ControllerProductSearch extends Controller { 	
	public function index() { 
    	$this->language->load('product/search');
		
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');
		
		$this->load->model('tool/image'); 

		
		if (isset($this->request->get['term'])) {
			$search = $this->request->get['term'];
		} else {
			$search = '';
		} 


		
		if (isset($this->request->get['tag'])) {
			$tag = $this->request->get['tag'];
		} elseif (isset($this->request->get['term'])) {
			$tag = $this->request->get['term'];
		} else {
			$tag = '';
		} 
				
		if (isset($this->request->get['description'])) {
			$description = $this->request->get['description'];
		} else {
			$description = '';
		} 
				
		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} else {
			$category_id = 0;
		} 
		
		if (isset($this->request->get['sub_category'])) {
			$sub_category = $this->request->get['sub_category'];
		} else {
			$sub_category = '';
		} 
								
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		} 

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
  		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}
		
		if (isset($this->request->get['term'])) {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->request->get['term']);
		} else {
			$this->document->setTitle($this->language->get('heading_title') .  ' - ' . $this->language->get('all_products'));
		} 

		  
		$this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');  

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array( 
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('product/search'), 
      		'separator' => false 
   		);    
		      
		$url = '';
		   
		if (isset($this->request->get['term'])) {
			$url .= 'term=' . urlencode(html_entity_decode($this->request->get['term'], ENT_QUOTES, 'UTF-8'));
		}
		
		if (isset($this->request->get['tag'])) {
			$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
		}
				
		if (isset($this->request->get['description'])) {
			$url .= '&description=' . $this->request->get['description'];
		}
				
		if (isset($this->request->get['category_id'])) {
			$url .= '&category_id=' . $this->request->get['category_id'];
		}
		
		if (isset($this->request->get['sub_category'])) {
			$url .= '&sub_category=' . $this->request->get['sub_category'];
		}
		
		/*if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}	

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}*/
				
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}	
		
		if (isset($this->request->get['limit'])) {
			$url .= '&limit=' . $this->request->get['limit'];
		}
						
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('product/search', $url),
      		'separator' => $this->language->get('text_separator')
   		);
		
		if (isset($this->request->get['term'])) { 
    		$this->data['heading_title'] = $this->language->get('heading_title') .  ' - ' . $this->request->get['term'];
		} else {
			$this->data['heading_title'] = $this->language->get('heading_title').  ' - ' . $this->language->get('all_products');
		}
		
		$this->data['text_empty'] = $this->language->get('text_empty');
    	$this->data['text_critea'] = $this->language->get('text_critea');
    	$this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_keyword'] = $this->language->get('text_keyword');
		$this->data['text_category'] = $this->language->get('text_category');
		$this->data['text_sub_category'] = $this->language->get('text_sub_category');
		$this->data['text_quantity'] = $this->language->get('text_quantity');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_model'] = $this->language->get('text_model');
		$this->data['text_price'] = $this->language->get('text_price');
		$this->data['text_tax'] = $this->language->get('text_tax');
		$this->data['text_points'] = $this->language->get('text_points');
		$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$this->data['text_display'] = $this->language->get('text_display');
		$this->data['text_list'] = $this->language->get('text_list');
		$this->data['text_grid'] = $this->language->get('text_grid');		
		$this->data['text_sort'] = $this->language->get('text_sort');
		$this->data['text_limit'] = $this->language->get('text_limit');
		
		$this->data['entry_search'] = $this->language->get('entry_search');
    	$this->data['entry_description'] = $this->language->get('entry_description');
		  
    	$this->data['button_search'] = $this->language->get('button_search');
		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['button_wishlist'] = $this->language->get('button_wishlist');
		$this->data['button_compare'] = $this->language->get('button_compare');
		$this->data['sendmail_text']=$this->language->get('sendmail_text');

		$this->data['compare'] = $this->url->link('product/compare');
		
		$this->load->model('catalog/category');
		
		// 3 Level Category Search
		$this->data['categories'] = array();
					
		$categories_1 = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories_1 as $category_1) {
			$level_2_data = array();
			
			$categories_2 = $this->model_catalog_category->getCategories($category_1['category_id']);
			
			foreach ($categories_2 as $category_2) {
				$level_3_data = array();
				
				$categories_3 = $this->model_catalog_category->getCategories($category_2['category_id']);
				
				foreach ($categories_3 as $category_3) {
					$level_3_data[] = array(
						'category_id' => $category_3['category_id'],
						'name'        => $category_3['name'],
					);
				}
				
				$level_2_data[] = array(
					'category_id' => $category_2['category_id'],	
					'name'        => $category_2['name'],
					'children'    => $level_3_data
				);					
			}
			
			$this->data['categories'][] = array(
				'category_id' => $category_1['category_id'],
				'name'        => $category_1['name'],
				'children'    => $level_2_data
			);
		}
		
		$this->data['products'] = array();
		
		
		if (isset($this->request->get['term']) || isset($this->request->get['filter_tag'])) {
			$data = array(
				'filter_name'         => $search, 
				'filter_tag'          => $tag, 
				'filter_description'  => $description,
				'filter_category_id'  => $category_id, 
				'filter_sub_category' => $sub_category, 
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);
		}
		else 
		{
			$data = array(
				'filter_name'         => $search, 
				'filter_tag'          => $tag, 
				'filter_description'  => $description,
				'filter_category_id'  => $category_id, 
				'filter_sub_category' => $sub_category, 
				'sort'                => $sort,
				'order'               => $order,
				'start'               => ($page - 1) * $limit,
				'limit'               => $limit
			);
		}
					
			$product_total_new = $this->model_catalog_product->getTotalProducts($data);
								
			$results_new = $this->model_catalog_product->getProducts($data);
           
			$newarrivalProductIDS = explode(',', $this->config->get('featured_product'));	

			foreach ($results_new as $result) {

				$currProductID = $result['product_id'];
				$isNewArrivalKEY = in_array($currProductID, $newarrivalProductIDS);

				$productNewArrival = 0;

				if($isNewArrivalKEY)
				{
					$productNewArrival = 1;
				}
				
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = false;
				}  
				
				//this for swap image
				
				$images = $this->model_catalog_product->getProductImages($result['product_id']);

            if(isset($images[0]['image']) && !empty($images[0]['image'])){
                  $images =$images[0]['image'];
               } 
			   
				//
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					/*$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));*/
                                        $price = $this->currency->format($this->tax->calculate($result['price'], 0, $this->config->get('config_tax')));
				} else {
					$price = false;
				}
				
				if ((float)$result['special']) {
					/*$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));*/
                                        $special = $this->currency->format($this->tax->calculate($result['special'], 0, $this->config->get('config_tax')));
				} else {
					$special = false;
				}	
				
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}				
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
			
				$this->data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'] . $url),
					// for swap image
				'thumb_swap'  => $this->model_tool_image->resize($images, $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height')), 
				//
				// for saving percentage
				'is_newarrival' => $productNewArrival,
				'saving'	=> round((($result['price'] - $result['special'])/$result['price'])*100, 0),
				'quantity'  => $result['quantity'],
				//
				);
			
					
			$url = '';
			
			if (isset($this->request->get['term'])) {
				$url .= 'term=' . urlencode(html_entity_decode($this->request->get['term'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}
					
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
			
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}
					
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
						
			$this->data['sorts'] = array();
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/search', 'sort=p.sort_order&order=ASC' . $url)
			);
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/search', 'sort=pd.name&order=ASC' . $url)
			); 
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/search', 'sort=pd.name&order=DESC' . $url)
			);
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/search', 'sort=p.price&order=ASC' . $url)
			); 
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/search', 'sort=p.price&order=DESC' . $url)
			); 
			
			if ($this->config->get('config_review_status')) {
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/search', 'sort=rating&order=DESC' . $url)
				); 
				
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/search', 'sort=rating&order=ASC' . $url)
				);
			}
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/search', 'sort=p.model&order=ASC' . $url)
			); 
	
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/search', 'sort=p.model&order=DESC' . $url)
			);
	
			$url = '';
			
			if (isset($this->request->get['term'])) {
				$url .= 'term=' . urlencode(html_entity_decode($this->request->get['term'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['tag'], ENT_QUOTES, 'UTF-8'));
			}
					
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
			
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}
						
			/*if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}*/ 
			
			$this->data['limits'] = array();
	
			$limits = array_unique(array($this->config->get('config_catalog_limit'), 25, 50, 75, 100));
			
			sort($limits);
	
			foreach($limits as $limits){
				$this->data['limits'][] = array(
					'text'  => $limits,
					'value' => $limits,
					'href'  => $this->url->link('product/search', $url . '&limit=' . $limits)
				);
			}
					
			$url = '';
	
			if (isset($this->request->get['term'])) {
				$url .= 'term=' . urlencode(html_entity_decode($this->request->get['term'], ENT_QUOTES, 'UTF-8'));
			}
			
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . urlencode(html_entity_decode($this->request->get['filter_tag'], ENT_QUOTES, 'UTF-8'));
			}
					
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
			
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}
										
			/*if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	
	
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}*/
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
			$pagination = new Pagination();
			$pagination->total = $product_total_new;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/search', $url . '&page={page}');
			
			$this->data['pagination'] = $pagination->render();
		}	
		
		$this->data['search'] = $search;
		$this->data['description'] = $description;
		$this->data['category_id'] = $category_id;
		$this->data['sub_category'] = $sub_category;
				
		$this->data['sort'] = $sort; 
		$this->data['order'] = $order;
		$this->data['limit'] = $limit;
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/search.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/search.tpl';
		} else {
			$this->template = 'default/template/product/search.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
				
		$this->response->setOutput($this->render());
  	}
	
	
	// search autofill
	//<![CDATA[    
	public function ajax()
	{     
		 
		// Contains results
		$data = array();
		if( isset($this->request->get['keyword']) ) {
			// Parse all keywords to lowercase
			$keywords = strtolower( $this->request->get['keyword'] );
			// Perform search only if we have some keywords
			if( strlen($keywords) >= 2 ) {
				$parts = explode( ' ', $keywords );
				$add = '';
				// Generating search
				foreach( $parts as $part ) {
					$add .= ' AND (LOWER(pd.name) LIKE "%' . $this->db->escape($part) . '%"';
					$add .= ' OR LOWER(p.model) LIKE "%' . $this->db->escape($part) . '%")';
				}
				$add = substr( $add, 4 );
				$sql  = 'SELECT pd.product_id, pd.name, p.model FROM ' . DB_PREFIX . 'product_description AS pd ';
				$sql .= 'LEFT JOIN ' . DB_PREFIX . 'product AS p ON p.product_id = pd.product_id ';
				$sql .= 'LEFT JOIN ' . DB_PREFIX . 'product_to_store AS p2s ON p2s.product_id = pd.product_id ';
				$sql .= 'WHERE ' . $add . ' AND p.status = 1 ';
				$sql .= 'AND pd.language_id = ' . (int)$this->config->get('config_language_id');
				$sql .= ' AND p2s.store_id =  ' . (int)$this->config->get('config_store_id'); 
				$sql .= ' ORDER BY p.sort_order ASC, LOWER(pd.name) ASC, LOWER(p.model) ASC';
				$sql .= ' LIMIT 15';
				$res = $this->db->query( $sql );
				if( $res ) {
					$data = ( isset($res->rows) ) ? $res->rows : $res->row;
	
					// For the seo url stuff
					//$basehref = 'product/product&keyword=' . $this->request->get['keyword'] . '&product_id=';
					$basehref = 'product/product&product_id=';
					foreach( $data as $key => $values ) {
						$data[$key] = array(
							'name' => htmlspecialchars_decode($values['name'] . ' (' . $values['model'] . ')', ENT_QUOTES),
							'href' => $this->url->link($basehref . $values['product_id'])
						);
					}
				}
			}
		}
		echo json_encode( $data ); 
	}

	 public function autocomplete() {



                        $json = array();

                    
                        if (isset($this->request->get['filter_name'])) {
                            
                            $this->load->model('catalog/product');
                            

                            $filter_name = $this->request->get['filter_name']; // posted by the ajax request
                            
                            $filter_description = 'false'; // used a string instead of a pure boolean to avoid 
                                                           // converting this var into boolean in all the other scripts 
                                                           // that make use of it
                            $adsmart_search_relevance = $this->config->get('adsmart_search_relevance');
                            if (isset($adsmart_search_relevance['description'])){
                                $filter_description = 'true';
                            }
                            
                            
                            
                            // Get the sort order:
                            
                            $sort_order = explode('-', $this->config->get('adsmart_search_sort_order'));
                            $sort       = isset($sort_order[0]) ? $sort_order[0] : '';
                            $order      = isset($sort_order[1]) ? $sort_order[1] : '';
    
                            $start  = 0;
                            
                            
                            // The maximum number of displayed results can be dynamically modified from the admin control panel,
                            // in that case the parameter 'admin_dropdown_limit' is posted to this function, otherwise the limit
                            // is read from the database.
                            
                            if (isset ($this->request->get['admin_dropdown_limit'])) {
                                $limit = $this->request->get['admin_dropdown_limit'];
                            }
                            else {
                                $limit = $this->config->get('adsmart_search_dropdown_max_num_results');
                            }
                            
                    
                            $filter_data = array(
                            
                                'live_search'           => true, // this flag tells if the request comes from the Live Search
                            
                                'filter_name'           => $filter_name,
                                'filter_tag'            => '',
                                'filter_description'    => $filter_description,
                                'filter_category_id'    => 0,
                                'filter_sub_category'   => '',
                            //  'filter_manufacturer_id'=> '',
                                'sort'                  => $sort,
                                'order'                 => $order,
                                'start'                 => $start,
                                'limit'                 => $limit
                            );
                            
                            $products = $this->model_catalog_product->adsmart_search_getProducts($filter_data);
                            
                            $this->load->model('tool/image');

                
                $filters= array(
                
                    'filter_name'           =>  'search',
                    'filter_tag'            =>  'tag',
                    'filter_description'    =>  'description',
                    'filter_category_id'    =>  'category_id',
                    'filter_sub_category'   =>  'sub_category'
                );

                foreach ($filters as $old => $new){

                    if (isset($this->request->get[$old])) {
                        $this->request->get[$new] = $this->request->get[$old];
                    } 
                    if (isset($this->request->get[$new])) {
                        $this->request->get[$old] = $this->request->get[$new];
                    } 
                }

                
                            
                            if ($this->config->get('adsmart_search_dropdown_img_size') !=''){
                                $img_width = 50;
                            }
                            else {
                                $img_width = 50;
                            }
                            

                        
                            foreach ($products as $product) {

                                if ($product) {
                                    if ($product['image']) {
                                        

                                    //Enable this code if you want a perfect resizing, without white spaces:
                                    /*          
                                        $img_info = getimagesize(DIR_IMAGE.$product['image']); // returns an array of values, $img_info[0] is the width, $img_info[1] is the height
                                        $h_w_ratio = $img_info[1] / $img_info[0];
                                        $img_height = round($img_width * $h_w_ratio);
                                        $image = $this->model_tool_image->resize($product['image'], $img_width, $img_height);
                                    */
                                    
                                    //  Comment this line if the above code is not commented:
                                        $image = $this->model_tool_image->resize($product['image'], $img_width, $img_width);
                                        
                                    } else {
                                    
                                        $image = $this->model_tool_image->resize('img_not_found.gif', $img_width, $img_width);
                                    }

                                    
                                    // $this->config->get('config_customer_price') is the flag under System -> Settings -> Tab Options -> Account
                                    // (Only show prices when a customer is logged in)
                                    
                                    if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                                        $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
                                    } else {
                                        $price = '';
                                    }
                                    
                                    if ( (float)$product['special'] && (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) ) {
                                        $special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));
                                    } else {
                                        $special = '';
                                    }
                                    
                                    if ($this->config->get('config_review_status')) {
                                        $rating = $product['rating'];
                                    } else {
                                        $rating = false;
                                    }
                                    
                                    $json[] = array(
                                        'product_id' => $product['product_id'],
                                        'image'      => $image,
                                        'name'       => strip_tags(html_entity_decode($product['name'], ENT_QUOTES, 'UTF-8')),  
                                        'model'      => $product['model'],
                                        'price'      => $price,
                                        'special'    => $special,
                                        'option'     => '',
                                        'rating'     => $rating,
                                        'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product['reviews']),
                                        'href'       => $this->url->link('product/product', 'product_id=' . $product['product_id']) 
                                    );
                                }
                            }
                        }
        
        
                        // Add debug info
                        if (ADSMART_SRC_DEBUG || ADSMART_SRC_DEBUG_SHOW_SQL || ADSMART_SRC_SPEED_TEST ) {
                            global $adsmart_src_debug;
                            $json[] = array(
                                'debug' => $adsmart_src_debug
                            );                      
                        }                   
                        $this->response->setOutput(json_encode($json));
                    }
	//]]>
	// end search auto fill
	//]]>
	// end search auto fill
}
?> 