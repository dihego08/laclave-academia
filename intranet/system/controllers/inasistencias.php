<?php
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /*ini_set('soap.wsdl_cache_enabled',0);
    ini_set('soap.wsdl_cache_ttl',0);*/

	class inasistencias extends f{
		var $modelo = "";
    	var $html_basico = "";
    	var $html = "";
    	var $baseurl = "";
    	var $modelo2 = "";
		function inasistencias() {
	        session_start();
	        $this->html_basico = $this->load()->lib("Html_basico");
	        $this->html        = $this->load()->lib("html_inasistencias");
	        $this->modelo      = $this->load()->model("modelo");
	        $this->baseurl     = BASEURL;
	        $this->modelo2     = $this->load()->model("MySQLiManager");
	        $this->modelo3     = $this->load()->model("Monodon");
	    }
	    function index() {
	        if ($this->valida(5)) {
	            $h["title"]   = "Reporte de Inasistencias";
	            $c["content"] = $this->html->container();
	            $c["title"]   = "Reporte de Inasistencias";
	            $this->View($h, $c);
	        } elseif ($this->valida(3)) {
	            $h["title"]   = "Reporte de Inasistencias";
	            $c["content"] = $this->html->container();
	            $c["title"]   = "Reporte de Inasistencias";
	            $this->View($h, $c);
	        } else
	            $this->Login();
	    }
	    public function loadinasistencias() {
            $fecha = $_GET['fecha'];

            $sql = "SELECT * FROM usuarios WHERE id NOT IN(SELECT id_alumno FROM asistencias WHERE fecha = '".$fecha."' UNION SELECT id_usuario as id_alumno FROM asistencias_new WHERE fecha = '".$fecha."') and estado = 1;";

            $inasistencias_1 = json_decode($this->modelo3->run_query($sql, false));

            echo json_encode(
            	array(
            		'inasistencias_1' => $inasistencias_1
            	)
            );
	    }
	    function save(){
	        echo $this->modelo3->insert_data("niveles", $_POST, false);
	    }
	    function eliminar(){
	        echo $this->modelo3->delete_data("niveles", array('id' => $_POST['id']));
	    }
	    function editar(){
	        echo $this->modelo3->select_one("niveles", array('id' => $_POST['id_nivel']));
	    }
	    function editarBD(){
	        echo $this->modelo3->update_data("tbl_notas", $_POST);
	    }
	    private function valida($level) {
	        if (isset($_SESSION["user_level"])) {
	            if ($_SESSION["user_level"] == $level) {
	                return true;
	            } else
	                return false;
	        } else
	            return false;
	    }
	    private function View($header, $content) {
	        $h = $this->load()->view('header');
	        $h->PrintHeader($header);
	        $c = $this->load()->view('content');
	        $c->PrintContent($content);
	        $f = $this->load()->view('footer');
	        $f->PrintFooter();
	    }
	}
?>