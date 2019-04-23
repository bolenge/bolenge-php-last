<?php 
	namespace Apps\Frontend\Controllers;

	/**
	 * UsersController
	 */
	class CategoriesController extends \Core\Controller
	{
		public function index($req, $res)
		{
			
		}

		/**
		 * Permet de créer une nouvelle catégorie
		 * @param {Request} $req L'objet de requêtes http
		 * @param {Response} $res L'objet contenant toutes les reponses http
		 */
		public function create($req, $res)
		{
			if ($req->postNotEmpty(['nom', 'description']) && $req->files('media')) {
				$errors = [];

				if (strlen($req->post('nom')) < 2) {
					$errors[] = 'Le nom de la catégorie minimum 2 caractères';
				}

				if (strlen($req->post('description')) < 10) {
					$errors[] = 'La description de la catégorie minimum 10 caractères';
				}

				if (count($errors) == 0) {
					$uploadFile = new \Vendor\ZUpload\UploadFile($req->files('media'));
					$resultUpload = $uploadFile->upload('image', 'img/formations/categories');

					if ($resultUpload['success']) {
						// $_POST = array_merge($_POST, ['media' => 'photo.jpg']);
						$media = [
							'type' => 'image',
							'path' => $resultUpload['data']['folder']
						];
						
						$result = $this->model->create($req->post(), $media);

						if ($result) {
							$this->objetRetour['data'] = $result;
							$this->objetRetour['message'] = "La catégorie a été bien enregistrée";
						}else {
							$this->objetRetour['message'] = "Une erreur est survenue lors de la création de la catégorie";
						}
					}else {
						$this->objetRetour['message'] = $resultUpload['message'];
					}
				}else {
					$this->objetRetour['message'] = implode('<br>', $errors);
				}
			}else {
				$this->objetRetour['message'] = "Veuillez remplir tous les champs";
			}

			$res->send($this->objetRetour);
		}

		/**
		 * Permet de renvoyer une catégorie partant de son id
		 * @param {Request} $req
		 * @param {Response} $res
		 */
		public function getCategorie($req, $res)
		{
			if ($req->getNotEmpty('id_cat')) {
				$cat = $this->model->getCategorieById($req->get('id_cat'));

				if ($cat) {
					$this->objetRetour['success'] = true;
					$this->objetRetour['data'] = $cat;
					$this->objetRetour['message'] = "La catégorie a été bien trouvée";
				}else {
					$this->objetRetour['message'] = "Aucune catégorie trouvée";
				}
			}else {
				$this->objetRetour['message'] = "L'id de la catégorie vide";
			}
			
			$res->send($this->objetRetour);
		}

		/**
		 * Permet de renvoyer toutes les catégories (à moins qu'il y ait une limite)
		 * @param {Request} $req
		 * @param {Response} $res
		 */
		public function getAllcategories($req, $res)
		{
			$limit = $req->getNotEmpty(['limit']) ? $req->get('limit') : null;
			$cats = $this->model->getAllcategories($limit);

			if ($cats) {
				$this->objetRetour['success'] = true;
				$this->objetRetour['data'] = $cats;
				$this->objetRetour['message'] = count($cats) . " catégories ont été trouvées";
			}else {
				$this->objetRetour['message'] = "Aucune categorie trouvée";
			}

			$res->send($this->objetRetour);
		}

		/**
		 * Moddifie les données d'une catégorie
		 * @param {Request} $req
		 * @param {Response} $res
		 */
		public function setCategorie($req, $res)
		{
			if ($req->getNotEmpty(['id_cat'])) {
				$cat = !empty($req->post()) ? $req->post() : null;
				$cat['id'] = $req->get('id_cat');
				$media = $errors = [];

				if ($req->files('media')) {
					$uploadFile = new \Vendor\ZUpload\UploadFile($req->files('media'));
					$resultUpload = $uploadFile->upload('image', 'img/formations/categories');

					if ($resultUpload['success']) {
						$media['path'] = $resultUpload['data']['folder'];
						$media['type'] = 'image';
					}else {
						$errors[] = $resultUpload['message'];
					}
				}

				if (count($errors) == 0) {
					$data = $this->model->setCategorie($cat, $media);
					$this->objetRetour['success'] = true;
					$this->objetRetour['data'] = $data;
					$this->objetRetour['message'] = "Catégorie bien modifiée";
				}else {
					$this->objetRetour['message'] = implode('<br>', $errors);
				}
			}else {
				$this->objetRetour['message'] = "Veuillez renseigner l'identifiant de la catégotie";
			}

			$res->send($this->objetRetour);
		}
	}