<?php 
	namespace Apps\Frontend\Models;

	/**
	 * UsersModel
	 */
	class CategoriesModel extends \Core\Model
	{
		public function __construct()
		{
			parent::__construct();
			$this->setTable('categories_formations');
		}

		/**
		 * Permet de créer une catégorie
		 * @param {Object} $datas Les données de la catégorie à ajouter
		 */
		public function create($datas, $media)
		{
			$resCat = $this->add($datas);
			$resMedia = $this->add($media, 'medias');
			$this->setPrimaryKey('id');
			$dataUpdate = [
				'id' => $resCat->id,
				'id_media' => $resMedia->id
			];

			$this->setTable('categories_formations');
			$this->update($dataUpdate);
			return $this->findOne(['cond' => 'id='.$resCat->id]);
		}

		/**
		 * Renvoi une catégorie par rapport à l'identifiant passé en paramètre
		 * @param {*} $id L'identifiant de la catégorie à renvoyer
		 */
		public function getCategorieById($id)
		{
			return $this->findById($id);
		}

		/**
		 * Renvoi toutes les catégories
		 * @param {Integer} $limit
		 */
		public function getAllcategories($limit = null)
		{
			$sql = "SELECT C.id AS id_cat, 
						   C.created AS created_cat,
						   C.nom, 
						   C.description, 
						   C.id_media, 
						   C.etat AS etat_cat,
						   M.path AS media
					FROM categories_formations AS C,
						 medias AS M
					WHERE C.id = M.id
					  AND C.etat = '1'";

			$sql .= $limit ? ' LIMIT ' . $limit : '';
			
			$req = $this->db->prepare($sql);
			$req->execute();

			return $req->fetchAll(\PDO::FETCH_OBJ);
		}

		/**
		 * Modifie une catégorie dont l'id est passé en paramètre
		 * @param {*} $id L'identifiant de la catégorie
		 */
		public function setCategorie($cat, $media)
		{
			$dataMedia = $media ? $this->add($media, 'medias') : null;
			$categorie = $cat;

			if ($dataMedia) {
				$categorie['id_media'] = $dataMedia->id;
			}

			if (count($categorie) > 1) {
				$this->update($categorie, 'categories_formations');
			}

			return $this->findOne(['cond' => 'id='.$cat['id']], 'categories_formations');
		}
	}