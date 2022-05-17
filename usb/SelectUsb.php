<?PHP
//NOVO ARQUIVO SELECT ITEMS
namespace SelectItems\SelectItems;


include_once("./segundaconexao.php");


	class SelectItems
	{
		
		static function selectAllAcessorios()
		{
			global $con;
			$select = "SELECT * FROM outrosdados WHERE categoria = 'Acessorios'";
			$query = mysqli_query($con,$select);
			$retorno = mysqli_fetch_all($query);
			return $retorno;
			
		}
			

		static function selectAllEquipamentos(){
			global $con;
			$select = "SELECT * FROM outrosdados WHERE categoria = 'Equipamentos'";
			$query = mysqli_query($con,$select);
			$retorno = mysqli_fetch_all($query);
			return $retorno;
		}

		static function selectAllMateriais(){
			global $con;
			$select = "SELECT * FROM outrosdados WHERE categoria = 'Materiais'";
			$query = mysqli_query($con,$select);
			$retorno = mysqli_fetch_all($query);
			return $retorno;
		}

		
		static function selectAllMedicamentos(){
			global $con;
			$select = "SELECT * FROM outrosdados WHERE categoria = 'Medicacao'";
			$query = mysqli_query($con,$select);
			$retorno = mysqli_fetch_all($query);
			return $retorno;
		}

		
	}



?>