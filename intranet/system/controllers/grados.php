<?php
	class grados extends f{
		var $modelo = "";
    	var $html_basico = "";
    	var $html = "";
    	var $baseurl = "";
    	var $modelo2 = "";
		function grados() {
	        session_start();
	        $this->html_basico = $this->load()->lib("Html_basico");
	        $this->html        = $this->load()->lib("html_grados");
	        $this->modelo      = $this->load()->model("modelo");
	        $this->baseurl     = BASEURL;
	        $this->modelo2     = $this->load()->model("MySQLiManager");
	    }
	    function index() {
	        if ($this->valida(5)) {
	            $h["title"]   = "Grados";
	            $c["content"] = $this->html->container();
	            $c["title"]   = "Grados";
	            $this->View($h, $c);
	        } elseif ($this->valida(3)) {
	            $h["title"]   = "Grados";
	            $c["content"] = $this->html->container();
	            $c["title"]   = "Grados";
	            $this->View($h, $c);
	        } else
	            $this->Login();
	    }
	    public function loadgrados() {
	        /*if ($this->valida(5)) {
	             $sql= "select * from grados";   
	        } elseif ($this->valida(3)) {
	            $sql="select * from grados";
	        }*/
	        $sql = "SELECT g.*, a.aula FROM grados as g INNER JOIN aulas as a ON g.id_aula = a.id";
	        $result = $this->modelo2->select('','','',$sql);
	        echo json_encode($result);
	    }
	    function save(){
	        $this->modelo2->insert("grados", $_POST);
	    }
	    function eliminar(){
	        $id  = $_POST['id'];
	        $param = "id = " . $id;
	        $this->modelo2->delete('grados', $param, true);
	    }
	    function editar(){
	        $where = " id = " . $_POST['id'];
	        echo json_encode($this->modelo2->select("*", "grados", $where, ''));
	    }
	    function editarBD(){
	        $data["grado"] = $_POST["grado"];
	        $data["id_aula"] = $_POST["id_aula"];
	        $this->modelo->update("grados", $data, array("id" => $_POST['id']));
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