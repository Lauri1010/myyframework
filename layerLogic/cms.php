<?php
namespace Framework;
require FRPATH.'layerLogic'.DS.'backend.php';

class cms extends backend{

    public function generateForm($tableName){
        

    }
    
	public function generateInputElement($tableName,$tableColumn,$type,$cols=null,$rows=null){
	
		// TODO: refactored, update
		$validationRow=$tableColumn.'_validation';
		$rules=$this->ds->q->getRowFromSchema($tableName,$validationRow);
	
		// var_dump($this->uValues);
		
		$html='';
	
		$isInteger=false;
		$isDecimal=false;
		$max=false;
		$min=false;
		$isText=false;
		$required=false;
		$intiger=false;
		$maxLenght;
		$minLenght;
	
		if(isset($rules['max'])){
			$maxLenght=$rules['max'];
		}
			
		if(isset($rules['min'])){
	
			$minLenght=$rules['min'];
	
		}
	
		foreach($rules as $indexOrArrayIndex => $rule){
				
			// echo 'Index: '.$indexOrArrayIndex.' '.$rule.'<br/>';
			if($rule=='required'){
				$required=true;
					
			}
	
			if($rule=='intiger'){
					
				$intiger=true;
				if($type=='textArea'){
					die('Textarea not allowed for an intiger column');	
				}
			
			}
	
			if($rule=='decimal'){
					
				$isDecimal=true;
				if($type=='textArea'){
					die('Textarea not allowed for a decimal column');	
				}

			}
				
			if($rule=='string'){
				$isText=true;
	
			}
				
				
		}
	
	
		if($type=='inputField'){
	
			$html.='<input name="'.$tableColumn.'" ';
			if(!empty($this->uValues)){
				$html.=" value=\"{$this->uValues[$tableColumn]}\" ";
			}
			
		}else if($type=='dropDown'){
	
		}else if($type=='textArea'){
				
			if(isset($rows) && isset($cols)){
				$html.='<textarea rows="'.$rows.'" cols="'.$cols.'" name="'.$tableColumn.'" ';
	
			}else{
				$html.='<textarea name="'.$tableColumn.'" ';
			}
		
	
			if($isInteger){
				die('text areas can only be set for text fields!');
	
			}
	
		}else if($type=='checkBox'){

			if($this->uValues[$tableColumn]==1 || $this->uValues[$tableColumn]=="1"){
				$html.='<input type="checkbox" name="'.$tableColumn.'" value="0" checked ';
			}else if($this->uValues[$tableColumn]==0 || $this->uValues[$tableColumn]=="0"){
				$html.='<input type="checkbox" name="'.$tableColumn.'" value="1"';
			}else{
				$html.='<input type="checkbox" name="'.$tableColumn.'" value="1" ';
			}
	
		}else if($type=='fileUpload'){

				
		}

		if(($isInteger || $isDecimal) && $type!='textArea' && $type!='checkBox' && $type!='dropDown'){
				
			$html.=' type="number" ';
			// Note min has to be always set
			// if(!empty($maxLenght) && !empty($minLenght)){
			if(!empty($maxLenght)){
					
				$html.=' maxlength="'.$maxLenght.'"';
	
			}
				
			if($isDecimal){
				$html.=' step="any" ';
	
			}
				
		}
	
	
	
		if($isText && $type!='textArea' && $type!='checkBox' && $type!='dropDown'){
				
			$html.=' type="text" ';
			// Note min has to be always set
			if(!empty($maxLenght)){
	
				$html.=' maxlength="'.$maxLenght.'"';
					
			}
				
		}
	
		if($isText && $type=='textArea'){
	
			// Note min has to be always set
			if(!empty($maxLenght)){
				$html.=' maxlength="'.$maxLenght.'" ';		
			}
	
		}
	
		if(isset($_POST[$tableColumn])){
				
			if($type!='textArea'){
				$html.=' value='.$_POST[$tableColumn].' ';
			}
	
		}
	
		if($required){
			$html.=' required ';
		}
	
		// Close
	
		if($type=='textArea'){
			$html.='>';
			if(isset($_POST[$tableColumn])){
				$html.=$_POST[$tableColumn].' ';	
			}
			
			if(isset($this->uValues[$tableColumn])){
				if(!empty($this->uValues[$tableColumn])){
					$html.=$this->uValues[$tableColumn];
				}
			}
			$html.='</textarea>';
		}else{	
			$html.='>';	
		}
		return $html;
	
	}
	
	
	public function inputField($tableName,$tableColumn){
		return $this->generateInputElement($tableName,$tableColumn,'inputField');
	
	}
	
	public function textArea($tableName,$tableColumn,$rows=5,$cols=50){
		return $this->generateInputElement($tableName,$tableColumn,'textArea',$rows=25,$cols=10);
	
	}
	
	/**
	 * Helper function to create a dropdown.
	 *
	 * */
	// TODO: refactored, update
	public function dropDown($currentTableName,$currentTableColumnRef,$refTable,$refColumnId,$refColumnName,$inputClass=null){

		$validationRow=$currentTableColumnRef.'_validation';
		$rules=$this->ds->q->getRowFromSchema($currentTableName,$validationRow);

		if(is_array($rules)){
	
			if(($refTable!=null) && ($refColumnName!=null)){
					
				$getSql='SELECT DISTINCT '.$refColumnId.','.$refColumnName.' FROM '.$refTable;
				$this->ds->pdo->prepare($getSql);
				$ddResults=$this->ds->pdo->resultset();
				$htmlBeginning='<select name="'.$currentTableColumnRef.'"> ';
					
				foreach($ddResults as $result){
						
					$refIndex=$result[$refColumnId];
					$refCText=$result[$refColumnName];
						
					if(!empty($this->uValues)){
						
						if($this->uValues[$currentTableColumnRef]==$refIndex){
							$htmlBeginning.=' <option value="'.$refIndex.'" selected>'.$refCText.'</option> ';
							
						}else{
							$htmlBeginning.=' <option value="'.$refIndex.'">'.$refCText.'</option> ';
						}
		
					}else{
						$htmlBeginning.=' <option value="'.$refIndex.'">'.$refCText.'</option> ';
					}

				}
				$htmlEnd='</select>';
				return $htmlBeginning.$htmlEnd;
					
			}else{
				die('Dropdown improperly formatted');	
			}
	
		}
	
	}
	
	public function checkBox($tableName,$tableColumn){
		return $this->generateInputElement($tableName,$tableColumn,'checkBox');
	}
	
	public function processSubmit($table,$redirect,$type='create',$updateIdColumn=null,$updateId=null){

		if (!empty($_POST)){

			$errorMessages=$this->ds->q->validate($table);

			// check that all required are present
			
			if(!is_array($errorMessages)){
	            $success=false;
				if($type=='create'){
				    $success=$this->ds->insert($table);
				}else if($type=='update'){
				    $success=$this->ds->update($table,$updateIdColumn,$updateId);
				}
				if($success){
				    header('Location: '.$redirect);
				}else{
				    die('error');
				    // header('Location: site/error');
				}
			}else{
			    foreach($errorMessages as $key => $message){
					if(!empty($message)){
						echo "<p style=\"color:red\">".$message."</p>";
					}
				}
	
			}

		}

	}
	
	
	public function imageUpload($tableName,$tableColumn){
	
	
	}
	
	public function fileUpload(){
	
	
	}
	
	public function is_decimal($val)
	{
		return is_numeric($val) && floor($val) != $val;
	}
	
	
	
	
}