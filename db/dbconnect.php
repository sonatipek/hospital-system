<?php

class DBConnect
{
    private $db = null;

    public function __construct()
    {
        $this->openDatabaseConnection();
    }
	
    private function openDatabaseConnection()
    {
        /* Aşağıdaki bağlantı şeklinde veriler Object olarak geri getirilir. $result->user_name gibi!..
         Veri çekme işleminde FETCH_ASSOC kullanılırsa veriler şu şekilde alınır: $result["user_name] !
		*/

        $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

        // PDO bağlayıcı ile veritabanı bağlantısının gerçekleştirilmesi
		try{
			$this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
		}
		catch (PDOException $e){
			echo 'Failure: ' . $e->getMessage();
		}
    }

	
	// -------------------------------- ---------------------------------------
	private function fatal ( $msg )
	{
		echo json_encode( array( 
			"error" => $msg
		) );

		exit(0);
	}
		
	private function bind ( &$a, $val, $type )
	{
		$key = ':binding_'.count( $a );

		$a[] = array(
			'key' => $key,
			'val' => $val,
			'type' => $type
		);

		return $key;
	}	
	//
	protected function sql_exec ( $bindings, $sql=null ){
		// Argument shifting
		if ( $sql === null ) {
			$sql = $bindings;
		}

		$stmt = $this->db->prepare( $sql );
		//echo $sql;

		// Bind parameters
		if ( is_array( $bindings ) ) {
			for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) {
				$binding = $bindings[$i];
				$stmt->bindValue( $binding['key'], $binding['val'], $binding['type'] );
			}
		}

		// Execute
		try {
			$stmt->execute();
		}
		catch (PDOException $e) {
			$this->fatal( $e->getMessage() );
		}


		// Return all
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	

	public function sqlExec ($sql)
	{
		$stmt = $this->db->prepare( $sql );
		// Execute
		try {
			$stmt->execute();
			$stmt->closeCursor();
			return true;// işlem gerçekleştiyse
		}
		catch (PDOException $e) {
			// $this->fatal( $e->getMessage() );
			return false;
		}
	}		
	
	public function fetchAllData($sql){
		try{
			$dbSelect =  $this->db->prepare($sql);	
			$dbSelect->execute();
			$data=$dbSelect->fetchAll(PDO::FETCH_ASSOC);	
			
			if($dbSelect->rowCount() <= 0){
				return false;
			}			
			
			// Kayıt sayısı
			//$recordCount=$this->sql_exec("SELECT FOUND_ROWS() AS recordCount");			
			//return array('recordCount'=>$recordCount[0]['recordCount'],'result'=>$data);
			return $data;
			
		}catch(PDOException $e){
			return null;
		}		
	}
		
	public  function fetchData($sql){
		
		try{
			$dbSelect =  $this->db->prepare($sql);	
			$dbSelect->execute();
			$data=$dbSelect->fetch(PDO::FETCH_ASSOC);

			if($dbSelect->rowCount() <= 0){
				return false;
			}
			
			return $data;
			
		}catch(PDOException $e){
			return null;
		}				
	}

	public function fetchObject($sql){
		try{
			$dbSelect = $this->db->prepare($sql);	
			$dbSelect->execute();
			$objdata=$dbSelect->fetch(PDO::FETCH_OBJ);		
			
			if($dbSelect->rowCount() < 0){
				return false;
			}
			
			return $objdata;

		}catch(PDOException $e){
			return null;
		}		
	}	
	
	
// ********************************** DATATABLE FONKSIYONLARI ********************************************/	
// -------------------------------- Bootstrap Table implamentation ---------------------------------------
	/*
		indis true olduğunda datalara normal sıralama verilir..
		1
		2
		3 gibi
		sql şu şekilde olmalı: SELECT SQL_CALC_FOUND_ROWS  '' as indis,z.* FROM zones z  WHERE
	*/
	public function boostrapTableGetData($request,$sql,$indis=false){
		$limit="";
		$order="";
		
		if ( isset($request['limit']) && isset($request['offset']) ) {
			$limit = "LIMIT ".intval($request['offset']).", ".intval($request['limit']);
		}else{
			$request['offset']=0;
		}
		
		if ( isset($request['order']) && isset($request['sort']) ) {
			$order = " ORDER BY ".$request['sort']." ".$request['order'];
		}
		
		$bindings = array();

		$sql.=" $order $limit";
		//echo $sql;

		$data=$this->sql_exec($bindings,$sql);
		
		// Kayıtlara sıralı numara vermek için 1...20 ilk sütunda
		if($indis){
			foreach($data as $indx => $value){
				$data[$indx]['indis']=$indx+1+$request['offset'];
			}
		}
		
		$resFilterLength=$this->sql_exec("SELECT FOUND_ROWS() AS recordCount");	
		$recordsFiltered = $resFilterLength[0]['recordCount'];

		$recordsTotal=$recordsFiltered;
			
		return array('total'=>$recordsTotal,'rows'=>$data);
			
	}	
	
// -------------------------------- Bootstrap Table Sonu -------------------------------------------------

// -------------------------------- DataTable implamentation ---------------------------------------------	
	private function orders( $request,$fields){
		$order = '';

		if ( isset($request['order']) && count($request['order']) ) {
			$orderBy = array();


			for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {

				// order request listesinde varsa değeri  columns dizindeki indisi gösterir.
				$columnIdx = intval($request['order'][$i]['column']);
				// request columns dizindeki indis dizisi (column) alınır.
				$requestColumn = $request['columns'][$columnIdx];
				
				
				$column = $fields[ $columnIdx ];

				if ( $requestColumn['orderable'] == 'true' ) {
					$dir = $request['order'][$i]['dir'] === 'asc' ?
						'ASC' :
						'DESC';

					$orderBy[] = ' '.$column.' '.$dir;
				}
			}

			$order = 'ORDER BY '.implode(', ', $orderBy);
		}

		return $order;
	}

