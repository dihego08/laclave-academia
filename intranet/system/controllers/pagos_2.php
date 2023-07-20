<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class pagos_2 extends f
{
	var $modelo = "";
	var $html_basico = "";
	var $html = "";
	var $baseurl = "";
	var $modelo2 = "";
	function pagos_2()
	{
		session_start();
		$this->html_basico = $this->load()->lib("Html_basico");
		$this->html        = $this->load()->lib("html_pagos_2");
		$this->modelo      = $this->load()->model("modelo");
		$this->baseurl     = BASEURL;
		//$this->modelo2     = $this->load()->model("MySQLiManager");
		$this->modelo2     = $this->load()->model("Monodon");
	}
	function index()
	{
		if ($this->valida(5)) {
			$h["title"]   = "Registro de Pagos";
			$c["content"] = $this->html->container();
			$c["title"]   = "Registro de Pagos";
			$this->View($h, $c);
		} elseif ($this->valida(3)) {
			$h["title"]   = "Registro de Pagos";
			$c["content"] = $this->html->container();
			$c["title"]   = "Registro de Pagos";
			$this->View($h, $c);
		} else
			$this->Login();
	}
	public function loadpagos()
	{
		$sql = "SELECT p.*, CONCAT(u.apellidos, ', ', u.nombres) as alumno FROM usuarios as u, pagos_2 as p WHERE p.id_usuario = u.id";
		echo $this->modelo2->run_query($sql, false);
	}
	public function loadpagos_2()
	{
		$sql = "SELECT p.*, CONCAT(u.apellidos, ', ', u.nombres) as alumno FROM usuarios as u, pagos_2 as p WHERE p.id_usuario = u.id and p.fecha between '" . $_GET['fecha_desde'] . "' AND '" . $_GET['fecha_hasta'] . "'";
		echo $this->modelo2->run_query($sql, false);
	}
	public function deuda(){
		$sql = "SELECT pension FROM usuarios WHERE id = " . $_POST['id_alumno'] . ";";
		echo $this->modelo2->run_query($sql, false);
	}
	function save()
	{
		echo $this->modelo2->insert_data("pagos_2", $_POST, false);
	}
	function eliminar()
	{
		echo $this->modelo2->delete_data('usuarios', array("id" => $_POST["id"]));
	}
	public function eliminar_pago()
	{
		echo $this->modelo2->delete_data('pagos_2', array("id" => $_POST["id"]));
	}
	function editar()
	{
		echo $this->modelo2->select_one("usuarios", array("id" => $_POST["id"]));
	}
	function editarBD()
	{
		$rf = json_decode($this->modelo2->select_one("usuarios", array('id' => $_POST['id'])));

		if ($_FILES['file1']['size'] == 0 && $_FILES['file1']['error'] == 0) {
			$_POST["foto"] = $rf->foto;

			if (!isset($_POST['pass']) || $_POST['pass'] == "" || $_POST['pass'] == null) {
				$_POST["pass"] = $rf->pass;
			} else {
				$_POST["pass"] = md5($_POST['pass']);
			}
		} else {
			$fileName = $_FILES["file1"]["name"];
			$fileTmpLoc = $_FILES["file1"]["tmp_name"];
			$fileType = $_FILES["file1"]["type"];
			$fileSize = $_FILES["file1"]["size"];
			$fileErrorMsg = $_FILES["file1"]["error"];
			if (!$fileTmpLoc) {
				//exit();
			}
			if (move_uploaded_file($fileTmpLoc, $_SERVER['DOCUMENT_ROOT'] . "/intranet/system/controllers/uploads/$fileName")) {

				$_POST["foto"] = $fileName;
				if (!isset($_POST['pass']) || $_POST['pass'] == "" || $_POST['pass'] == null) {
					$_POST["pass"] = $rf->pass;
				} else {
					$_POST["pass"] = md5($_POST['pass']);
				}
			} else {
			}
		}

		//echo $this->modelo3->update_data("profesores", $_POST);
		echo $this->modelo2->update_data("usuarios", $_POST);
	}
	private function valida($level)
	{
		if (isset($_SESSION["user_level"])) {
			if ($_SESSION["user_level"] == $level) {
				return true;
			} else
				return false;
		} else
			return false;
	}
	private function View($header, $content)
	{
		$h = $this->load()->view('header');
		$h->PrintHeader($header);
		$c = $this->load()->view('content');
		$c->PrintContent($content);
		$f = $this->load()->view('footer');
		$f->PrintFooter();
	}
}
