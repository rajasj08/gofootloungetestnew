<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class ControllerModuleSuperCategoryMenuAdvanced extends Controller {
	
	public function index() {   
 
			//$this->session->data['custom_filter'] = "";   
			//echo $this->request->get['path']; die;
			$this->data['filterid_val']=$this->request->get['path'];
			//echo $this->request->get['path']; die;
			//echo "hgh"; die;
		      // echo "session".$this->session->data['new2'];   
	       if(!isset($this->request->get['a'])){
	
			$DIR_MY_STYLES_2= 'catalog/view/javascript/jquery/supermenu/templates/';
			$settings_module=$this->config->get('supercategorymenuadvanced_settings');
			$this->document->addScript('catalog/view/javascript/jquery/supermenu/supermenu_base.js');
                        $this->document->addScript('catalog/view/javascript/jquery/jquery.total-storage.min.js');
			
			//Check menu styles
			if (isset($settings_module['styles'])){
				$template_styles=$settings_module['styles'];
			}else{
				$template_styles='default';
			} 
			if (file_exists($DIR_MY_STYLES_2 . $template_styles . '/supermenu.css')) {
				$this->document->addStyle($DIR_MY_STYLES_2 . $template_styles . '/supermenu.css');
			} else {
				$this->document->addStyle($DIR_MY_STYLES_2 . 'default/supermenu.css');
			}
			
			//Check slider style	
			if (isset($settings_module['skin_slider'])){
				$this->document->addStyle('catalog/view/javascript/jquery/supermenu/slider/skins/'.$settings_module['skin_slider'].'.css'); 
			}else{
				$this->document->addStyle('catalog/view/javascript/jquery/supermenu/slider/skins/jslider.yellow.classic.css');
			}
	
		}
	
	 if( (isset($this->request->get['route']) && $this->request->get['route']=="product/manufacturer") 
	   || isset($this->request->get['manufacturer_id']) ){
    			
			
			if (isset($this->request->get['manufacturer_id']) && $this->request->get['manufacturer_id']==0){
			
				// check if we are on manufacturer page and select manufacturer.
				 if (!empty($this->request->get['filter'])){
					$filtros = explode("@@",urldecode($this->request->get['filter']));
					list($part1,$name)=explode("=",$filtros[0]);
					list($dnd,$part2)=explode("_",$part1);
							
					$filter_parts=explode("-", $part2);  
						$tipo =$filter_parts[0];
						$id=$filter_parts[2];				
					
					if ((count($filtros)==1) && $tipo=="m"){
						$manufacturer_id=$id;
						 $this->CreateMenu("M",$manufacturer_id); 
					}else{
						 $this->CreateMenu("M",0);
					}
				 }
		   
		   }elseif(isset($this->request->get['manufacturer_id']) && $this->request->get['manufacturer_id']!=0){
			
				 $this->CreateMenu("M",$this->request->get['manufacturer_id']); 
			
		
		   }else{// dont exist manufacturer_id but we are in manufacturer page.
			
				 $this->CreateMenu("M",0); 
		
		
		}
	
	//if we are in home and select a brand we got to brands options.
	}elseif((isset($this->request->get['path']) && $this->request->get['path']==0)){
	
		  //if isset filter and is only one filter and is manufacturer we go to manufacturer filtering
		   if (!empty($this->request->get['filter'])){
		 	    $filtros = explode("@@",urldecode($this->request->get['filter']));
				list($part1,$name)=explode("=",$filtros[0]);
				list($dnd,$part2)=explode("_",$part1);
						
				$filter_parts=explode("-", $part2);  
					$tipo =$filter_parts[0];
					$id=$filter_parts[2];				
				
				if ((count($filtros)==1) && $tipo=="m"){
					$manufacturer_id=$id;
					 $this->CreateMenu("M",$manufacturer_id); 
				}else{
			  		 $this->CreateMenu("C",0);
				}
			   
		   }else{
			   
			    $this->CreateMenu("C",0);
		   }
		
	}else{ // we are not in manufacturer page
	
	
		if (isset($this->request->get['path'])) {
			$path = '';
			$parts = explode('_', (string)$this->request->get['path']);
			$category_id = array_pop($parts);
			 $this->CreateMenu("C",$category_id); 
		}else{
			$category_id = 0;
			 $this->CreateMenu("C",$category_id); 
		}
		
		}}
	
	

		
	public function CreateMenu($what,$id) {

		
		$category_id_val=$id;


		$this->load->model('module/supercategorymenuadvanced');
		$this->load->model('catalog/category');

		$filter_manufacturer_id=$filter_category_id=false;
        $url_where2go_brands='';
		
		if ($what=="M"){
			$super_id=$id;
			$url_where2go="manufacturer_id=".$id;
			$url_where2go.=(isset($this->request->get['path'])) ? '&path='.$this->request->get['path'] : "&path=0";
			$url_where2go_brands='manufacturer_id='.$id;
			$filter_manufacturer_id=$id;
		    $values_in_category= $this->config->get('VALORESM_'.$super_id, (int)$this->config->get('config_store_id') );
			//check if we select category on manufacturer page
			if (isset($this->request->get['path'])) {
				$path = '';
				$parts = explode('_', (string)$this->request->get['path']);
			 $filter_category_id= array_pop($parts);
				
			}else{
				$filter_category_id=0;
				
			}
		}elseif($what=="C"){
			$super_id=$id;
			$url_where2go=(isset($this->request->get['path'])) ? '&path='.$this->request->get['path'] : "path=0";
			if (isset($this->request->get['path'])) {
				$path = '';
				$parts = explode('_', (string)$this->request->get['path']);
			    $filter_category_id= array_pop($parts);
				
			}else{
				$filter_category_id=0;
				
			}
			$values_in_category= $this->config->get('VALORES_'.$super_id, (int)$this->config->get('config_store_id') );
        }
				
		//Load filter settings.
		$settings_module=$this->config->get('supercategorymenuadvanced_settings');
		
		//var to set speed to fade menu
		if (isset($settings_module['ajax']['speedmenu'])){
			$this->data['speedmenu']=$settings_module['ajax']['speedmenu'];
		}else{
			$this->data['speedmenu']=2000;
		}
		//var to set speed to fade results
		if (isset($settings_module['ajax']['speedresults'])){
			$this->data['speedresults']=$settings_module['ajax']['speedresults'];
		}else{
			$this->data['speedresults']=2000;
		}
		
		
		
		//check if loader is selected
		if (isset($settings_module['ajax']['loader'])){
			$this->data['loader']=$settings_module['ajax']['loader'];
		   if ($settings_module['ajax']['image']){
			   $this->data['loader_image']=HTTP_SERVER.'image/supermenu/loaders/'.$settings_module['ajax']['image'];
		   }else{
		   	   $this->data['loader_image']=HTTP_SERVER.'image/supermenu/loaders/103.png';
		   }
		}else{
			$this->data['loader']=false;
		}
				
		//variable with enable/disable count.
		if (isset($settings_module['see_more_trigger'])){
			$this->data['see_more_trigger']=$settings_module['see_more_trigger'];
		}else{
			$this->data['see_more_trigger']=0;
		}
		//variable with enable/disable count.
		if (isset($settings_module['option_tip'])){
			$this->data['option_tip']=$settings_module['option_tip'];
		}else{
			$this->data['option_tip']=0;
		}
		
		
		//variable with enable/disable count.
		if (isset($settings_module['countp'])){
			$this->data['count_products']=$settings_module['countp'];
			$count_products=$settings_module['countp'];
		}else{
			$this->data['count_products']=1;
			$count_products=1;
		}
		//variable with enable/disable follow.
		if (isset($settings_module['nofollow'])){
			$this->data['nofollow']='rel="nofollow"';
			$nofollow='rel="nofollow"';
			
		}else{
			$this->data['nofollow']='';
			$nofollow='';
		}
		//variable with enable/disable tracking.
		if (isset($settings_module['track_google'])){
			$this->data['track_google']=$settings_module['track_google'];
			$track_google=$settings_module['track_google'];
		}else{
			$this->data['track_google']=0;
			$track_google=0;
		}
		//variable with enable/disable ajax.		
		if (isset($settings_module['ajax']['ajax'])){
			$this->data['is_ajax']=$settings_module['ajax']['ajax'];
			$is_ajax=$settings_module['ajax']['ajax'];
		}else{
			$this->data['is_ajax']=0;
			$is_ajax=0;
		}
		
		
		$data_settings=array(
			'nofollow'	=>$nofollow,
			'track_google' =>$track_google,
			'count_products' =>$count_products
		);
				
		$idx=1;
		
		if (isset($settings_module['menu_filters'])){
			$this->data['menu_filters']=$settings_module['menu_filters'];
		}else{
			$this->data['menu_filters']=1;
		}
		
		if(version_compare(VERSION,'1.5.5','>')) {
		    
			if (isset($this->request->get['search'])) {
				$filter_name = $this->request->get['search'];
			} else {
				$filter_name = '';
			} 
		
		}else{
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			} 
			
		}

		
		if (isset($this->request->get['filter_tag'])) {
			$filter_tag = $this->request->get['filter_tag'];
		
		} else {
			$filter_tag = '';
		} 
				
		if (isset($this->request->get['filter_description'])) {
			$filter_description = $this->request->get['filter_description'];
		} else {
			$filter_description = '';
		} 
		
		if (isset($this->request->get['filter_category_id'])) {
			
			if ($super_id==0){
				$super_id = $this->request->get['filter_category_id'];
			}
		} else {
			$filter_category_id = $filter_category_id;
		} 
		
		if (isset($this->request->get['filter_sub_category'])) {
			$filter_sub_category = $this->request->get['filter_sub_category'];
		} else {
			$filter_sub_category = '';
		} 
		
		$url_pr='';
		if (isset($this->request->get['PRICERANGE'])) {
			$url_pr.= '&amp;PRICERANGE=' . $this->request->get['PRICERANGE'];
	        $price_range_filter= false;
	        $price_range_filter_new = $this->request->get['PRICERANGE'];
		
		}else{
			$this->data['enable_pricerange']=false;
			$price_range_filter=false;
		}
		
		if (isset($this->request->get['C'])) {
			$url_pr.= '&amp;C=' . $this->request->get['C'];
			$filter_coin=$this->request->get['C'];
		}else{
			$url_pr.= '&amp;C=' . $this->config->get('config_currency');
			$filter_coin=$this->config->get('config_currency');
		}
	
		//searh url filters
		$url_search='';
		
		if(version_compare(VERSION,'1.5.5','>')) {
			if (isset($this->request->get['search'])) {
				$url_search .= '&amp;search=' . $this->request->get['search'];
			}
		
		}else{
			if (isset($this->request->get['filter_name'])) {
			$url_search .= '&amp;filter_name=' . $this->request->get['filter_name'];
		    }
			
		}
		if (isset($this->request->get['filter_tag'])) {
			$url_search .= '&amp;filter_tag=' . $this->request->get['filter_tag'];
		}
				
		if (isset($this->request->get['filter_description'])) {
			$url_search .= '&amp;filter_description=' . $this->request->get['filter_description'];
		}
						
		if (isset($this->request->get['filter_category_id'])) { 
			$url_search .= '&amp;filter_category_id=' . $this->request->get['filter_category_id'];
		}
		if (isset($this->request->get['filter_sub_category'])) {
			$url_search .= '&amp;filter_sub_category=' . $this->request->get['filter_sub_category'];
		}


		
		if (!isset($this->request->get['path']) or empty($this->request->get['path'])) {
			
			if (isset($this->request->get['filter_category_id'])) {
			
				$this->request->get['path']=$this->request->get['filter_category_id'];
			}else{
				$this->request->get['path']=0;
			}
		}
	
		$url_limits='';
	
		if (isset($this->request->get['sort'])) {
			$url_limits.= '&amp;sort=' . $this->request->get['sort'];
		}	
		if (isset($this->request->get['order'])) {
			$url_limits.= '&amp;order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['limit'])) {
			$url_limits.= '&amp;limit=' . $this->request->get['limit'];
		}

		
		//arrays with all values to construct the menu.-
		$this->data['values_selected'] = array();
		$this->data['values_no_selected'] = array();
		$this->data['categories']='';
		$filter = false;
		$tip_id=1;
		//load some language
		$this->language->load('module/supercategorymenuadvanced');
		
    	$this->data['heading_title'] 	= $this->language->get('heading_title');
		$see_more_text 					= $this->language->get('see_more_text');
		$remove_filter_text 			= $this->language->get('remove_filter_text'); 
		$pricerange_text 				= $this->language->get('pricerange_text');
		$manufacturer_text				= $this->language->get('manufacturer_text');
		$stock_text						= $this->language->get('stock_text');
		$no_data_text 					= $this->language->get('no_data_text');	
		$category_text 					= $this->language->get('category_text');
		$rating_text 					= $this->language->get('rating_text');
		
		$txt_reset_filter				= $this->language->get('txt_reset_filter');
		$this->data['entry_selected']   = $this->language->get('entry_selected');
		$this->data['entry_select_filter']= $this->language->get('entry_select_filter');
		$this->data['txt_your_selections'] = $this->language->get('txt_your_selections');
		$filter_array=array();
	 	//echo $stock_text; die;
		//init filters
		$filter_manufacturers_by_id='';	$filter_manufacturers_by_id_string='';	$filter_attributes_by_name='';
		$filter_attribute_id=''; $filter_options_by_name=''; $filter_option_id=''; $filter_attribute_string='';
		$filter_min_price=''; $filter_max_price='';	$filter_stock_id=''; $filter_by_name='';
		$filter_ids=''; $filter_stock=''; $filter_special=''; $filter_clearance='';	$filter_arrivals=''; $filter_width='';
		$filter_height=''; $filter_length=''; $filter_model='';	$filter_sku='';	$filter_upc='';	$filter_location='';$filter_productinfo_id='';
		$filter_weight='';$filter_options_by_ids=''; 
		$filter_ean=''; $filter_isbn=''; $filter_mpn=''; $filter_jan='';
		$filter_rating='';
		$filtros_seleccionados= array();
		
		$this->data['reset_all_filter']="<a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$this->url->link('product/asearch', $url_where2go)."&amp;filter=', ajaxurl:'".$url_where2go."&amp;filter=', gapush:'no'}\" href=\"javascript:void(0)\" nofollow><img src=\"image/supermenu/spacer.gif\" alt=\"".$txt_reset_filter."\" class=\"filter_del\" /></a>";
		
				
		///////////////////////////////////////////////////////////////////
		
		/* FIRST PART */
		//////////////////////////////////////////////////////////////////
		
		// GET VALUES SELECTED
		
		if (!empty($this->request->get['filter'])){
			$has_filter=$this->request->get['filter']; 
			$filter=true;
		}else{
			$has_filter=false;
			$filter=false;
		}
		
			$this->data['dndvalue'] = array();
		$dndval=array();

		if ($has_filter){
		
			$filter=true;



		$filtros1 = explode("@@",urldecode($this->request->get['filter']));

		for($z=0;$z<count($filtros1);$z++){

					list($part1,$name)=explode("=",$filtros1[$z]);
					list($dnd,$part2)=explode("_",$part1);

					array_push($dndval,$dnd);  
					//print_r($dnd); die;
				}
				array_push($this->data['dndvalue'],$dndval); 

			//print_r($this->data['dndvalue']); die;
		//BEGIN CHECKING FILTERS
		
			
		$filtros = explode("@@",$has_filter);
		
			foreach ($filtros as $filtro){
				//fix filter string for href[first_position-Second position - only this filter]
				$arr=array();
				$arr = array_diff($filtros,(array)$filtro);
				$links=implode ("@@",$arr);
				list($part1,$name)=explode("=",$filtro);
				list($dnd,$part2)=explode("_",$part1);
						
				$filter_parts=explode("-", $part2);  
					$tipo =$filter_parts[0];
					$special=$filter_parts[1];
					$id=$filter_parts[2];
						
				if (!empty($filter_parts[3])){
					$option_value_id=$filter_parts[3];
				}
						
				if ($special=="i"){
					$image=$this->model_module_supercategorymenuadvanced->getoptionImage($id,$name);
				}else{
					$image='';
				}
						
				$namefinal=html_entity_decode($name)=="NDDDDDN" ? html_entity_decode($no_data_text): html_entity_decode($name);
				        
				if($links){
				    $urlfilter='&amp;filter='.urlencode(str_replace("&amp;","&",$links));
					$hav_filter=1;
				}else{
				    $urlfilter='&amp;filter=';
					$hav_filter=0;
				}		
						
				$see_more_url="index.php?route=module/supercategorymenuadvancedseemore/seemore&amp;path=".$this->request->get['path'].$url_pr.$url_limits.$url_search."&amp;".$url_where2go."&amp;what=".$what."&amp;id=".$id."&amp;dnd=".urlencode($dnd)."&amp;tipo=".urlencode($tipo)."&amp;name=".urlencode($namefinal).$urlfilter;
						
				switch($tipo) {
					case 'a': //attribute
						$filter_options_by_ids.="0,";
						switch ($special){
							case 's':
							$filter_attributes_by_name.=$name."sATTNNATT";		
							$filter_attribute_id.=$id.",";	
							$filter_by_name.=$this->model_module_supercategorymenuadvanced->CleanName($name)."sATTNNATT@@@";
							$filter_ids.=$id.",";
							break;
							case 'p':
							$filter_attributes_by_name.=$name."pATTNNATT";		
							$filter_attribute_id.=$id.",";	
							$filter_by_name.=$this->model_module_supercategorymenuadvanced->CleanName($name)."pATTNNATT@@@";
							$filter_ids.=$id.",";
							break;
							case 'n':
							$filter_attributes_by_name.=$name."nATTNNATT";		
							$filter_attribute_id.=$id.",";	
							$filter_by_name.=$this->model_module_supercategorymenuadvanced->CleanName($name)."nATTNNATT@@@";
							$filter_ids.=$id.",";
							break;
						 }
					break;
					case 'm':
						$filter_manufacturers_by_id.=$id.",";
					break;	
			   		case 'o':
						$filter_options_by_name.=$name."OPTTOP";		
						$filter_option_id.=$id.",";	
						$filter_by_name.=$this->model_module_supercategorymenuadvanced->CleanName($name)."OPTTOP@@@";
						$filter_ids.=$id.",";
						$filter_options_by_ids.=$option_value_id.",";
					break;	
					case 'sc':
						$filter_clearance=true;
						$namefinal=$this->language->get('clearance_text');
						$dnd=$this->language->get('stock_text');
						$see_more_url=false;
						break;	
					case 'sn':
						$filter_arrivals=true;
						$namefinal=$this->language->get('new_products_text');
						$dnd=$this->language->get('stock_text');
						$see_more_url=false;
					break;		
					case 'ss':
						$filter_stock=true;
						$dnd=$this->language->get('stock_text');
						$see_more_url=false;
						$namefinal=$this->language->get('in_stock_text');
					break;		
					case 'sp':
						$filter_special=true;
						$dnd=$this->language->get('stock_text');
						$namefinal= $this->language->get('special_prices_text');
						$see_more_url=false;
					break;		
					case 'ra':
						$filter_rating=(int)$name;
						$dnd=$this->language->get('rating_text');
						$namefinal= $this->language->get('rating_text');
						
					break;	
		
		
					case 'w':
						switch ($special){
							case 's':
							$filter_width=$name;
							$filter_productinfo_id=$id.",";
							break;
							case 'n':
							$filter_width=$name;
							$filter_productinfo_id=$id.",";
							break;
							}
						break;	
					case 'h':
						switch ($special){
							case 's':
								$filter_height=$name;
								$filter_productinfo_id.=$id.",";
							break;
							case 'n':
								$filter_height=$name;
								$filter_productinfo_id.=$id.",";
								break;
							}
							break;								
					case 'l':
							switch ($special){
								case 's':
								$filter_length=$name;
								$filter_productinfo_id.=$id.",";
								break;
								case 'n':
								$filter_length=$name;
								$filter_productinfo_id.=$id.",";
								break;
								}
							break;									
					case 'sk':
							switch ($special){
								case 's':
								$filter_sku=$name;
								$filter_productinfo_id.=$id.",";
								break;
								case 'n':
								$filter_sku=$name;
								$filter_productinfo_id.=$id.",";
								break;
								}
							break;								
					case 'up':
							switch ($special){
							case 's':
							$filter_upc=$name;
							$filter_productinfo_id.=$id.",";
							break;
							case 'n':
									$filter_upc=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;	

							case 'lo':
								switch ($special){
									case 's':
									$filter_location=$name;
									$filter_productinfo_id.=$id.",";
									break;
									case 'n':
									$filter_location=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;
							case 'mo':
								switch ($special){
									case 's':
									$filter_model=$name;
									$filter_productinfo_id.=$id.",";
									break;
									case 'n':
									$filter_model=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;
							case 'wg':
								switch ($special){
									case 's':
									$filter_weight=$name;
									$filter_productinfo_id.=$id.",";
									break;
									case 'n':
									$filter_weight=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;	
							
							case 'e':
								switch ($special){
									case 's':
									$filter_ean=$name;
									$filter_productinfo_id.=$id.",";
									break;
									case 'n':
									$filter_ean=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;	
							
						   case 'i':
								switch ($special){
									case 's':
									$filter_isbn=$name;
									$filter_productinfo_id.=$id.",";
									break;
									case 'n':
									$filter_isbn=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;	
							case 'p':
								switch ($special){
									case 's':
									$filter_mpn=$name;
									$filter_productinfo_id.=$id.",";
									break;
				 					case 'n':
									$filter_mpn=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;	
		
							case 'j':
								switch ($special){
									case 's':
									$filter_jan=$name;
									$filter_productinfo_id.=$id.",";
									break;
									case 'n':
									$filter_jan=$name;
									$filter_productinfo_id.=$id.",";
									break;
									}
								break;	
													
							}
					
					//i . image	//n . normal //s . slider //t . select
							
					if ($tipo=="m"){ //we need to do this because we need to remove manufactured_id when delete manuafacturer from filter.
					
						$href=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch','path='.$this->request->get['path']).$url_pr.$url_limits.$url_search.$urlfilter);
						$ajax_url='path='.$this->request->get['path'].$url_pr.$url_limits.$url_search.$urlfilter;
					}else{
						//$href=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch','path='.$this->request->get['path']. $url_where2go).$url_pr.$url_limits.$url_search.$urlfilter);
						//$ajax_url='path='.$this->request->get['path'].$url_where2go.$url_pr.$url_limits.$url_search.$urlfilter;
					$href=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch',$url_where2go).$url_pr.$url_limits.$url_search.$urlfilter);
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$urlfilter;
					}
							
					$data_filtering=array();
					$data_filtering=array(
						'href' 				=> $href,
						'ajax_url'			=> $ajax_url,
						'see_more_text' 	=> $see_more_text,
						'remove_filter_text'=> $remove_filter_text,
						'name'				=> $namefinal,
						'see_more_url'		=> $see_more_url,
						'image'				=> $image,
						'filter_rating'		=> $filter_rating,
						'rating_extra_txt'  => $this->language->get('rating_text_'.$settings_module['reviews']['tipo'])
						
					);

					
					$html='';
				  		switch($special) {
							case 'i': //image
							$html.=$this->model_module_supercategorymenuadvanced->GetHtmlImageSelected($data_filtering,$data_settings);
							break;	
							case 'r': //image for reviws
							$html.=$this->model_module_supercategorymenuadvanced->GetHtmlImageSelectedReviews($data_filtering,$data_settings);
							break;	
							case 's': //slider
								//in order to prevent 0 products we need to fill this $html after filtering products.
							$html.="";
							break;		
							case 'p': //separator
							$html.=$this->model_module_supercategorymenuadvanced->GetHtmlSelected($data_filtering,$data_settings,$tipo);
							break;			
							case 'n': //list - select
							$html.=$this->model_module_supercategorymenuadvanced->GetHtmlSelected($data_filtering,$data_settings,$tipo);
						}
					
					$filtros_seleccionados[utf8_strtoupper($dnd."_".$tipo."_".$id)]=array(
						'id'		   => $id,
						'Tipo' 		   => $tipo,
						'name'		   => html_entity_decode($namefinal),
						'href'		   => $href,
						'ajax_url'	   => $ajax_url,
						'url_filter'   => $urlfilter,
						'hav_filter'   => $hav_filter,
						'see_more'	   => $see_more_url,
						'dnd'		   => html_entity_decode($dnd),
						'image'		   => $image,
						'html'		   => $html,
						'special'	   => $special,
						'tip_div'	   => '',
						'tip_code'	   => '',
						
				);	
					
							
				unset($filtro);	
							
			}//end foreach $filtros
		
		 } // Mount selected 
		
		//SEARCH BOX
		
        if ($filter_name){// show search box

			if (!empty($this->request->get['filter'])){
				//$url_filter=$this->request->get['filter'];
				//$urlfilter2='&filter='.$this->request->get['filter'];
			     $urlfilter2='&amp;filter='.urlencode(str_replace("&amp;","&",$this->request->get['filter']));
			     $filter_url=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$urlfilter2);
				 $ajax_url=$url_where2go.$url_pr.$url_limits.$urlfilter2;
			
			}else{
				//$url_filter='';	
				$urlfilter2='&amp;filter=';
				$filter_url=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$urlfilter2);
				$ajax_url=$url_where2go.$url_pr.$url_limits.$urlfilter2;
				
			}
			//remove filter_name from string.
            
			$html='';
			$html.="<ul>";
			$html.="<li class=\"active\"><em>&nbsp;</em> <a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$filter_url."', ajaxurl:'".$ajax_url."', gapush:'no'}\" href=\"javascript:void(0)\"  ". $nofollow."><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a> <span>".$filter_name." </span></li>";
			$html.="</ul>"; 
			
			
			
			$filtros_seleccionados[utf8_strtoupper($this->language->get('search_filter_text')."_search_1")]=array( 
			    	'id'		   => "SEARCH",
					'Tipo' 		   => "Search",
					'name'		   => html_entity_decode($filter_name),
					'href'		   => $filter_url,
					'ajax_url'	   => $ajax_url,					
					'see_more'	   => false,
					'dnd'		   => $this->language->get('search_filter_text'),
					'image'		   => '',
			        'tip_div'	   => '',
					'tip_code'	   => '',
			        'html' 			=> $html,
			
			);

        }
		
		 //PRICE RANGE
		if (isset($price_range_filter) and !empty($price_range_filter)) {
				
			
			if (!empty($this->request->get['filter'])){
				//$url_filter=$this->request->get['filter'];
				//$urlfilter2='&filter='.$this->request->get['filter'];
			     $urlfilter2='&amp;filter='.urlencode(str_replace("&amp;","&",$this->request->get['filter']));
			     $filter_url=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', $url_where2go).$url_limits.$urlfilter2);
				 $ajax_url=$url_where2go.$url_limits.$urlfilter2;
			
			}else{
				//$url_filter='';	
				$urlfilter2='&amp;filter=';
				$filter_url=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', $url_where2go).$url_limits.$urlfilter2);
				$ajax_url=$url_where2go.$url_limits.$urlfilter2;
				
			}
			
						
				$view=$settings_module['pricerange']['view'];
				
				list($filter_min_price,$filter_max_price)=explode(";",$price_range_filter);
				
				$SymbolLeft=$this->currency->getSymbolLeft();
				$SymbolRight=$this->currency->getSymbolRight();
					
				//$txt_price_rage_selected=$SymbolLeft.$filter_min_price.$SymbolRight." - ".$SymbolLeft.$filter_max_price.$SymbolRight;
				
				//remove currency from price
				$filter_min_price=floor($this->model_module_supercategorymenuadvanced->UnformatMoney($filter_min_price,$filter_coin)); 
				$filter_max_price=ceil($this->model_module_supercategorymenuadvanced->UnformatMoney($filter_max_price,$filter_coin));
				
				 if ($this->config->get('config_tax') && $settings_module['pricerange']['setvat']) {
					    $tax_value= $this->tax->calculate(1, $settings_module['pricerange']['tax_class_id'], $this->config->get('config_tax'));
						$filter_min_price=floor( $filter_min_price/$tax_value ); 
						$filter_max_price=ceil( $filter_max_price/$tax_value );
				 }
				
				$txt_price_rage_selected=$SymbolLeft.$filter_min_price.$SymbolRight." - ".$SymbolLeft.$filter_max_price.$SymbolRight;
				
			
			    $filtros_seleccionados[utf8_strtoupper("PR_PRICERANGE_1")]=array(
							'Tipo' 		   => "PRICERANGE",
							'href'		   => $filter_url,
							'ajax_url'	   => $ajax_url,	
							'dnd'		   => $this->language->get('pricerange_text'),
							//'name'		   => $txt_price_rage_selected,
							'name'		   => $this->language->get('pricerange_text'),
							'tip_div'	   => '',
							'tip_code'	   => '',
			        		'html' 			=> "do_it_later",
							'initval'		=>'opened'
				);
			
				
			
			} //END PRICE RANG	
			
			
				
			$this->data['values_selected']=$filtros_seleccionados;
		
			//EXTRA FILTER OUTSIDE filter
	/*
		echo "<pre>";
		print_r($filtros_seleccionados);
		echo "</pre>";
	*/	
		//mount urlfilter for the rest of the filter
		 if ($has_filter){
			
			$min_urls = explode("@@",str_replace("&amp;","&",$has_filter));
			$url_filter=array();
			foreach ($min_urls as $min_url){
				
				
				list($part1,$name)=explode("=",$min_url);
				list($dnd,$part2)=explode("_",$part1);
				$filter_parts=explode("-", $part2);  
					$tipo=$filter_parts[0];
					$special=$filter_parts[1];
					$id=$filter_parts[2];
						
				if (!empty($filter_parts[3])){
					$option_value_id=$filter_parts[3];
				    $url_filter[]=urlencode($dnd)."_".urlencode($tipo)."-".$special."-".$id."-".$option_value_id."=".urlencode($name);
				
				}else{
					$url_filter[]=urlencode($dnd)."_".urlencode($tipo)."-".$special."-".$id."=".urlencode($name);
					
				}
				
				//$url_filter[]=urlencode($tipo) ."=". urlencode($name) ."=". urlencode($id) ."=". urlencode($dnd);
				//list($tipo,$name,$id,$dnd)=explode("=",$min_url);
				
				
			}
				$url_filter="&amp;filter=".implode("@@",$url_filter);
			
			}else{
				$url_filter='&amp;filter=';	
			}	
		
		
		//fix problem with product/special
		if (isset($this->request->get['route']) && $this->request->get['route']=="product/special"){
		
		    $filter_special=true;
							
			if ($filter){  
				$url_filter.="@@".urlencode($this->language->get('special_prices_text'))."_sp-n-a=".urlencode($this->language->get('yes'));
			}else{
				$url_filter.=urlencode($this->language->get('special_prices_text'))."_sp-n-a=".urlencode($this->language->get('yes'));
			}
			 
			  $filtros_seleccionados[utf8_strtoupper($this->language->get('stock_text')).'_SP_A']['html']=''; 
			$filter=true;
			
		}
			
			$data_filter = array(
				'filter_manufacturers_by_id'=> ($filter_manufacturer_id) ? $filter_manufacturer_id."," : $filter_manufacturers_by_id,
				'filter_category_id'    	=> $filter_category_id,  
				'filter_min_price'  		=> $filter_min_price,
				'filter_max_price'  	 	=> $filter_max_price, 
				'filter_stock_id'    	    => $filter_stock_id, 
				'filter_by_name' 			=> substr($filter_by_name,0,-3),
				'filter_ids'				=> substr($filter_ids,0,-1),
				'filter_name'         		=> $filter_name, 
				'filter_tag'          		=> $filter_tag, 
				'filter_description'  		=> $filter_description,
				'filter_sub_category' 		=> $filter_sub_category, 
				'filter_stock'				=> $filter_stock,
				'filter_special'			=> $filter_special, 
				'filter_clearance'			=> $filter_clearance,
				'filter_arrivals'			=> $filter_arrivals,
				'filter_width' 				=> $filter_width,
				'filter_height'				=> $filter_height,
				'filter_length' 			=> $filter_length,
				'filter_model' 				=> $filter_model,
				'filter_sku' 				=> $filter_sku,
				'filter_upc' 				=> $filter_upc,
				'filter_location'			=> $filter_location,
				'filter_option_id' 			=> $filter_option_id,
				'filter_attribute_id'		=> $filter_attribute_id,				
				'filter_productinfo_id'		=> $filter_productinfo_id,
				'filter_options_by_ids'		=> $filter_options_by_ids,
				'filter_weight'				=> $filter_weight,
				'filter_ean'				=> $filter_ean,				
				'filter_isbn'				=> $filter_isbn,
				'filter_mpn'				=> $filter_mpn,
				'filter_jan'				=> $filter_jan,				
			    'filter_rating'				=> $filter_rating,	
				
			);
			

		//////////////////////////////////////////////////////////////
		/* SECOND PART */
		/////////////////////////////////////////////////////////////
		 
		
		if ($this->model_module_supercategorymenuadvanced->isCachedMenu($data_filter,$what,$this->session->data['currency'])){ 
		     
			$this->data['html'] = $this->model_module_supercategorymenuadvanced->isCachedMenu($data_filter,$what,$this->session->data['currency']);
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/supercategorymenu/supercategorymenuadvanced_cache.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/module/supercategorymenu/supercategorymenuadvanced_cache.tpl';
			} else {
				$this->template = 'default/template/module/supercategorymenu/supercategorymenuadvanced_cache.tpl';
			}		
					
			$this->response->setOutput($this->render());
			 
			 
	    }else{
			
			//List of products filtered
			$productos_filtrados= $this->model_module_supercategorymenuadvanced->getProductsFiltered($data_filter,$settings_module['stock']['clearance_value'],$settings_module['stock']['number_day'],$settings_module['stock']['number_day'],$settings_module['reviews']['tipo'],$what);
		
		
		
		
		
		
    		$total_productos=count($productos_filtrados);
			
			
    	    if (!empty($productos_filtrados)){//we have products
			
			$this->data['menu']=true;
			
			/////////////////////////////////////
			//SUBCATEGORIES.-
			////////////////////////////////////
			$this->data['sub_categories']=array();
			$category_selected=false;
			if ($settings_module['category']['category']){ //exist and enable

				
				(isset($settings_module['category']['style'])) ? $category_style="_".$settings_module['category']['style'] : $category_style='';
 
				//$this->data['values_no_selected_categories']=array();
				//$this->data['values_selected_categories']=array();
				//$this->data['isset_subcategories']=1;
			
				$subsubcategories = array(); $subsubcategories_ord = array(); $subsubcategories_slice_ord = array();
			  
			  
				$results = $this->model_module_supercategorymenuadvanced->getCategoriesFiltered($productos_filtrados,$data_filter,$what);
			
					
				if (!empty($this->request->get['path'])){

					$previo_path=$this->request->get['path'] . '_' ;
				}else{
					$previo_path='';
				}

				if (!empty($results)){//No more categories in this navigation.
					
				foreach ($results as $result) {
				
					if (!$settings_module['category']['reset']){//reset category when 
					
						
						
						if ($what=="M"){
							$url=$this->url->link('product/asearch', 'path='. $previo_path. $result['category_id'].'&' .$url_where2go_brands).$url_pr.$url_limits.$url_search.$url_filter;
							$url_ajax=$url_where2go_brands .'&amp;path='. $previo_path  . $result['category_id'].$url_pr.$url_limits.$url_search.$url_filter;				
						}else{
							$url=$this->url->link('product/asearch', 'path='. $previo_path . $result['category_id']).$url_pr.$url_limits.$url_search.$url_filter;
							$url_ajax='path='. $previo_path  . $result['category_id'].$url_pr.$url_limits.$url_search.$url_filter;
						}
					
					}else{
						$url=$this->url->link('product/asearch', 'path='. $previo_path  . $result['category_id']).$url_pr.$url_limits.$url_search;
						$url_ajax='path='. $previo_path . $result['category_id'].$url_pr.$url_limits.$url_search;
						
					}
					
					
					
					$subsubcategories["str".$result['name']] = array(
						'category_id'	=> $result['category_id'],
						'name'  		=> $result['name'],
						'href'          => $this->model_module_supercategorymenuadvanced->SeoFix($url),
						'ajax_url'	    => $this->model_module_supercategorymenuadvanced->SeoFix($url_ajax),
						'total'			=> $result['total'],
						'order'			=> $result['order'],
						'tip_div'		 => '',
						'tip_code'		 => '',
						);
				}
			
			//print_r($results);
			//die;
					//check if we need to slice the values.
					$subsubcategories_slice = array();	
					if (count($subsubcategories) > $settings_module['category']['list_number']) {
						//get the array and order by total
						$sort_order  = array();
						$subsubcategories_2slice=$subsubcategories;
						$subsubcategories_slice = array();

						foreach ($subsubcategories_2slice as $key => $value) {
							 $sort_order[$key] = $value['total'];
						}
							 array_multisort($sort_order, SORT_DESC,$subsubcategories_2slice);
							//slice array for present only more important categories
							$subsubcategories_slice= array_slice($subsubcategories_2slice,0, $settings_module['category']['list_number']);
						}
					
					//order category from admin config.	
			 		$subsubcategories_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($subsubcategories,$settings_module['category']['order']));
					$subsubcategories_slice_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($subsubcategories_slice,$settings_module['category']['order']));
			
				$subcategories[] = array(
						'name'    	     => $category_text,
						'total'		     => count($subsubcategories),
						'jurjur'    	 => $subsubcategories_ord,
						'slice'			 => $subsubcategories_slice_ord,
						'Tipo'			 => "CATEGORY",
						'list_number' 	 => $settings_module['category']['list_number'],
						'order'			 => $settings_module['category']['order'],
						'sort_order'	 => $settings_module['category']['category'],
						'view'			 => $settings_module['category']['view'],
						'initval'		 => $settings_module['category']['initval'],
						'tip_div'		 => '',
						'tip_code'		 => '',
				);
						
			    //SET Subcategories
				//$this->data['values_no_selected_categories']=$subcategories;
	

			}//no empty(results)
					

			$html='';
			//Check if we have selected a category
			if (!empty($this->request->get['path']) and $this->request->get['path']!=""){
		
		       $paths = explode("_",urldecode($this->request->get['path']));
		
				$categories_nav=array();
				$w=0;
				
				foreach ($paths as $path){
					$arr=array_slice($paths,0,$w);
					$w==0 ? $path_links=0:$path_links=implode ("_",$arr);
					
					if ($path!=0){
						
					if (!$settings_module['category']['reset']){//reset category when 
					
					
					if ($what=="M"){
						    $url=$this->url->link('product/asearch', 'path='.$path_links.'&'.$url_where2go_brands).$url_pr.$url_limits.$url_search.$url_filter;
							$url_ajax='path='. $path_links.'&amp;'.$url_where2go_brands.$url_pr.$url_limits.$url_search.$url_filter;
				   						
					}else{
							$url=$this->url->link('product/asearch', 'path='.$path_links).$url_pr.$url_limits.$url_search.$url_filter;
							$url_ajax='path='. $path_links.$url_pr.$url_limits.$url_search.$url_filter;
				   			 
					}
					
								 
					}else{
						$url=$this->url->link('product/asearch', 'path='. $path_links);
						$url_ajax='path='. $path_links;
						
					}
						
						
						$categories_nav[]=array(
							'href'		   => $this->model_module_supercategorymenuadvanced->SeoFix($url),
							'name' 		   => $this->model_module_supercategorymenuadvanced->getCategoryName($path),
							'ajax_url'	   => $this->model_module_supercategorymenuadvanced->SeoFix($url_ajax),
					);
						
						
						
						/*$categories_nav[]=array(
							'href'		   => $this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', 'path='.$path_links)),
							'name' 		   => $this->model_module_supercategorymenuadvanced->getCategoryName($path),
							'ajax_url'	   => $this->model_module_supercategorymenuadvanced->SeoFix('path='.$path_links),
					); */
					$w++;			
					}
			 	}
				//$this->data['values_selected_categories'] = $categories_nav;
			
			
			$html='';
				 //first part for selected categories.
				 if ($categories_nav && !empty($categories_nav)) { 	
					
					$html.="<ul>";
						foreach ($categories_nav as $values_selected_category) { 
							$html.="<li class=\"active".$category_style."\" ><em>&nbsp;</em><a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$values_selected_category['href']."',ajaxurl:'".$values_selected_category['ajax_url']."',gapush:'no'}\" href=\"javascript:void(0)\" ".$nofollow." ><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a><span>".$values_selected_category['name']." </span></li>";
						} 
					$html.="</ul>";
										
					//$html.="</dd>";
				 } 
			
				
				$category_selected=true;
				
				
			}//End Check if we have selected a category
			
			
			//second part for no selected categories
			$view=$settings_module['category']['view']; $searchinput=$settings_module['category']['searchinput'];
			$html2='<dd class="page_preload">';	
			$html2='';	
				if (count($subsubcategories)==1 && $subcategories[0]['total']==$total_productos){ 
													
					$html2.=$this->model_module_supercategorymenuadvanced->getOneHtml($subsubcategories_ord[0]['name'],$subsubcategories_ord[0]['total'],$data_settings);	
						
				}elseif ($view=="sele") {
							
					$html2.= $this->model_module_supercategorymenuadvanced->getSelectHtml($subsubcategories_ord,$data_settings,$category_text);
																
				}elseif($view=="list"){
							
					$html2.= $this->model_module_supercategorymenuadvanced->getListHtml($subsubcategories_ord,$subsubcategories_slice_ord,$data_settings,$category_text,$idx,$searchinput);
					$idx++;
			
			
				}
			/*$this->data['values_selected']["CATEGORY"]=array(
					'html'		=> $html.$html2,
					'name'		=> $category_text,
					'initval'	=> $settings_module['category']['initval'],
					'dnd'		=> $category_text,
					'tip_div'	=> '',
					'tip_code'	=> '',
			);
			
			*/
			$this->data['all_values'][$settings_module['category']['super_order']][]=array(
					'html'		=> $html.$html2,
					'name'		=> $category_text,
					'initval'	=> $settings_module['category']['initval'],
					'dnd'		=> $category_text,
					'tip_div'	=> '',
					'tip_code'	=> '',
			);
			
			//small fix to work with categories
			if ($category_selected){
			
			
			$this->data['values_selected']["CATEGORY"]=array(
						'html'		=> $html.'</dd><dd class="page_preload">'.$html2,
						'name'		=> $category_text,
						'initval'	=> $settings_module['category']['initval'],
						'dnd'		=> $category_text,
						'tip_div'		 => '',
						'tip_code'		 => '',
				);
			
			}else{
			
			if(!empty($subcategories)){
				$this->data['values_no_selected'][$settings_module['category']['super_order']][]=array(
					'html'		=> $html2,
					'name'		=> $category_text,
					'initval'	=> $settings_module['category']['initval'],
					'dnd'		=> $category_text,
					'tip_div'	=> '',
					'tip_code'	=> '',
				);
			}
				
			}
				
				
			}		
		
			 

			//////////////////////////////
			//PRICE RANGE
			/////////////////////////////
		
			//check if we set price range, for admin configuration and module configuration
	         if (($this->config->get('config_customer_price') && $this->customer->isLogged() && $settings_module['pricerange']['pricerange']) || !$this->config->get('config_customer_price') && $settings_module['pricerange']['pricerange']) {
				
				$price_range_init= $settings_module['pricerange']['initval'];
				$SymbolLeft=$this->currency->getSymbolLeft();
				$SymbolRight=$this->currency->getSymbolRight();
				$txt_price_rage_selected2='';
				
				if (isset($this->request->get['PRICERANGE'])){
					list($min_price,$max_price)=explode(";",$this->request->get['PRICERANGE']);
					$txt_price_rage_selected2=$SymbolLeft." ".$this->model_module_supercategorymenuadvanced->formatCurrency($min_price)." ".$SymbolRight." - ".$SymbolLeft." ".$this->model_module_supercategorymenuadvanced->formatCurrency($max_price)." ".$SymbolRight;
				
				}
				
				$prices_min_max=$this->model_module_supercategorymenuadvanced->getProductsPriceandSpecial($productos_filtrados,$data_filter,$what);
				
				 $max_price=$prices_min_max['PriceMax'];
				 $min_price=$prices_min_max['PriceMin'];
				
				
					
				// check price with vat or not
				
				if ($this->config->get('config_tax') && $settings_module['pricerange']['setvat']) {
					$max_price =$this->tax->calculate($max_price, $settings_module['pricerange']['tax_class_id'], $this->config->get('config_tax'));
					$min_price =$this->tax->calculate($min_price, $settings_module['pricerange']['tax_class_id'], $this->config->get('config_tax'));
				}
				
				$max_price= ceil($this->model_module_supercategorymenuadvanced->formatMoney($max_price));
				$min_price= floor($this->model_module_supercategorymenuadvanced->formatMoney($min_price));
						
				$currency= isset($this->session->data['currency']) ? $this->session->data['currency'] : $this->config->get('config_currency');
				
				$txt_price_rage_selected=$SymbolLeft." ".$this->model_module_supercategorymenuadvanced->formatCurrency($min_price)." ".$SymbolRight." - ".$SymbolLeft." ".$this->model_module_supercategorymenuadvanced->formatCurrency($max_price)." ".$SymbolRight;
				
				
				
				$view=$settings_module['pricerange']['view'];
			    $this->data['intivalprice']=$settings_module['pricerange']['initval'];
				
				if (($view=="select") || ($view=="list")){
					$number_ranges=5;

					$array_prices_values=$this->model_module_supercategorymenuadvanced->getRanges($min_price,$max_price,$number_ranges,$prices_min_max,$productos_filtrados,$currency,$settings_module['pricerange']['setvat'],$settings_module['pricerange']['tax_class_id'],$super_id,$what);

				}

				//print_r('sdfdfd');die;

				

				
				$catarray=array();

				$max_price_round = round($max_price, -3);
				//echo $min_price;
				$min_price_round = round($min_price, -3);
				$catarray=$this->model_catalog_category->getCategory($category_id_val);

				if($catarray['price_range_filter']){
					$stringval=trim($catarray['price_range_filter']);
					$price_filters=explode(",",$stringval);} else {$price_filters='';}
					$checkcount=0;
					if($price_filters){
					for($i=0;$i<count($price_filters);$i++) {

						$price_filters[$i]=trim($price_filters[$i]," ");
						
						if(is_numeric($price_filters[$i])) 
							{
								
								if($price_filters[$i]){
								$price_filters[$i]=$price_filters[$i]-1;
								}

							}else{


								$checkcount=$checkcount+1;}
					}}
					
				
					$arrcount=count($price_filters);
					$valcount=$arrcount-1; 		



					if(!empty($price_filters) && is_numeric($price_filters[$valcount]) && ($max_price_round>$price_filters[$valcount])&& ($checkcount==0))
					{		
						
						
						array_push($price_filters,$max_price_round);
						
					}
					else if(!empty($price_filters) && is_numeric($price_filters[$valcount]) && ($max_price_round<$price_filters[$valcount])&& ($checkcount==0))
					{
						
						array_replace($price_filters[$valcount],$max_price_round);
					}
					else
					{
						
						$price_filters=array();
						
						$price_filters[] = $min_price_round;
						//echo $min_price_round;

						$a = $max_price_round;

						$b = $max_price_round / 5;

						$divided = $a/$b;

						//$c = array();

						$reminder = $a/$b - floor($a/$b);

						for($i = 1; $i <= floor($divided); $i++){
							$currRes = $b * $i;
							if($currRes > 0)
							{

								$price_filters[] = $currRes;
							}
						    
						}

						if($reminder != 0)
						{

							$price_filters[] = $reminder;
						}
					}
					if($price_filters[0]){$price_filters[0]=0;}

				//print_r($price_filters); die;
			
				$prevValue = 0;
				foreach ($price_filters as $key => $value) {

					$label = '';
					$labelSymbol = '';

					$prices_min_max['PriceMax'] = $value;
					$prices_min_max['PriceMin'] = $prevValue;

					if($key == 0 || $key==1)
					{
						$labelSymbol = "<";
						$label = $value;
					}
					
					else if($key == count($price_filters) - 1)
					{
						$labelSymbol = ">";
						$label = $prevValue+1;
					}
					$get_price_filters_values = $this->model_module_supercategorymenuadvanced->getRangesCustom($prevValue,$value,2,$prices_min_max,$productos_filtrados,$currency,$settings_module['pricerange']['setvat'],$settings_module['pricerange']['tax_class_id'],$super_id,$what, $label, $labelSymbol, $SymbolLeft);
					if(!empty($get_price_filters_values))
					{
						$price_filters_values[] = $get_price_filters_values[0];
					}

					$prevValue = $value;


				} 

				 
				//print_r('<pre>');
				
				//print_r($price_filters_values); die;
				$array_prices_values = $price_filters_values;




				if($price_range_filter_new)
				{
					list($filter_min_price_new,$filter_max_price_new)=explode(";",$price_range_filter_new);

					
					$findMaxValue = array_search($filter_max_price_new, $price_filters);



					if($findMaxValue >= 0)
					{
						$filterLabel = $array_prices_values[$findMaxValue]['label'];
						$filterLabelSymbol = $array_prices_values[$findMaxValue]['label-symbol'];
						$filterSymbolLeft = $array_prices_values[$findMaxValue]['symbol-left'];

						if($filterLabel)
						{
							$filterValuesLabel = $filterSymbolLeft . " ". $filterLabelSymbol.$filterLabel;
						}
						else
						{
							$filterValuesLabel = $txt_price_rage_selected2;
						}

						//$filterValuesLabel = $array_prices_values[$findMaxValue]['price-label'];
						unset($array_prices_values[$findMaxValue]);
					}

				}
				$array_prices_values = array_values($array_prices_values);


				if ($filter){																																
					$PriceUrl=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', $url_where2go).$url_search.$url_limits.$url_filter);
					$PriceAjaxUrl=$url_where2go.$url_search.$url_limits.$url_filter;
				}else{
					$PriceUrl=$this->model_module_supercategorymenuadvanced->SeoFix($this->url->link('product/asearch', $url_where2go.$url_limits));
					$PriceAjaxUrl=$url_where2go.$url_search.$url_limits;
				}
			    					
				
				
								
				$html='';
				if (($max_price==$min_price) || ($max_price-$min_price<=1)){
					  
					//$txt_price_rage_selected=$SymbolLeft." ".$this->model_module_supercategorymenuadvanced->formatCurrency($min_price)." ".$SymbolRight." - ".$SymbolLeft." ".$this->model_module_supercategorymenuadvanced->formatCurrency($max_price)." ".$SymbolRight;
					
					if($price_range_filter_new){
						 
					  $html.="<ul>";
					  $html.="<li class=\"active\"><em>&nbsp;</em> <a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$PriceUrl."', ajaxurl:'".$PriceAjaxUrl."', gapush:'no'}\" href=\"javascript:void(0)\"  ". $nofollow."><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a> <span>".$filterValuesLabel."</span></li>";
					  $html.="</ul>";
						
					$this->data['values_selected'][utf8_strtoupper("PR_PRICERANGE_1")]['html']=$html;
					
					
					
					}else{
						
						$html.=	$this->model_module_supercategorymenuadvanced->getOneHtml($txt_price_rage_selected,$total_productos,$data_settings);
				    }
				
				}elseif ($view=="select") {
					
					$html.="<ul>";
					
					if (count($array_prices_values) >1){
						$html.="<select class=\"smenu\" style=\"width: 160px; margin-left:5px;\">";
						$html.="<option value=\"0\" selected=\"selected\">- Select ".$pricerange_text." -</option>";
                       	 foreach($array_prices_values as $array_price_value) {  
           				 	($count_products)? $count="&nbsp;(". $array_price_value['total'] .")" : $count="";
           				   	if ($array_price_value['total']>0){ //remove range that no have products.
           	
					            $html.="<option class=\"smenu {dnd:'".$PriceUrl."&amp;C=".$filter_coin."&amp;PRICERANGE=". $array_price_value['intMin'].";". $array_price_value['intMax']."', ajaxurl:'".$PriceAjaxUrl."&amp;C=".$filter_coin."&amp;PRICERANGE=". $array_price_value['intMin'].";". $array_price_value['intMax']."', gapush:'no'}\">". sprintf($array_price_value['prices'],$SymbolLeft,$SymbolRight,$SymbolLeft,$SymbolRight)." ". $count."</option>"; 
								
							}	
						}		
						$html.="</select>";
						
						
						if($price_range_filter_new){
						$this->data['values_selected'][utf8_strtoupper("PR_PRICERANGE_1")]['html']=$html;
						}
             
			         }else{ 

          	 			//($count_products)? $count=" <span class=\"product-count\">(". $array_prices_values[0]['total'] .")</span>" : $count="";
          	 			($count_products)? $count=" <span class=\"product-count\"></span>" : $count="";
		
        			     $html.="<span class=\"seleccionado\"> <em>&nbsp;</em>". sprintf($array_prices_values[0]['prices'],$SymbolLeft,$SymbolRight)."&nbsp;".$count."</span>"; 
          			 } 
           			 $html.="</ul>";
					
															
				        if($price_range_filter_new){
						$this->data['values_selected'][utf8_strtoupper("PR_PRICERANGE_1")]['html']=$html;
						}
				
					
				}elseif($view=="list"){
			
					if($price_range_filter_new){

						

					 $html.="<ul>";
					 $html.="<li class=\"active\"><em>&nbsp;</em> <a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$PriceUrl."', ajaxurl:'".$PriceAjaxUrl."', gapush:'no'}\" href=\"javascript:void(0)\"  ". $nofollow."><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a> <span>".$filterValuesLabel."</span></li>";
					
				     $html.="</ul>";$html.="</dd>";$html.="<dd>";
					 
					} 
				    
					$html.="<ul>";
					 
					 
					 if (count($array_prices_values) >1){    
					
						foreach($array_prices_values as $array_price_value) {  
	
    			        	//($count_products)? $count=" <span class=\"product-count\">(". $array_price_value['total'] .")</span>" : $count="";
    			        	($count_products)? $count=" <span class=\"product-count\"></span>" : $count="";

            		           	if ($array_price_value['total']>0){ //remove range that no have products.

            					 $html.="<li> <em>&nbsp;</em><a onclick='testme();'' class=\"smenu {dnd: '".$PriceUrl."&amp;C=".$filter_coin."&amp;PRICERANGE=".$array_price_value['intMin'].";".$array_price_value['intMax']."', ajaxurl:'".$PriceAjaxUrl."&amp;C=".$filter_coin."&amp;PRICERANGE=".$array_price_value['intMin'].";".$array_price_value['intMax']."', gapush:'no'}\" href=\"javascript:void(0)\" ".$nofollow.">".sprintf($array_price_value['prices'],$SymbolLeft,$SymbolRight,$SymbolLeft,$SymbolRight)." </a>".$count."</li>";
								}
						}
          
                    }else{   

          				// ($count_products)? $count=" <span class=\"product-count\">(". $array_prices_values[0]['total'] .")</span>" : $count="";
          				($count_products)? $count=" <span class=\"product-count\"></span>" : $count=""; 

                         $html.="<span class=\"seleccionado\"> <em>&nbsp;</em>". sprintf($array_prices_values[0]['prices'],$SymbolLeft,$SymbolRight)."&nbsp;".$count."</span>";
          			 } 
           			 $html.="</ul>";
					
					if($price_range_filter){
						$this->data['values_selected'][utf8_strtoupper("PR_PRICERANGE_1")]['html']=$html;
						}
						
				}elseif($view=="slider"){
					
					$price_diff=$max_price-$min_price;
					$half_value=round(($min_price+$max_price)/2,0);
					$half_value1=round(($min_price+$half_value)/2,0);
					$half_value2=round(($max_price+$half_value)/2,0);
					//$scale_price="[{$min_price}, '|', {$half_value1}, '|' , {$half_value}, '|', {$half_value2}, '|', {$max_price}]";
					$scale_price="[{$min_price}, '|', {$half_value}, '|', {$max_price}]";	
									
					
					if ($price_range_filter){// Exits price range filter
					$ajax_url_del=	$this->data['values_selected']['PR_PRICERANGE_1']['ajax_url'];
					$url_del	=	$this->data['values_selected']['PR_PRICERANGE_1']['href'];
						
					$html=$this->model_module_supercategorymenuadvanced->getPriceSliderHtmlSelected("slider_price_range",$scale_price,$min_price,$max_price,$SymbolLeft, $SymbolRight,"PRICERANGE",$is_ajax,$PriceAjaxUrl,$PriceUrl,$currency,$ajax_url_del,$url_del);
					
					// assign to the array price range selected the $html part
					$this->data['values_selected']['PR_PRICERANGE_1']['html']=$html;
					
					}else{
						
						
					$html=$this->model_module_supercategorymenuadvanced->getPriceSliderHtml("slider_price_range",$scale_price,$min_price,$max_price,$SymbolLeft, $SymbolRight,"PRICERANGE",$is_ajax,$PriceAjaxUrl,$PriceUrl,$currency);
					}
					
				}
				
				
				
				$pricerange["PRICERANGE"] = array(
						'name'    	     => $pricerange_text,
						'total'		     => 10000,
						'html'			 => $html,
						'jurjur'    	 => '',
						'slice'			 => '',
						'list_number' 	 => 10000,
				        'order'			 => '',
					    //'sort_order'	 => $settings_module['module']['sort_order'],
					    'view'			 => $settings_module['pricerange']['view'],
						'initval'	     => $settings_module['pricerange']['initval'],
						'searchinput'    => '',
						'dnd'			 => $pricerange_text,
						'tip_div'		 => '',
						'tip_code'		 => '',
						
				    );
	
				
			    //SET pricerange
				$this->data['price_range']=$pricerange;	
				
				if ($price_range_filter){
					$this->data['all_values'][$settings_module['pricerange']['super_order']]['PRICERANGE']=$this->data['values_selected']['PR_PRICERANGE_1'];
				}else{
					$this->data['all_values'][$settings_module['pricerange']['super_order']]=$pricerange;
					$this->data['values_no_selected'][$settings_module['pricerange']['super_order']]=$pricerange;
					
				} 

				
			} //End price range
			
			
			/////////////////////////////////////
			//MANUFACTURES.-
			////////////////////////////////////
			
			
			//check admin configuration
			//if ($settings_module['manufacturer']['manufacturer'] && !$data_filter['filter_manufacturers_by_id']){
			if ($settings_module['manufacturer']['manufacturer']){
				
				$array_man_selected=explode(",",$filter_manufacturers_by_id);	
				
				$manufactures = array();
				$results = $this->model_module_supercategorymenuadvanced->getManufacturesFiltered($productos_filtrados,$data_filter,$what);
						
				//fix to prevent man=0 when select only manufacturer
				if ($url_where2go=="manufacturer_id=0"){
					$url_where2go_m='';
				}else{
					$url_where2go_m=$url_where2go;
				}
				
				
				if(!empty($results)){
					
					foreach ($results as $result) {
						
						$string_filtering=urlencode($manufacturer_text)."_m-".$this->model_module_supercategorymenuadvanced->GetView($settings_module['manufacturer']['view'])."-".$result['manufacturer_id']."=".urlencode($result['name']);
						
						if ($filter){																																
							$filter_url=$this->url->link('product/asearch', $url_where2go_m).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							$ajax_url=$url_where2go_m.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
								
						}else{
							$filter_url=$this->url->link('product/asearch', $url_where2go_m).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							$ajax_url=$url_where2go_m.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;

						}
						$is_selected=0;
						
						
						if (in_array($result['manufacturer_id'], $array_man_selected)) {//is selected
							 $is_selected=1;
						}
						
						$manufactures_final["str".$result['name']] = array(
							'manufacturer_id'=> $result['manufacturer_id'],
							'name'    	     => $result['name'],
							'total'		     => $result['total'],
							'href'    	     => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							'ajax_url'	     => $ajax_url,
							'tipo'			 => "MANUFACTURER",
							'order'			 => $result['order'],
							'selected'	     => $is_selected
						);
						
					}
		
                    //check if we need to slice the values.
					$manufactures_slice = array();	
					if (count($manufactures_final) > $settings_module['manufacturer']['list_number']) {
						//get the array and order by total
						$sort_order  = array();
						$manufactures_2slice=$manufactures_final;
						

						foreach ($manufactures_2slice as $key => $value) {
							 $sort_order[$key] = $value['total'];
						}
							 array_multisort($sort_order, SORT_DESC,$manufactures_2slice);
							//slice array for present only more important categories
							$manufactures_slice= array_slice($manufactures_2slice,0, $settings_module['manufacturer']['list_number']);
						}
					
					//order category from admin config.	
			 		$manufactures_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($manufactures_final,$settings_module['manufacturer']['order']));
					$manufactures_slice_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($manufactures_slice,$settings_module['manufacturer']['order']));
					$total=count($manufactures_ord);
					$list_number=$settings_module['manufacturer']['list_number'];
					$view=$settings_module['manufacturer']['view'];
					$searchinput=$settings_module['manufacturer']['searchinput'];
				    $is_selected=0;
				
					if (in_array($result['manufacturer_id'], $array_man_selected)) {//is selected
						
						$html=$filtros_seleccionados[utf8_strtoupper($manufacturer_text).'_M_'.$result['manufacturer_id']]['html'];
						$is_selected=1;
					}else{
						if ($total==1 && $manufactures_ord[0]['total']==$total_productos){ 
							$html=$this->model_module_supercategorymenuadvanced->getOneHtml($manufactures_ord[0]['name'],$manufactures_ord[0]['total'],$data_settings);
						}elseif ($view=="sele") {
							$html=$this->model_module_supercategorymenuadvanced->getSelectHtml($manufactures_ord,$data_settings,$manufacturer_text);
						}elseif ($view=="image"){
							$html=$this->model_module_supercategorymenuadvanced->getImageHtml($data_settings);
							
						}elseif($view=="list"){
							$html=$this->model_module_supercategorymenuadvanced->getListHtml($manufactures_ord,$manufactures_slice_ord,$data_settings,$manufacturer_text,$idx,$searchinput);
							$idx++;
							
						}
						
						
					}
				
				$manufactures[] = array(
						'name'    	     => $manufacturer_text,
						'total'		     => count($manufactures_final),
						'html'			 => $html,
						'jurjur'    	 => $manufactures_ord,
						'slice'			 => $manufactures_slice_ord,
						'list_number' 	 => $settings_module['manufacturer']['list_number'],
				        'order'			 => $settings_module['manufacturer']['order'],
					    //'sort_order'	 => $settings_module['module']['sort_order'],
					    'view'			 => $settings_module['manufacturer']['view'],
						'initval'	     => $settings_module['manufacturer']['initval'],
						'searchinput'    => $settings_module['manufacturer']['searchinput'],
						'selected'	     => $is_selected,
						'tip_div'		 => '',
						'tip_code'		 => '',	
				    );
	
			
			    //SET Manufacturers
				$this->data['manufacturers']=$manufactures;	
				
				if (!$data_filter['filter_manufacturers_by_id']){
					
				$this->data['values_no_selected'][$settings_module['manufacturer']['super_order']]=$manufactures;
				}
				$this->data['all_values'][$settings_module['manufacturer']['super_order']]=$manufactures;		
				}// end !empty results
				
			}// end if ($settings_module["manufacturer"] && !$filter_manufacturers_by_id ){
			
			
			
			/////////////////////////////////////
			// FILTER REVIEW.-
			////////////////////////////////////
			$reviews_final=array();
			$html='';
			
				if($settings_module['reviews']['reviews']){
					
					$results = $this->model_module_supercategorymenuadvanced->getReviewsFiltered($productos_filtrados,$data_filter,$settings_module['reviews']['tipo'],$what);
									
					if(!empty($results)){
					
					foreach ($results as $result) {
					
						$string_filtering=urlencode($rating_text)."_ra-r-a=".urlencode($result['rating']);
								
					if ($filter){																																
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
					}
					
						$is_selected=0;
						if ($result['rating']==$filter_rating){ //is selected
						 $is_selected=1;
						}
						
						$reviews_final["str".$result['rating']] = array(
							'reviews_id'=> $result['rating'],
							'name'    	     => $result['rating'],
							'total'		     => $result['total'],
							'href'    	     => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							'ajax_url'	     => $ajax_url,
							'tipo'			 => "review",
							'order'			 => $result['rating'],
							'selected'	     => $is_selected
						);
			        
						}			
					$total=count($reviews_final);
					$list_number=1000000000;
					$view='image';
					$searchinput='';
				    $is_selected=0;
				    $reviews_final=array_values($reviews_final);	
					
					if ($result['rating']==$filter_rating){ //is selected
						
						$html=$filtros_seleccionados[utf8_strtoupper($rating_text).'_RA_A']['html'];
						$is_selected=1;
					}else{
						if ($total==1 && $reviews_final[0]['total']==$total_productos){ 
							$html=$this->model_module_supercategorymenuadvanced->getOneHtmlReview($reviews_final[0]['name'],$reviews_final[0]['total'],$data_settings,$this->language->get('rating_text_'.$settings_module['reviews']['tipo']));
						}elseif ($view=="sele") {
							//$html=$this->model_module_supercategorymenuadvanced->getSelectHtmlReview($reviews_final,$data_settings,$rating_text);
						}elseif ($view=="image"){
							$html=$this->model_module_supercategorymenuadvanced->getImageHtmlReview($reviews_final,$data_settings,$rating_text,$this->language->get('rating_text_'.$settings_module['reviews']['tipo']));
							
						}elseif($view=="list"){
							//$html=$this->model_module_supercategorymenuadvanced->getListHtmlReview($manufactures_ord,$manufactures_slice_ord,$data_settings,$manufacturer_text,$idx,$searchinput);
							$idx++;
							
						}
						
					}
					
				
				$reviews[] = array(
						'name'    	     => $rating_text,
						'total'		     => count($reviews_final),
						'html'			 => $html,
						'jurjur'    	 => $reviews_final,
						'slice'			 => '',
						'list_number' 	 => 10000000000000000000000,
				        'order'			 => '',
					    //'sort_order'	 => $settings_module['module']['sort_order'],
					    'view'			 => $view,
						'initval'	     => $settings_module['reviews']['initval'],
						'searchinput'    => '',
						'selected'	     => $is_selected,
						'tip_div'		 => '',
						'tip_code'		 => '',	
				    );
	
			
			    //SET reviews
				$this->data['reviews']=$reviews;	
				
				if (!$data_filter['filter_rating']){
					
					$this->data['values_no_selected'][$settings_module['reviews']['super_order']]=$reviews;
				}
					$this->data['all_values'][$settings_module['reviews']['super_order']]=$reviews;		
				
				}// end !empty results
				
			}// end if (reviews){
			
		
			
			/////////////////////////////////////
			// STOCK FILTER.-
			////////////////////////////////////
			$stockstatuses_final=array();
			$html='';
			// 1.- PRODUCTS IN STOCK
				//if($settings_module['stock']['stock'] && !$data_filter['filter_stock']){
				if($settings_module['stock']['stock']){
					$results = $this->model_module_supercategorymenuadvanced->getStocksInStock($productos_filtrados,$data_filter,$what);
					
					$string_filtering=urlencode($this->language->get('in_stock_text'))."_ss-n-a=".urlencode($this->language->get('yes'));
								
					if ($filter){																																
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
					}
					
						$is_selected=0;
					  	 if ($filter_stock){ //is selected
							 $is_selected=1;
							 $html.=$filtros_seleccionados[utf8_strtoupper($this->language->get('stock_text')).'_SS_A']['html'];
						}
						
					//if ($results!="no_stock" && $results>0 && !$is_selected){
						if ($results!="no_stock" && !$is_selected){
						$stockstatuses_final["no_stock"] = array(
							'stock_id'		 => "stock",
							'name'    	     => $this->language->get('in_stock_text'),
							'total'		     => $results,
							'href'    	     => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							'ajax_url'	     => $ajax_url,
							'tipo'			 => "STOCKS"							
						);
					}
					
				}

		       //add special to stock filter
				if($settings_module['stock']['special']){
					$results = $this->model_module_supercategorymenuadvanced->getStocksSpecial($productos_filtrados,$data_filter,$what);
									
					$string_filtering=urlencode($this->language->get('special_prices_text'))."_sp-n-a=".urlencode($this->language->get('yes'));
								
					if ($filter){																																
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
					}
							
					$is_selected=0;
					if ($filter_special){ //is selected
					 $is_selected=1;
					 $html.=$filtros_seleccionados[utf8_strtoupper($this->language->get('stock_text')).'_SP_A']['html'];
					}
							
					if ($results!="no_special" && $results>0 && !$is_selected){

						$stockstatuses_final["strspecial"] = array(
							'stock_id'		 => "special",
							'name'    	     => $this->language->get('special_prices_text'),
							'total'		     => $results,
							'href'    	     => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							'ajax_url'	     => $ajax_url,
							'tipo'			 => "STOCKSPECIAL"							
						);
					}
				}
				
				if($settings_module['stock']['clearance']){
					$results = $this->model_module_supercategorymenuadvanced->getStocksClearance($productos_filtrados,$data_filter,$settings_module['stock']['clearance_value'],$what);
					
					$string_filtering=urlencode($this->language->get('clearance_text'))."_sc-n-a=".urlencode($this->language->get('yes'));
								
					if ($filter){																																
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
					}
					$is_selected=0;
					if ($filter_clearance){ //is selected
					 $is_selected=1;
					 $html.=$filtros_seleccionados[utf8_strtoupper($this->language->get('stock_text')).'_SC_A']['html'];
					}
					
					if ($results!="no_clearance" && $results>0 && !$is_selected){
						$stockstatuses_final["clearance"] = array(
							'stock_id'		 => "clearance",
							'name'    	     => $this->language->get('clearance_text'),
							'total'		     => $results,
							'href'    	     => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							'ajax_url'	     => $ajax_url,
							'tipo'			 => "STOCKCLEARANCE"							
						);
					}
				}
				
				if($settings_module['stock']['arrivals']){
					
					$results = $this->model_module_supercategorymenuadvanced->getStocksArrivals($productos_filtrados,$data_filter,$settings_module['stock']['number_day'],$what);
					
					$string_filtering=urlencode($this->language->get('new_products_text'))."_sn-n-a=".urlencode($this->language->get('yes'));
								
					if ($filter){																																
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{
						$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
						$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;;
					}
					
					$is_selected=0;
					if ($filter_arrivals){ //is selected
					 $is_selected=1;
					 $html.=$filtros_seleccionados[utf8_strtoupper($this->language->get('stock_text')).'_SN_A']['html'];
					}
					
					
					
					if ($results!="no_new" && $results>0 && !$is_selected){
						$stockstatuses_final["new"] = array(
							'stock_id'		 => "new",
							'name'    	     => $this->language->get('new_products_text'),
							'total'		     => $results,
							'href'    	     => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							'ajax_url'	     => $ajax_url,
							'tipo'			 => "STOCKNEW"							
						);
					}
				}
				
					
				//print_r($stockstatuses_final); die;
				if (!empty($stockstatuses_final)){ //SET STOKES
				
					$stockstatuses_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($stockstatuses_final,"OTASC"));
					$view=$settings_module['stock']['view'];
					$total=count($stockstatuses_final);
							
				    //we have only one filter value and and the same number of products
					
				
					
					if ($total==1 && $stockstatuses_ord[0]['total']==$total_productos){ 
						
						$html2=$this->model_module_supercategorymenuadvanced->getOneHtml($stockstatuses_ord[0]['name'],$stockstatuses_ord[0]['total'],$data_settings);
					}elseif ($view=="sele") {
						
						//$htmlMORE FILTERS_SS
						
						$html2=$this->model_module_supercategorymenuadvanced->getSelectHtml($stockstatuses_ord,$data_settings,$stock_text);
					}elseif($view=="list"){
						
						$html2=$this->model_module_supercategorymenuadvanced->getListHtml($stockstatuses_ord,0,$data_settings,$stock_text,$idx,"no");
						$idx++;
						
					}
					
					//if($stock_text='Exclude Out Of Stock'){}
					
				
				$stockstatuses_all[] = array(
						'name'    	     => $stock_text,
						'total'		     => count($stockstatuses_final),
						'html'			 => $html.$html2,
						'jurjur'    	 => $stockstatuses_ord,
						'slice'			 => 0,
						'list_number' 	 => 100,
				        'order'			 => "OTASC",
						//'sort_order'	 => $settings_module['module']['stock']['sort_order'],
					    'view'			 => $settings_module['stock']['view'],
						'initval'	     => $settings_module['stock']['initval'],
						'searchinput'    => "no",
						'tip_div'		 => '',
						'tip_code'		 => '',
						
				);


				//print_r('<pre>'); echo $html2; die;
				$stockstatuses[] = array(
						'name'    	     => $stock_text,
						'total'		     => count($stockstatuses_final),
						'html'			 => $html2,
						'jurjur'    	 => $stockstatuses_ord,
						'slice'			 => 0,
						'list_number' 	 => 100,
				        'order'			 => "OTASC",
						//'sort_order'	 => $settings_module['module']['stock']['sort_order'],
					    'view'			 => $settings_module['stock']['view'],
						'initval'	     => $settings_module['stock']['initval'],
						'searchinput'    => "no",
						'tip_div'		 => '',
						'tip_code'		 => '',
						
				);
						
				
				$this->data['stock_statuses']=$stockstatuses;
				$this->data['values_no_selected'][$settings_module['stock']['super_order']]=$stockstatuses;
				$this->data['all_values'][$settings_module['stock']['super_order']]=$stockstatuses_all;
				
				}
				
	
				
			///////////////////////////////////
			// GET VALUES FROM ADMIN
			//////////////////////////////////

			$opciones=$atributos=$productoinfos=array(); 
			$option_no_selected=array(); $attribute_no_selected=array(); $productinfo_no_selected=array();
			
			/////////////////////////////////////
			//PRODUCT INFOS.-
			////////////////////////////////////
			$productinfos_in_category=isset($values_in_category['productinfo']) ? $values_in_category['productinfo'] : "no infos";
			//We have filter in Product Infos?
			if (is_array($productinfos_in_category)){
		
				foreach ($productinfos_in_category as $productinfo_in_category){
					$productinfo_ids[$productinfo_in_category['productinfo_id']]=$productinfo_in_category['productinfo_id'];
	         	}
			
				//Search for all values from products filtered
				foreach ($productinfos_in_category as $key=>$value){
				$product_in_product_info_filtered[$key] = $this->model_module_supercategorymenuadvanced->getProductInfosFiltered($productos_filtrados,$data_filter,$value['name'],$key,$what);
				} 
				
				//$product_in_product_info_filtered
				
				//check if we have filter on product info after apply filters
				if($product_in_product_info_filtered){
				
				$productinfos_in_filter_selected=array();
				//We have products in filter 
				if ($data_filter['filter_productinfo_id']){
					
				
				
				//Clean string
				$productinfos_filtrados=explode(",",substr($data_filter['filter_productinfo_id'], 0, -1));
					foreach ($productinfos_filtrados as $productinfos_filtrado){
						$productinfos_in_filter_selected[$productinfos_filtrado] =$productinfos_filtrado;
					}			
				}
							
				$results=$productinfos_in_category;
				 
				
				//remove the filter that have dissapear on menu because the result products dont have this filter.		
				$results=array_intersect_key($productinfos_in_category,$product_in_product_info_filtered);
					
		
				
				foreach ($results as $result){
	
					$productinfo_name= $this->language->get('entry_'.$result['short_name']);             
					$productinfo_id=$result['productinfo_id'];
					$productinfo_number=$result['number'];
					$productinfo_sort_order=$result['sort_order'];
                	$productinfo_orderval=$result['orderval'];
                	$productinfo_separator=$result['separator'];
					$productinfo_view=$result['view'];
					$productinfo_initval= $result['initval'];
					$productinfo_searchinput=$result['searchinput'];
					$productinfo_unit=$result['unit'];
					$productinfo_short_name=$result['short_name'];
					$productinfo_tip="";
					$productinfo_info=$result['info'];
					
					if ($productinfo_info=="yes"){
						$productinfo_tip_code="<img data=\"{tip:'#tooltip".$tip_id."'}\" class=\"extra_info\" src=\"image/supermenu/spacer.gif\" alt=\"\">";
						$productinfo_tip="<div id=\"tooltip".$tip_id."\" class=\"menu_tooltip\" style=\"display:none;\">".$result['text_info'][(int)$this->config->get('config_language_id')]."</div>";
						$tip_id++;
					
					}else {
						$productinfo_tip=$productinfo_tip_code=false;
					}
					
					//GET ALL porductInfoS VALUES FILTERED
			    	$productinfo_values = $product_in_product_info_filtered[$productinfo_id];	
					
					$productinfos_all_values = array();
					$product_info_only_values= array();
					$productinfo_selected=array();
					$productinfo_no_selected=array();
					
					//check if we have productinfos
					if($productinfo_values){ 
						foreach ($productinfo_values[$productinfo_id] as $productinfo_value){
						
						$productinfo_value_name= ($productinfo_value['text']=="") ? "NDDDDDN" : $productinfo_value['text'];
						$string_filtering=urlencode($productinfo_name)."_".$productinfo_short_name."-".$this->model_module_supercategorymenuadvanced->GetView($productinfo_view)."-".$productinfo_id."=".urlencode($productinfo_value_name);
					
						if ($filter){					
							$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{				
							$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
						}		
						
						
						$namer=$productinfo_value['text']=="" ? $no_data_text : $productinfo_value['text'];
						$product_info_only_values[]=(int)str_replace($productinfo_unit,"",$namer);
					
				
						if (array_key_exists($productinfo_id, $productinfos_in_filter_selected)) {
				    		$is_selected=1;
						}else{
							$is_selected=0;
							
						}
										
						$productinfos_all_values['str'.(string)$namer] = array(
								'name'    	   => $namer,
								'href'    	   => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							    'ajax_url'	   => $ajax_url,
								'total'		   => $productinfo_value['total'],
								'tipo'         => 'productinfo',
								'order'	       => 1,
								'selected'	   => $is_selected
							);
						
					    }
						
						
					$productinfos_slice = array();	
					if (count($productinfos_all_values) > $productinfo_number) {
						//get the array and order by total
						$sort_order  = array();
						$productinfo_2slice=$productinfos_all_values;
					
						foreach ($productinfo_2slice as $key => $value) {
							 $sort_order[$key] = $value['total'];
						}
							 array_multisort($sort_order, SORT_DESC,$productinfo_2slice);
							//slice array for present only more important categories
							$productinfos_slice= array_slice($productinfo_2slice,0, $productinfo_number);
						}
								
						//order category from admin config.	
						$productinfos_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($productinfos_all_values,$productinfo_orderval));
						$productinfos_slice_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($productinfos_slice,$productinfo_orderval));
						$total=count($productinfos_ord);
						$list_number=$productinfo_number;
						$view=$productinfo_view;
						$searchinput=$productinfo_searchinput;
	
	                    //update tip code for selected options.					
						if($is_selected){
							$this->data['values_selected'][utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['tip_code']=$productinfo_tip_code;
							$this->data['values_selected'][utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['tip_div']=$productinfo_tip;
						
						}

	
	     				//we have only one filter value and the same number of products
						if ($total==1 && $productinfos_ord[0]['total']==$total_productos && $view!="slider"){ 
													
						$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['html']: $this->model_module_supercategorymenuadvanced->getOneHtml($productinfos_ord[0]['name'],$productinfos_ord[0]['total'],$data_settings,$productinfo_id);	
						
						}elseif ($view=="sele") {
							
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['html']: $this->model_module_supercategorymenuadvanced->getSelectHtml($productinfos_ord,$data_settings,$productinfo_name,$productinfo_id);
							
						
						}elseif ($view=="image"){
								
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['html']: $this->model_module_supercategorymenuadvanced->getImageHtml($productinfos_ord,$data_settings,$productinfo_name);	
																						
														
						}elseif($view=="list"){
														
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['html']: $this->model_module_supercategorymenuadvanced->getListHtml($productinfos_ord,$productinfos_slice_ord,$data_settings,$productinfo_name,$idx,$searchinput,$productinfo_id);
														
							$idx++;
						
						}elseif ($view=="slider"){
												
							$productinfo_value_name= ($productinfo_value['text']=="") ? "NDDDDDN" : $productinfo_value['text'];
							$string_filtering=urlencode($productinfo_name)."_".$productinfo_short_name."-s-".$productinfo_id;
						
							if ($filter){	
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							}else{				
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							}		
						
													
							$max_value=max($product_info_only_values);
							$min_value=min($product_info_only_values);
							$half_value=round(($min_value+$max_value)/2,0);
							//$half_value1=round(($min_value+$half_value)/2,0);
							//$half_value2=round(($max_value+$half_value)/2,0);
							//$scale_price="[{$min_price}, '|', {$half_value1}, '|' , {$half_value}, '|', {$half_value2}, '|', {$max_price}]";
							$scale="[{$min_value}, '|', {$half_value}, '|', {$max_value}]";		
							//Width;
							
							if($is_selected){	//
							    				
								/*
								we need to know the delete url to remove the filter, in this case 
								we check if we have a filter with 'has_filter' and if is true we get the the urls mounted in $filtros_seleccionados array.
								*/
								
								// $string_filtering=urlencode($productinfo_name)."_".$productinfo_short_name."-s-".$productinfo_id;
						    $url_del=$filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['href'];
							$ajaxurl_del=$filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['ajax_url'];
							$url_filter2= $filtros_seleccionados[utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['url_filter'];
													
							//remove the filter we don use.
							if ($url_filter2!="&amp;filter="){	
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter2.'@@'.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter2.'@@'.$string_filtering;
							}else{				
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							}				
													
													
														
							 if (($max_value==$min_value) || ($max_value-$min_value<=1)){
					  
									$txt_price_rage_selected=$min_value." ".$productinfo_unit." - ".$max_value." ".$productinfo_unit;
					            
								    $html="<ul>";
									$html.="<li class=\"active\"><em>&nbsp;</em> <a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$url_del."', ajaxurl:'".$ajaxurl_del."', gapush:'no'}\" href=\"javascript:void(0)\"  rel=\"nofollow\"><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a> <span>".$txt_price_rage_selected."</span></li>";
									$html.="</ul>";
											
								}else{

			
									$html=$this->model_module_supercategorymenuadvanced->getSliderHtmlSelected("slider_".$productinfo_name,$scale,$min_value,$max_value,$productinfo_unit,$productinfo_name,$is_ajax,$ajaxurl_del,$url_del,$ajax_url_slider,$filter_url_slider);
									  
								}
									
									//udpate values selected for the selected value
									$this->data['values_selected'][utf8_strtoupper($productinfo_name."_".$productinfo_short_name."_".$productinfo_id)]['html']=$html;
							
							
							}else{
								 if (($max_value==$min_value) || ($max_value-$min_value<=1)){
					  
									$txt_range_selected=$min_value." ".$productinfo_unit." - ".$max_value." ".$productinfo_unit;
									$html=	$this->model_module_supercategorymenuadvanced->getOneHtml($txt_range_selected,$total_productos,$data_settings);
						
								}else{
									$html=$this->model_module_supercategorymenuadvanced->getSliderHtml("slider_".$productinfo_name,$scale,$min_value,$max_value,$productinfo_unit,$productinfo_name,$is_ajax,$ajax_url_slider,$filter_url_slider);
								
								}
								
							}
						
					}
					
						if(!empty($productinfos_all_values)){
							
							$productoinfos[$productinfo_id] = array(
								'productinfo_id' => $productinfo_id,
								'name'      	 => html_entity_decode($productinfo_name),
								'total'			 => count($productinfos_all_values),
								'html'			 => $html,
								'jurjur'    	 => $productinfos_ord,
								'slice'			 => $productinfos_slice_ord,
								'tipo'         	 => 'productinfo',
								'list_number'  	 => $productinfo_number,
								'order'	       	 => $productinfo_orderval,
								'sort_order'   	 => $productinfo_sort_order,
								'initval'	   	 => $productinfo_initval,
								'searchinput'  	 => $productinfo_searchinput,
								'jurjur'	   	 => $productinfos_all_values,
								'view'		   	 => $productinfo_view,
								'is_selected'	 => $is_selected,
								'tip_code'		 => $productinfo_tip_code,
								'tip_div'		 =>	$productinfo_tip					
								);
						}
				
				
					
					}//if($productinfos_values){ 
					
					
					
					}
								
								
					if(!empty($productoinfos)){
						foreach ($productoinfos as $key=>$value){
							if ($value['is_selected']){ //is true
								$productinfo_selected[$key]=$productoinfos[$key];
							}else{
								$productinfo_no_selected[$key]=$productoinfos[$key];
							}
						}
					
				
				
				$this->data['all_product_infos']=$productoinfos;
				$this->data['no_selected_product_infos']=$productinfo_no_selected;
				$this->data['selected_product_infos']=$productinfo_selected;
				
				}
				}//END check if we have filter on product info after apply filters
			}
				
				
			/////////////////////////////////////
			//OPTIONS.-
			////////////////////////////////////
							
				
			$options_in_category=isset($values_in_category['options']) ? $values_in_category['options'] : "no options";

			//We have filter in Product Infos?
			if (is_array($options_in_category)){
				

				foreach ($options_in_category as $option_in_category){
					$option_ids[$option_in_category['option_id']]=$option_in_category['option_id'];
	         	}
			
				$options_in_category_filtered = $this->model_module_supercategorymenuadvanced->getOptionsFiltered($productos_filtrados,$data_filter,$option_ids,$what);

				
				// this is necessary because coul be the option that we dont have products with this option
			   if ($options_in_category_filtered){ 
				
				$options_in_filter_selected=array();
				//We have products in filter 
				if ($data_filter['filter_option_id']){
				//Clean string
				$options_filtrados=explode(",",substr($data_filter['filter_option_id'], 0, -1));
					foreach ($options_filtrados as $options_filtrado){
						$options_in_filter_selected[$options_filtrado] =$options_filtrado;
					}			
				}
							
							
							
				//remove the filter that have dissapear on menu because the result products dont have this filter.		
				$results=array_intersect_key($options_in_category,$options_in_category_filtered);
						
							
				//$results=$options_in_category;
				
				foreach ($results as $result){
		
					
					$option_name=$this->model_module_supercategorymenuadvanced->getOptionName($result['option_id']);	
					$option_id=$result['option_id'];
					$option_number=$result['number'];
					$option_sort_order=$result['sort_order'];
                	$option_orderval=$result['orderval'];
                	$option_separator=$result['separator'];
					$option_view=$result['view'];
					$option_initval= $result['initval'];
					$option_searchinput=$result['searchinput'];
					$option_unit=$result['unit'];
					$option_short_name=$result['short_name'];
					$option_info=$result['info'];
					
					if ($option_info=="yes"){
						$option_tip_code="<img data=\"{tip:'#tooltip".$tip_id."'}\" class=\"extra_info\" src=\"image/supermenu/spacer.gif\" alt=\"\">";
						$option_tip="<div id=\"tooltip".$tip_id."\" class=\"menu_tooltip\" style=\"display:none;\">".$result['text_info'][(int)$this->config->get('config_language_id')]."</div>";
					
						$tip_id++;
					}else {
						$option_tip=$option_tip_code=false;
					}
					
					//GET ALL options VALUES FILTERED
			    	$option_values = $options_in_category_filtered[$option_id];	
		
					$options_all_values = array();
					$option_only_values= array();
					$option_selected=array();
					$option_no_selected=array();
					
					//check if we have options
					if($option_values){ 
						foreach ($option_values as $option_value){
						
						$option_value_name= ($option_value['text']=="") ? "NDDDDDN" : $option_value['text'];
											
						$string_filtering=urlencode($option_name)."_o-".$this->model_module_supercategorymenuadvanced->GetView($option_view)."-".$option_id."-".$option_value['option_value_id']."=".urlencode($option_value_name);
					
						
						if ($filter){					
							$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{				
							$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
						}		
						
												
						$namer=$option_value['text']=="" ? $no_data_text : $option_value['text'];
						$option_only_values[]=(int)str_replace($option_unit,"",$namer);
					
						if (array_key_exists($option_id, $options_in_filter_selected)) {
							$is_selected=1;
						}else{
							$is_selected=0;
						}
						
						$options_all_values['str'.(string)$namer] = array(
								'name'    	   => $namer,
								'href'    	   => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							    'ajax_url'	   => $ajax_url,
								'total'		   => $option_value['total'],
								'image_thumb'  => $option_value['image_thumb'],
								'option_value_id' => $option_value['option_value_id'],
								'tipo'         => 'OPTION',
								'order'	       => $option_value['order'],
								'selected'	   => $is_selected
							);
						
					    }
						
					$options_slice = array();	
					if (count($options_all_values) > $option_number) {
						//get the array and order by total
						$sort_order  = array();
						$option_2slice=$options_all_values;
					
						foreach ($option_2slice as $key => $value) {
							 $sort_order[$key] = $value['total'];
						}
							 array_multisort($sort_order, SORT_DESC,$option_2slice);
							//slice array for present only more important categories
							$options_slice= array_slice($option_2slice,0, $option_number);
						}
								
						//order category from admin config.	
						$options_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($options_all_values,$option_orderval));
						$options_slice_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($options_slice,$option_orderval));
						$total=count($options_ord);
						$list_number=$option_number;
						$view=$option_view;
						$searchinput=$option_searchinput;
	
						//update tip code for selected options.					
						if($is_selected){
							$this->data['values_selected'][utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['tip_code']=$option_tip_code;
							$this->data['values_selected'][utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['tip_div']=$option_tip;
						
						}
						//we have only one filter value and and the same number of products
						if ($total==1 && $options_ord[0]['total']==$total_productos && $view!="slider"){ 
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['html']: $this->model_module_supercategorymenuadvanced->getOneHtml($options_ord[0]['name'],$options_ord[0]['total'],$data_settings);	
						}elseif ($view=="sele") {
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['html']: $this->model_module_supercategorymenuadvanced->getSelectHtml($options_ord,$data_settings,$option_name);
						}elseif ($view=="image"){
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['html']: $this->model_module_supercategorymenuadvanced->getImageHtml($options_ord,$data_settings,$option_name);	
						}elseif($view=="list"){
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['html']: $this->model_module_supercategorymenuadvanced->getListHtml($options_ord,$options_slice_ord,$data_settings,$option_name,$idx,$searchinput);
							$idx++;
						}elseif ($view=="slider"){
							$option_value_name= ($option_value['text']=="") ? "NDDDDDN" : $option_value['text'];
							$string_filtering=urlencode($option_name)."_".$option_short_name."-s-".$option_id;
						
						if ($filter){	
							$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							}else{				
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							}		
						
													
							$max_value=max($option_only_values);
							$min_value=min($option_only_values);
							$half_value=round(($min_value+$max_value)/2,0);
							//$half_value1=round(($min_value+$half_value)/2,0);
							//$half_value2=round(($max_value+$half_value)/2,0);
							//$scale_price="[{$min_price}, '|', {$half_value1}, '|' , {$half_value}, '|', {$half_value2}, '|', {$max_price}]";
							$scale="[{$min_value}, '|', {$half_value}, '|', {$max_value}]";		
							//Width;
							
							if($is_selected){	//
							    				
								/* 
								we need to know the delete url to remove the filter, in this case 
								we check if we have a filter with 'has_filter' and if is true we get the the urls mounted in $filtros_seleccionados array.
								*/
								
								// $string_filtering=urlencode($option_name)."_".$option_short_name."-s-".$option_id;
							      $url_del=$filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['href'];
								  $ajaxurl_del=$filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['ajax_url'];
								  $url_filter2= $filtros_seleccionados[utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['url_filter'];
							
								if (($max_value==$min_value) || ($max_value-$min_value<=1)){
					  
									$txt_price_rage_selected=$min_value." ".$option_unit." - ".$max_value." ".$option_unit;
					               
								    $html="<ul>";
									$html.="<li class=\"active\"><em>&nbsp;</em> <a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$url_del."', ajaxurl:'".$ajaxurl_del."', gapush:'no'}\" href=\"javascript:void(0)\"  rel=\"nofollow\"><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a> <span>".$txt_price_rage_selected."</span></li>";
									$html.="</ul>";
			
								}else{
			
			
									$html=$this->model_module_supercategorymenuadvanced->getSliderHtmlSelected("slider_".$option_name,$scale,$min_value,$max_value,$option_unit,$option_name,$is_ajax,$ajaxurl_del,$url_del,$ajax_url_slider,$filter_url_slider);
									  
								}
									
									//udpate values selected for the selected value
									$this->data['values_selected'][utf8_strtoupper($option_name."_".$option_short_name."_".$option_id)]['html']=$html;
							
							
							}else{
								 if (($max_value==$min_value) || ($max_value-$min_value<=1)){
					  													
									$txt_range_selected=$min_value." ".$option_unit." - ".$max_value." ".$option_unit;
									$html=	$this->model_module_supercategorymenuadvanced->getOneHtml($txt_range_selected,$total_productos,$data_settings);
								}else{
									$html=$this->model_module_supercategorymenuadvanced->getSliderHtml("slider_".$option_name,$scale,$min_value,$max_value,$option_unit,$option_name,$is_ajax,$ajax_url_slider,$filter_url_slider);
								
								}
								
							}
				
						}
				 	
						
						if(!empty($options_all_values)){
							
							$opciones[$option_id] = array(
								'option_id' => $option_id,
								'name'      	 => html_entity_decode($option_name),
								'total'			 => count($options_all_values),
								'html'			 => $html,
								'jurjur'    	 => $options_ord,
								'slice'			 => $options_slice_ord,
								'tipo'         	 => 'option',
								'list_number'  	 => $option_number,
								'order'	       	 => $option_orderval,
								'sort_order'   	 => $option_sort_order,
								'initval'	   	 => $option_initval,
								'searchinput'  	 => $option_searchinput,
								'jurjur'	   	 => $options_all_values,
								'view'		   	 => $option_view,
								'is_selected'	 => $is_selected,
								'tip_code'		 => $option_tip_code,
								'tip_div'		 =>	$option_tip					
								);
						}
			
					}//if($options_values){ 
					
					
					
					}
								
					if(!empty($opciones)){
						foreach ($opciones as $key=>$value){
							if ($value['is_selected']){ //is true
								$option_selected[$key]=$opciones[$key];
							}else{
								$option_no_selected[$key]=$opciones[$key];
							}
						}
					
				
				
				$this->data['all_options']=$opciones;
				$this->data['no_selected_options']=$option_no_selected;
				$this->data['selected_options']=$option_selected;
				
				}
			
			}//End if exits products with the filtering
			
			}
		
			/////////////////////////////////////
			//attributes.-
			////////////////////////////////////
							
				
			$attributes_in_category=isset($values_in_category['attributes']) ? $values_in_category['attributes'] : "no attributes";

			
			//We have filter in Product Infos?
			if (is_array($attributes_in_category)){
				
				foreach ($attributes_in_category as $attribute_in_category){
					$attribute_ids[$attribute_in_category['attribute_id']]=$attribute_in_category['attribute_id'];
	         	}
			
				
				$attributes_in_category_filtered = $this->model_module_supercategorymenuadvanced->getAtributesFiltered($productos_filtrados,$data_filter,$attribute_ids,$what);


				//check if you have attributes with the filters apply
				if ($attributes_in_category_filtered){
					
				$attributes_in_filter_selected=array();
				//We have products in filter 
				if ($data_filter['filter_attribute_id']){
					
				
				$attributes_in_filter_selected=array();
				//Clean string
				$attributes_filtrados=explode(",",substr($data_filter['filter_attribute_id'], 0, -1));
					foreach ($attributes_filtrados as $attributes_filtrado){
						$attributes_in_filter_selected[$attributes_filtrado] =$attributes_filtrado;
					}			
				}
						
						
						
				//remove the filter that have dissapear on menu because the result products dont have this filter.		
				$results=array_intersect_key($attributes_in_category,$attributes_in_category_filtered);
		
		
		    	//$results=$attributes_in_category;
				
				foreach ($results as $result){
		
					$attribute_name= $this->model_module_supercategorymenuadvanced->getAttributeName($result['attribute_id']);
					$attribute_id=$result['attribute_id'];
					$attribute_number=$result['number'];
					$attribute_sort_order=$result['sort_order'];
                	$attribute_orderval=$result['orderval'];
                	$attribute_separator=$result['separator'];
					$attribute_view=$result['view'];
					$attribute_initval= $result['initval'];
					$attribute_searchinput=$result['searchinput'];
					$attribute_unit=$result['unit'];
					$attribute_short_name=$result['short_name'];
					
					$attribute_info=$result['info'];
					
					if ($attribute_info=="yes"){
						$attribute_tip_code="<img data=\"{tip:'#tooltip".$tip_id."'}\" class=\"extra_info\" src=\"image/supermenu/spacer.gif\" alt=\"\">";
						$attribute_tip="<div id=\"tooltip".$tip_id."\" class=\"menu_tooltip\" style=\"display:none;\">".$result['text_info'][(int)$this->config->get('config_language_id')]."</div>";
       					$tip_id++;
					}else {
						$attribute_tip=$attribute_tip_code=false;
					}
					
					
					//GET ALL porductInfoS VALUES FILTERED
			    	$attribute_values = $attributes_in_category_filtered[$attribute_id];	
		
					
					//Mount real values with the separator.
					if ($attribute_separator!="no"){
						$new_array_values= array();
							if($attribute_values){
							foreach ($attribute_values as $attribute_value){
									
								$attributes = explode($attribute_separator, $attribute_value['text']);	
									$total=0;			
									foreach ($attributes as $attribute) {
										if (array_key_exists(trim($attribute), $new_array_values)) {
											$new_array_values[trim($attribute)]=array(
												'text'=>trim($attribute),
												'total'=>$attribute_value['total'] + $new_array_values[trim($attribute)]['total'],
												'separator'=>'YES'
											);
										}else{
											$new_array_values[trim($attribute)]=array(
												'text'=>trim($attribute),
												'total'=>$attribute_value['total'],
												'separator'=>'YES'
											);
										}
									}
								
							}
							$attribute_values=$new_array_values;
							}
					}
				
					$attributes_all_values = array();
					$attribute_only_values= array();
					$attribute_selected=array();
					$attribute_no_selected=array();
					
					//check if we have attributes
					if($attribute_values){ 
						foreach ($attribute_values as $attribute_value){
						
						$attribute_value_name= ($attribute_value['text']=="") ? "NDDDDDN" : $attribute_value['text'];
							
						//this is only for separator	
						if ($attribute_separator!="no"){
							$string_filtering=urlencode($attribute_name)."_a-p-".$attribute_id."=".urlencode($attribute_value_name);
						}else{
							$string_filtering=urlencode($attribute_name)."_a-".$this->model_module_supercategorymenuadvanced->GetView($attribute_view)."-".$attribute_id."=".urlencode($attribute_value_name);
						}
						
						if ($filter){					
							$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{				
							$filter_url=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							$ajax_url=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
						}		
						
						
						$namer=$attribute_value['text']=="" ? $no_data_text : $attribute_value['text'];
						$attribute_only_values[]=(int)str_replace($attribute_unit,"",$namer);
					
						if (array_key_exists($attribute_id, $attributes_in_filter_selected)) {
							$is_selected=1;
						}else{
							$is_selected=0;
						}
						
						$attributes_all_values['str'.(string)$namer] = array(
								'name'    	   => $namer,
								'href'    	   => $this->model_module_supercategorymenuadvanced->SeoFix($filter_url),
							    'ajax_url'	   => $ajax_url,
								'total'		   => $attribute_value['total'],
								'tipo'         => 'ATTRIBUTE',
								'selected'	   => $is_selected
							);
						
					    }
						
					$attributes_slice = array();	
					if (count($attributes_all_values) > $attribute_number) {
						//get the array and order by total
						$sort_order  = array();
						$attribute_2slice=$attributes_all_values;
					
						foreach ($attribute_2slice as $key => $value) {
							 $sort_order[$key] = $value['total'];
						}
							 array_multisort($sort_order, SORT_DESC,$attribute_2slice);
							//slice array for present only more important categories
							$attributes_slice= array_slice($attribute_2slice,0, $attribute_number);
						}
								
						//order category from admin config.	
						$attributes_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($attributes_all_values,$attribute_orderval));
						$attributes_slice_ord = array_values($this->model_module_supercategorymenuadvanced->OrderArray($attributes_slice,$attribute_orderval));
						$total=count($attributes_ord);
						$list_number=$attribute_number;
						$view=$attribute_view;
						$searchinput=$attribute_searchinput;
	
						//update tip code for selected attributtes.					
						if($is_selected){
							$this->data['values_selected'][utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['tip_code']=$attribute_tip_code;
							$this->data['values_selected'][utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['tip_div']=$attribute_tip;
						
						}
	     				//we have only one filter value and and the same number of products
						if ($total==1 && $attributes_ord[0]['total']==$total_productos && $view!="slider"){ 
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['html']: $this->model_module_supercategorymenuadvanced->getOneHtml($attributes_ord[0]['name'],$attributes_ord[0]['total'],$data_settings);	
						}elseif ($view=="sele") {
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['html']: $this->model_module_supercategorymenuadvanced->getSelectHtml($attributes_ord,$data_settings,$attribute_name);
						}elseif ($view=="image"){
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['html']: $this->model_module_supercategorymenuadvanced->getImageHtml($attributes_ord,$data_settings,$attribute_name);	
						}elseif($view=="list"){
							$html=($is_selected)? $filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['html']: $this->model_module_supercategorymenuadvanced->getListHtml($attributes_ord,$attributes_slice_ord,$data_settings,$attribute_name,$idx,$searchinput);
							
							$idx++;
						}elseif ($view=="slider"){
							$attribute_value_name= ($attribute_value['text']=="") ? "NDDDDDN" : $attribute_value['text'];
							$string_filtering=urlencode($attribute_name)."_".$attribute_short_name."-s-".$attribute_id;
						
						if ($filter){	
							$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
							$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter.'@@'.$string_filtering;
						}else{				
							$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
						}		
						
							$max_value=max($attribute_only_values);
							$min_value=min($attribute_only_values);
							$half_value=round(($min_value+$max_value)/2,0);
							//$half_value1=round(($min_value+$half_value)/2,0);
							//$half_value2=round(($max_value+$half_value)/2,0);
							//$scale_price="[{$min_price}, '|', {$half_value1}, '|' , {$half_value}, '|', {$half_value2}, '|', {$max_price}]";
							$scale="[{$min_value}, '|', {$half_value}, '|', {$max_value}]";		
							//Width;
							if($is_selected){	//
							  // $string_filtering=urlencode($attribute_name)."_".$attribute_short_name."-s-".$attribute_id;
							   $url_del=$filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['href'];
							 
							   $ajaxurl_del=$filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['ajax_url'];
						       $url_filter2= $filtros_seleccionados[utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['url_filter'];
												
							if ($url_filter2!="&amp;filter="){	
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.$url_filter2.'@@'.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.$url_filter2.'@@'.$string_filtering;
							}else{
								$filter_url_slider=$this->url->link('product/asearch', $url_where2go).$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
								$ajax_url_slider=$url_where2go.$url_pr.$url_limits.$url_search.'&amp;filter='.$string_filtering;
							}		
						
						
							
								if (($max_value==$min_value) || ($max_value-$min_value<=1)){
					  
									$txt_price_rage_selected=$min_value." ".$attribute_unit." - ".$max_value." ".$attribute_unit;
					               
								    $html="<ul>";
									$html.="<li class=\"active\"><em>&nbsp;</em> <a onclick='testme();' class=\"link_filter_del smenu {dnd:'".$url_del."', ajaxurl:'".$ajaxurl_del."', gapush:'no'}\" href=\"javascript:void(0)\"  rel=\"nofollow\"><img src=\"image/supermenu/spacer.gif\" alt=\"".$remove_filter_text."\" class=\"filter_del\" /></a> <span>".$txt_price_rage_selected."</span></li>";
									$html.="</ul>";
			
								}else{
			
									//$html=$this->model_module_supercategorymenuadvanced->getSliderHtmlSelectedwithUnits("slider_".$attribute_name,$scale,$min_value,$max_value,$attribute_unit,$attribute_name,$is_ajax,$ajaxurl_del,$url_del,$ajax_url_slider,$filter_url_slider);
									$html=$this->model_module_supercategorymenuadvanced->getSliderHtmlSelected("slider_".$attribute_name,$scale,$min_value,$max_value,$attribute_unit,$attribute_name,$is_ajax,$ajaxurl_del,$url_del,$ajax_url_slider,$filter_url_slider);
									  
								}
									
									//udpate values selected for the selected value
									$this->data['values_selected'][utf8_strtoupper($attribute_name."_".$attribute_short_name."_".$attribute_id)]['html']=$html;
							
							
							}else{// is no selected
								 if (($max_value==$min_value) || ($max_value-$min_value<=1)){
					  													
									$txt_range_selected=$min_value." ".$attribute_unit." - ".$max_value." ".$attribute_unit;
									$html=	$this->model_module_supercategorymenuadvanced->getOneHtml($txt_range_selected,$total_productos,$data_settings);
								}else{
									//$html=$this->model_module_supercategorymenuadvanced->getSliderHtmlwithUnits("slider_".$attribute_name,$scale,$min_value,$max_value,$attribute_unit,$attribute_name,$is_ajax,$ajax_url_slider,$filter_url_slider);
								$html=$this->model_module_supercategorymenuadvanced->getSliderHtml("slider_".$attribute_name,$scale,$min_value,$max_value,$attribute_unit,$attribute_name,$is_ajax,$ajax_url_slider,$filter_url_slider);
							
								
								
								}
								
							}
				
						}
				 	
						
						if(!empty($attributes_all_values)){
							
							$atributos[$attribute_id] = array(
								'attribute_id'   => $attribute_id,
								'name'      	 => html_entity_decode($attribute_name),
								'total'			 => count($attributes_all_values),
								'html'			 => $html,
								'jurjur'    	 => $attributes_ord,
								'slice'			 => $attributes_slice_ord,
								'tipo'         	 => 'attribute',
								'list_number'  	 => $attribute_number,
								'order'	       	 => $attribute_orderval,
								'sort_order'   	 => $attribute_sort_order,
								'initval'	   	 => $attribute_initval,
								'searchinput'  	 => $attribute_searchinput,
								'jurjur'	   	 => $attributes_all_values,
								'view'		   	 => $attribute_view,
								'is_selected'	 => $is_selected,
								'tip_code'		 => $attribute_tip_code,
								'tip_div'		 =>	$attribute_tip,	
								
								);
						}
				
				
					
					}//if($attributes_values){ 
					
					
					
					}
								
					if(!empty($atributos)){
						foreach ($atributos as $key=>$value){
							if ($value['is_selected']){ //is true
								$attribute_selected[$key]=$atributos[$key];
							}else{
								$attribute_no_selected[$key]=$atributos[$key];
							}
						}
					
				
				
				$this->data['all_attributes']=$atributos;
				$this->data['no_selected_attributes']=$attribute_no_selected;
				$this->data['selected_attributes']=$attribute_selected;
				
				}
			}//End check if we have products with filter apply
		
	}
		
		
		
	
				//merge and order ALL options,attributes and productInfos
				$all_values= array_merge($opciones,$atributos,$productoinfos);
			
			    $sort_order=array();
				foreach ($all_values as $key => $value) {
                   $sort_order[] = $value['sort_order'];
			  	}
              
			  	array_multisort($sort_order, SORT_ASC,$all_values);
				
				$this->data['all_values'][$settings_module['filter']['super_order']]=$all_values;
				
				if($this->data['all_values'][5][0]['name']=='Availability')
				{
					
					$this->data['all_values'][5][0]['jurjur'][0]['total']=0;

				}
				//print_r('<pre>');
				//print_r($this->data['all_values']);
				//echo $this->data['all_values'][5][0]['jurjur'][0]['name'];
				

				              //merge and order NO SELECTED options,attributes and productInfos
				$all_values= array_merge($option_no_selected,$attribute_no_selected,$productinfo_no_selected);
			
			    $sort_order=array();
				foreach ($all_values as $key => $value) {
                   $sort_order[] = $value['sort_order'];
			  	}
              
			  	array_multisort($sort_order, SORT_ASC,$all_values);
				
				$this->data['values_no_selected'][$settings_module['filter']['super_order']]=$all_values;


               if (!$settings_module['menu_filters']){ // REMOVE FILTERS CHECKED ON MENU EXCEPT PRICE RANGE.
			   $this->data['values_selected']='';
			   }

			
		}else{
			//we don't have products
			//Don't show PRICE RANGE
			//$this->data['price_range_is_not_selected']=false;
			//$this->data['price_range_script']=false;
			$this->data['menu']=false;
			
		} //if (!empty($productos_filtrados)){
	
		
		if (isset($settings_module['template_menu'])){
			$template_menu=$settings_module['template_menu'];
		}else{
			$template_menu='supercategorymenuadvanced.tpl';
		}
		
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/supercategorymenu/templates/'.$template_menu)) {
					$this->template = $this->config->get('config_template') . '/template/module/supercategorymenu/templates/'.$template_menu;
			} else {
					$this->template = 'default/template/module/supercategorymenu/templates/'.$template_menu;
			}		
				
				//echo "no llego aqui";
				
				//SAVE ALL MENU ON CACHE	
				$this->model_module_supercategorymenuadvanced->CacheMenu($this->render(),$data_filter,$what,$this->session->data['currency']);
				$this->response->setOutput($this->render());
		        
		}//end cache menu
		
		
		}//en with categories 

		public function testrecord()
		{

			//unset($this->session->data['custom_filter']);  
			if(isset($this->request->post['hid_array']))
			{
				$this->session->data['custom_filter'] = $this->request->post['hid_array'];
			}
			else
			{
				$this->session->data['custom_filter'] = "";   
				//unset($this->session->data['custom_filter']); 
				//
			}  
		//print_r($this->session->data['custom_filter']);  

	
		
		}

		  
		public function removesession()
		{
		$this->session->data['custom_filter'] = "";  
		}


}

?>