	private function filter ( $request, $fields, &$bindings,$where=' WHERE ' ){
		$globalSearch = array();
		$columnSearch = array();

		// search parametresi request de varsa
		if ( isset($request['search']) && $request['search']['value'] != '' ) {
			// aranacak sözcük
			$str = $request['search']['value'];

			// listelenen tüm kolonlar
			for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
				//sırayla
				$requestColumn = $request['columns'][$i];
				// incelenek field sırası (indis) alınır
				$columnIdx = $requestColumn['data'];
				//fields listesinden tablo daki adı
				$field = $fields[ $columnIdx ];

				// arama yapma özelliği tanımlandıysa
				if ( $requestColumn['searchable'] == 'true' ) {
					// PDO parametresi olarak düzenle
					$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
					// girilen sözcüğün benzerlerinin aranması
					$globalSearch[] = " $field LIKE ".$binding;
				}
			}
		}

		//print_r($globalSearch);
		// özel olarak kolonlarda arama
		for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
			// sırayla 
			$requestColumn = $request['columns'][$i];
			// incelenek field sırası (indis) alınır
			$columnIdx = $requestColumn['data'];
			//fields listesinden tablo daki adı
			$field = $fields[ $columnIdx ];

			// sütunlardaki search değeri
			$str = $requestColumn['search']['value'];
			// sütun aranabilir mi özellikte mi
			if ( $requestColumn['searchable'] == 'true' &&  $str != '' ) {
				// PDO parametresi olarak düzenle
				$binding =  $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
				// girilen sözcüğün benzerlerinin aranması
				$columnSearch[] = " $field LIKE ".$binding;
			}
		}

		// Combine the filters into a single string
		$wheresql = '';

		if ( count( $globalSearch ) ) {
			$wheresql = '('.implode(' OR ', $globalSearch).')';
		}

		if ( count( $columnSearch ) ) {
			$wheresql = $wheresql === '' ?
				implode(' AND ', $columnSearch) :
				$wheresql .' AND '. implode(' AND ', $columnSearch);
		}

		if ( $wheresql !== '' ) {
			$where .=$wheresql;
		}else{
			$where='';
		}

		return $where;
	}

	private function limit ( $request ){
		$limit = '';

		if ( isset($request['start']) && $request['length'] != -1 ) {
			$limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
		}

		return $limit;
	}
	
	public function dataTableGetData($request,$fields,$base_sql){

		$bindings = array();

		$arr_fields=explode(",",$fields);

		$order=$this->orders($request,$arr_fields);
		$limit=$this->limit($request);

		$sql=$base_sql."  $order  $limit";

			
		$data=$this->sql_exec($bindings,$sql);
		$resFilterLength=$this->sql_exec("SELECT FOUND_ROWS() AS recordCount");
		$recordsFiltered = $resFilterLength[0]['recordCount'];

		$recordsTotal=$recordsFiltered;
		
		return array('draw'=>intval( $request['draw'] ),'recordsTotal'=>$recordsTotal,
			'recordsFiltered'=>$recordsFiltered,'data'=>$data);			
	}
	
	
// -------------------------------- DataTable Sonu -------------------------------------------------------	

// -------------------------------- DxGride Implementation------------------------------------------------
	/*
		indis true olduğunda datalara normal sıralama verilir..
		1
		2
		3 gibi
		sql şu şekilde olmalı: SELECT  '' as indis,z.* FROM zones z  WHERE
	*/
	protected function dxGridData($request,$sql,$indis=false){
		
		$matched=preg_match("/CALL/",$sql);
		// Store procedure değilse
		if($matched == 0){
			// Select fieldname,.... şeklinde geleb sql düzenlenir.
			$matched=preg_match("/SQL_CALC_FOUND_ROWS/",$sql);
			if($matched == 0){
				$sql=preg_split("/SELECT/i",$sql);		
			
				if($indis){
					$sql="SELECT SQL_CALC_FOUND_ROWS '' AS indis,".$sql[1];
				}else{
					$sql="SELECT SQL_CALC_FOUND_ROWS ".$sql[1];
				}	
			}	
		}
		
		$limit="";
		$order="";
		$groupby="";

		if(isset($request['group'])){
			$groupby=$request['group']['selector'];
			$groupby="GROUP BY ".$groupby;
		}
		
		if(isset($request['sort'])){
			$order=$request['sort']['selector'];
			if($request['sort']['desc'] == 'false'){
				$order.=" ASC";
			}else{
				$order.=" DESC";
			}
			$order="ORDER BY ".$order;
		}
		
		if(isset($request['skip']) && isset($request['take'])){
			$offset=$request['skip'];
			$limit=$request['take'];
			$limit="LIMIT $offset,$limit";
		}	
		
		$sql.=" $groupby $order $limit";
		//echo $sql;
		$data=$this->fetch_AllData($sql);
		if($data == false){
			$data=[];
		}
		// Kayıtlara sıralı numara vermek için 1...20 ilk sütunda
		if($indis){
			foreach($data as $indx => $value){
				$data[$indx]['indis']=$indx+1+$request['offset'];
			}
		}
		$resFilterLength=$this->fetch_Data("SELECT FOUND_ROWS() AS recordCount");
		$recordsTotal = $resFilterLength['recordCount'];
		//$resFilterLength=$this->sql_exec("SELECT FOUND_ROWS() AS recordCount");	
		//$recordsTotal = $resFilterLength[0]['recordCount'];
		return array('recordCount'=>$recordsTotal,'result'=>$data);			
	}	

	public function getDbConn(){
		return $this;
	}
}