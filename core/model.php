<?php

/**
 *
 */
class Model {

	public $table;

	/**
	 * Function pour afficher les details du produits
	 */
	public function findArticle($fields = null) {
		if ($fields == null) {
			$fields = "*";
		};

		$sql = mysql_query("select $fields from " . $this -> table . " where idArticle=" . $this -> idArticle);

		if (mysql_num_rows($sql) > 0) {
			$data = mysql_fetch_assoc($sql);

			foreach ($data as $k => $v) {
				$this -> $k = $v;
			}
			return TRUE;
		} else {
			return FALSE;
		}

	}

	/**
	 * Function pour trouver la liste des produits
	 */
	public function find($data = array()) {

		$condition = "1=1";
		$fields = "*";
		$limit = "";

		if (isset($data["condition"])) {
			$condition = $data["condition"];
		}
		if (isset($data["fields"])) {
			$fields = $data["fields"];
		}
		if (isset($data["limit"])) {
			$limit = "Limit " . $data["limit"];
		}

		$sql = mysql_query("select $fields from " . $this -> table . " where $condition  $limit");
		$d = array();

		while ($data = mysql_fetch_assoc($sql)) {
			$d[] = $data;
		}
		return $d;

	}

	/*
	 * Function pour instancier l'objet selon le nom de la page
	 */
	public static function instance($name = null) {

		require_once $name . ".php";
		return new $name();

	}

}
?>
