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
	public function get_metodos_pagos()
	{
		$sql = "SELECT * FROM metodos_pago;";
		echo $this->modelo2->run_query($sql, false);
	}
	public function loadpagos()
	{
		//$sql = "SELECT p.*, CONCAT(u.apellidos, ', ', u.nombres) as alumno, '' metodo_pago FROM usuarios as u, pagos_2 as p WHERE p.id_usuario = u.id";

		$sql = "SELECT p.*, CONCAT(u.apellidos, ', ', u.nombres) as alumno, m.metodo_pago FROM usuarios as u JOIN pagos_2 as p ON p.id_usuario = u.id LEFT JOIN metodos_pago m ON m.id = p.id_metodo_pago;";

		echo $this->modelo2->run_query($sql, false);
	}
	public function loadpagos_2()
	{
		$sql = "SELECT p.*, CONCAT(u.apellidos, ', ', u.nombres) as alumno FROM usuarios as u, pagos_2 as p WHERE p.id_usuario = u.id and p.fecha between '" . $_GET['fecha_desde'] . "' AND '" . $_GET['fecha_hasta'] . "'";
		echo $this->modelo2->run_query($sql, false);
	}
	public function deuda()
	{
		$sql = "SELECT pension FROM usuarios WHERE id = " . $_POST['id_alumno'] . ";";
		echo $this->modelo2->run_query($sql, false);
	}
	function updatePago()
	{
		$_POST['foto_comprobante'] = "";
		$_POST['fproceso'] = "";
		$aux = 0;
		//if (isset($_FILES["foto"])) {
		$fileName = $_FILES["foto"]["name"];
		$fileTmpLoc = $_FILES["foto"]["tmp_name"];
		$fileType = $_FILES["foto"]["type"];
		$fileSize = $_FILES["foto"]["size"];
		$fileErrorMsg = $_FILES["foto"]["error"];
		if (!$fileTmpLoc) {
			//exit();
		}

		if (move_uploaded_file($fileTmpLoc, $_SERVER['DOCUMENT_ROOT'] . "/intranet/system/controllers/comprobantes_pago/$fileName")) {
			$_POST['foto_comprobante'] = $fileName;
			$aux++;
		}
		//}
		//if ($_POST['adeuda'] > 0) {
		//$res = json_decode($this->modelo2->insert_data("pagos_2", $_POST, false));

		$this->modelo2->executor("UPDATE pagos_2 SET monto = monto + " . $_POST['pago'] . ", adeuda = adeuda - " . $_POST['pago'] . " WHERE id = " . $_POST['id'], "update");

		$data = array();
		$data['id_pago'] = $_POST['id'];
		$data['adeuda'] = $_POST['adeuda'] - $_POST['pago'];
		$data['pago'] = $_POST['pago'];
		$data['fecha_creacion'] = date("Y-m-d H:i:s");
		$data['fecha_pago'] = $_POST['fecha'];
		$data['foto_comprobante'] = $_POST['foto_comprobante'];
		$data['id_metodo_pago'] = $_POST['id_metodo_pago'];
		$data['id_concepto'] = $_POST['id_concepto'];
		echo $this->modelo2->insert_data("pagos_parciales", $data, false);
		/*} else {
			echo $this->modelo2->insert_data("pagos_2", $_POST, false);
		}*/
	}
	function save()
	{
		$_POST['foto_comprobante'] = "";
		$_POST['fproceso'] = "";
		$_POST['fproceso'] = date("Y-m-d H:i:s");
		$aux = 0;
		//if (isset($_FILES["foto"])) {
		$fileName = $_FILES["foto"]["name"];
		$fileTmpLoc = $_FILES["foto"]["tmp_name"];
		$fileType = $_FILES["foto"]["type"];
		$fileSize = $_FILES["foto"]["size"];
		$fileErrorMsg = $_FILES["foto"]["error"];
		if (!$fileTmpLoc) {
			//exit();
		}

		if (move_uploaded_file($fileTmpLoc, $_SERVER['DOCUMENT_ROOT'] . "/intranet/system/controllers/comprobantes_pago/$fileName")) {
			$_POST['foto_comprobante'] = $fileName;
			$aux++;
		}
		//}
		//pagos
		$pago['id_usuario'] = $_POST['id_usuario'];
		$pago['fecha'] = $_POST['fecha'];
		$pago['monto'] = $_POST['monto'];
		$pago['id_metodo_pago'] = $_POST['id_metodo_pago'];
		$pago['foto_comprobante'] = $_POST['foto_comprobante'];
		

		$_POST['pagos'] = json_decode($_POST['pagos']);
		//print_r($_POST['pagos']);
		foreach ($_POST['pagos'] as $key => $value) {
			//echo $value->monto_pagado ."<br>";
			if ($value->monto_pagado < $value->monto) {
				//echo "UPDATE plan_pagos SET estado = 0, monto_pagado = " . $value->monto_pagado . ", fecha_pago = '" . $_POST['fecha'] . "' WHERE id = " . $value->id_plan."<br>";
				$this->modelo2->executor("UPDATE plan_pagos SET estado = 0, monto_pago = " . $value->monto_pagado . ", fecha_pago = '" . $_POST['fecha'] . "' WHERE id = " . $value->id_plan, "update");
			} else {
				$this->modelo2->executor("UPDATE plan_pagos SET estado = 1, monto_pago = " . $value->monto_pagado . ", fecha_pago = '" . $_POST['fecha'] . "' WHERE id = " . $value->id_plan, "update");
			}
		}
		$this->modelo2->insert_data("pagos_2", $pago, false);
		/*if ($_POST['adeuda'] > 0) {
			$res = json_decode($this->modelo2->insert_data("pagos_2", $_POST, false));*/
		/*$data = array();
			$data['id_pago'] = $res->LID;
			$data['adeuda'] = $_POST['adeuda'];
			$data['pago'] = $_POST['monto'];
			$data['fecha_creacion'] = date("Y-m-d H:i:s");
			$data['fecha_pago'] = $_POST['fecha'];
			$data['foto_comprobante'] = $_POST['foto_comprobante'];
			$data['id_metodo_pago'] = $_POST['id_metodo_pago'];
			$data['id_concepto'] = $_POST['id_concepto'];
			echo $this->modelo2->insert_data("pagos_parciales", $data, false);*/
		//} else {
		/*if (strlen($_POST['fecha_desde']) > 0 && strlen($_POST['fecha_hasta']) > 0) {
				$monto = $_POST['monto'];
				$datetime1 = new DateTime($_POST['fecha_desde']);

				$datetime2 = new DateTime($_POST['fecha_hasta']);

				$diferencia = $datetime1->diff($datetime2);
				$meses = ($diferencia->y * 12) + $diferencia->m;

				// Sumar 1 si la diferencia en días es mayor a 0 o si quieres contar inclusivamente el mes de inicio
				if ($diferencia->d >= 0 || $datetime1->format('d') == 1) {
					$meses += 1;
				}

				for ($i = 0; $i < $meses; $i++) {
					$_POST['fecha'] = date("Y-m-d", strtotime($_POST['fecha_desde'] . "+$i month"));
					$_POST['monto'] = $monto / $meses;
					$this->modelo2->insert_data("pagos_2", $_POST, false);
				}
			} else {
				echo $this->modelo2->insert_data("pagos_2", $_POST, false);
			}*/
		//}
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
