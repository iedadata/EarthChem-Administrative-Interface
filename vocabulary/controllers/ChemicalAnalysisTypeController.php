<?php

/*
******************************************************************
Vocabulary REST API
Chemical Anlysis Type Controller
Author: Jason Ash (jasonash@ku.edu)
Description: This controller enables the creation/retrieval of
				chemical analysis type entries.
******************************************************************
*/

class ChemicalAnalysisTypeController extends RESTController
{
 
    public function getAction($request) {
    
        if(isset($request->url_elements[2])) {
			$id = $request->url_elements[2];
			$searchid = (int) str_replace("catype","",$id);

			if(is_int($searchid)){
				$row = $this->db->get_row("select * from earthchem.action_type where action_type_num in (20,28,29,30,31) and action_type_num=$searchid");
				if($row->action_type_num){
						$num = $row->action_type_num;
						$preflabel = $row->action_type_name;
						$altlabel = $row->action_type_description;
						$definition = "Chemical Analysis Type from EarthChem ODM2 database.";
					
						$data=$this->jsonObject("chemicalAnalysisType", $num, $preflabel, $altlabel, $definition, "catype");
				}else{
					header("Not Found", true, 404);
					$data["Error"] = "Chemical Analysis Type $id not found.";
				}
			}else{
				header("Not Found", true, 404);
				$data["Error"] = "Chemical Analysis Type $id not found.";
			}


        } else {
        	
        	if($_GET){
        	
        		if($_GET['label']){

					$label = strtolower($_GET['label']);
					
					$rows = $this->db->get_results("select * from earthchem.action_type where action_type_num in (20,28,29,30,31) and lower(action_type_name) like '%$label%';
													
													");
					$data['resultcount']=count($rows);
					if(count($rows) > 0){
						$results = [];
						$data['resultcount']=count($rows);
						foreach($rows as $row){
							
							$num = $row->action_type_num;
							$preflabel = $row->action_type_name;
							$altlabel = $row->action_type_description;
							$definition = "Chemical Analysis Type from EarthChem ODM2 database.";
					
							$data['results'][]=$this->jsonObject("chemicalAnalysisType", $num, $preflabel, $altlabel, $definition, "catype");
							
						}
					}else{
						$data['resultcount']=0;
						$data['results']=array();
					}
        		
        		}else{
        		
					header("Bad Request", true, 400);
					$data["Error"] = "Invalid Query Parameter.";
        		
        		}
        	
        	}else{

				//list all action_type entries here
				$rows = $this->db->get_results("select * from earthchem.action_type where action_type_num in (20,28,29,30,31) order by action_type_name");
				$data['resultcount']=count($rows);
				foreach($rows as $row){
					
					$num = $row->action_type_num;
					$preflabel = $row->action_type_name;
					$altlabel = $row->action_type_description;
					$definition = "Chemical Analysis Type from EarthChem ODM2 database.";
					
					$data['results'][]=$this->jsonObject("chemicalAnalysisType", $num, $preflabel, $altlabel, $definition, "catype");

				}

        	}
        	
        	

        }
        return $data;
    }

    public function deleteAction($request) {

    }

    public function postAction($request) {

    }

    public function putAction($request) {
    	
		header("Bad Request", true, 400);
		$data["Error"] = "Bad Request.";

        return $data;
    }

    public function optionsAction($request) {
    	
		header("Bad Request", true, 400);
		$data["Error"] = "Bad Request.";

        return $data;
    }

    public function patchAction($request) {
    	
		header("Bad Request", true, 400);
		$data["Error"] = "Bad Request.";

        return $data;
    }

    public function copyAction($request) {
    	
		header("Bad Request", true, 400);
		$data["Error"] = "Bad Request.";

        return $data;
    }

    public function searchAction($request) {
    	
		header("Bad Request", true, 400);
		$data["Error"] = "Bad Request.";

        return $data;
    }


}

