<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
/*ini_set('soap.wsdl_cache_enabled',0);
    ini_set('soap.wsdl_cache_ttl',0);*/

class asistencias_new extends f
{
	var $modelo = "";
	var $html_basico = "";
	var $html = "";
	var $baseurl = "";
	var $modelo2 = "";
	function asistencias_new()
	{
		session_start();
		$this->html_basico = $this->load()->lib("Html_basico");
		$this->html        = $this->load()->lib("html_asistencias_new");
		$this->modelo      = $this->load()->model("modelo");
		$this->baseurl     = BASEURL;
		$this->modelo2     = $this->load()->model("MySQLiManager");
		$this->modelo3     = $this->load()->model("Monodon");
	}
	function index()
	{
		if ($this->valida(5)) {
			$h["title"]   = "Registro de Asistencias";
			$c["content"] = $this->html->container();
			$c["title"]   = "Registro de Asistencias";
			$this->View($h, $c);
		} elseif ($this->valida(3)) {
			$h["title"]   = "Registro de Asistencias";
			$c["content"] = $this->html->container();
			$c["title"]   = "Registro de Asistencias";
			$this->View($h, $c);
		} else
			$this->Login();
	}
	public function loadasistencias()
	{
		$id_alumno = $_GET['id_alumno'];
		$fecha_desde = $_GET['fecha_desde'];
		$fecha_hasta = $_GET['fecha_hasta'];

		$sql = "SELECT * FROM asistencias WHERE id_alumno = " . $id_alumno . " AND fecha BETWEEN '" . $fecha_desde . "' AND '" . $fecha_hasta . "'";
		echo $this->modelo3->run_query($sql, false);
	}
	function save()
	{
		echo $this->modelo3->insert_data("niveles", $_POST, false);
	}
	function eliminar()
	{
		echo $this->modelo3->delete_data("niveles", array('id' => $_POST['id']));
	}
	function editar()
	{
		echo $this->modelo3->select_one("niveles", array('id' => $_POST['id_nivel']));
	}
	function editarBD()
	{
		echo $this->modelo3->update_data("tbl_notas", $_POST);
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
	function marcar_asistencia()
	{
		include('../env/env.php');
		$alumno = $this->modelo3->select_one("usuarios", array('dni' => $_POST['codigo_dni']));
		if (!empty($alumno)) {

			$alumno = json_decode($alumno);
			$aula = json_decode($this->modelo3->select_one("aulas", array('id' => $alumno->id_aula)));
			$aula_alumno = "Sin aula";
			if (empty($aula)) {
				$aula = json_decode($this->modelo3->select_one("aulas", array('id' => $alumno->id_aula_designada)));
				$aula_alumno = $aula->aula;
			} elseif (is_null($aula->aula) || empty($aula->aula)) {
			} else {
				$aula_alumno = $aula->aula;
			}
			$e_cuenta = $this->estado_cuenta($alumno->id);

			//$area = json_decode($this->modelo3->select_one("areas", array('id' => $alumno->id_area)));

			$sql = "SELECT A.area FROM areas A JOIN carreras C ON C.id_area = A.id AND C.id = " . $alumno->id_carrera;
			//echo $this->modelo3->run_query($sql, false);
			$area = json_decode($this->modelo3->run_query($sql, false));
			//print_r($area);

			// print_r($e_cuenta);
			$anio = date("Y");
			$fecha = date("Y-m-d");
			$id_periodo = 0;
			$aux = 0;

			$_POST['fecha'] = $fecha;
			$_POST['hora'] = date("H:i:s");

			$_POST['id_usuario'] = $alumno->id;

			$this->modelo3->insert_data("asistencias_new", $_POST, false);
			$dia_hoy = date("d");
			//print_r($e_cuenta);
			if (empty($e_cuenta) || count($e_cuenta) == 0) {
				$ecuenta = '<span class="badge badge-danger" style="font-size: 100%;">Deuda</span> <span class="badge badge-primary" style="font-size: 100%;">' . ($alumno->fecha_pago - $dia_hoy) . ' días restantes.</span>';
			} else {
				if ($e_cuenta[0]->adeuda > 0) {
					$ecuenta = '<span class="badge badge-warning" style="font-size: 100%;">Deuda Pendiente (S/ ' . number_format($e_cuenta[0]->adeuda, 2) . ')</span> <span class="badge badge-danger" style="font-size: 100%;">Vencimiento: ' . (date("Y-m-") . $alumno->fecha_pago) . '</span>';
				} else {
					if (date("Y", strtotime($e_cuenta[0]->fecha)) == date("Y", strtotime(date("Y-m-" . $alumno->fecha_pago))) && date("m", strtotime($e_cuenta[0]->fecha)) == date("m", strtotime(date("Y-m-" . $alumno->fecha_pago)))) {
						$ecuenta = '<span class="badge badge-success" style="font-size: 100%;">Al día</span>';
					} else {
						$dia = '';
						if (is_null($alumno->fecha_pago) || empty($alumno->fecha_pago)) {
							$dia = date("d");
						} else {
							$dia = $alumno->fecha_pago;
						}
						$datetime1 = new DateTime(date("Y-m-" . $dia));

						$datetime2 = new DateTime($fecha);

						$difference = $datetime1->diff($datetime2);

						if ($difference->days >= 1) {
							$ecuenta = '<span class="badge badge-danger" style="font-size: 100%;">Deuda</span> <span class="badge badge-primary" style="font-size: 100%;">' . ($dia_hoy - $alumno->fecha_pago) . ' días Atraso.</span>';
						} else {
							$ecuenta = '<span class="badge badge-success" style="font-size: 100%;">Al día</span>';
						}
					}
				}
			}
			unset($alumno->pass);
			$result = array(
				'Code' => '100',
				'Data' => $alumno,
				'Ecuenta' => array("ecuenta" => $ecuenta),
				'aula' => $aula_alumno,
				'area' => $area[0]->area
			);
			echo json_encode($result);
		} else {
			$result = array(
				'Code' => '404'
			);
			echo json_encode($result);
		}
	}
	public function estado_cuenta($id_usuario)
	{
		// $pago = $this->modelo3->select_one("pagos_2", array('id_usuario' => $id_usuario, "month(fecha)" => date("m")));
		//echo date("m");
		return json_decode($this->modelo3->run_query("SELECT * from pagos_2 where id_usuario = $id_usuario order by id desc limit 1;", false));
		//print_r($pago);
		// return $pago;
	}
}
