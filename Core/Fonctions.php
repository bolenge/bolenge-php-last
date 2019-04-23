<?php
	
	/**
	 * Permet d'échapper les balises html
	 * @param string $string = La chaine à échapper
	 * @return string $string = La chaine échappée
	 */
	if (!function_exists('e')) {
		function e($string)
		{
			return htmlspecialchars($string);
		}
	}

	/**
	 * Permet d'échapper les balises html
	 * @param string $url
	 * @param string $page
	 * @return string active
	 */
	if (!function_exists('get_active')) {
		function get_active($url, $page)
		{
			if ($url == $page) {
				return 'active';
			}
		}
	}

	/**
	 * Véririfie si c'est un numéro de téléphone
	 * @param numeric $tel = Le numéro de téléphone à vérifier
	 * @return bool
	 */
	if (!function_exists('is_tel')) {
		function is_tel($tel) {
			if (is_numeric($tel)) {
				if (preg_match('#^\+([1-9]){1}([0-9]){11,14}#', $tel)) {
					return true;
				}

			}
			
			return false;
		}
	}

	/**
	 * Vérifie si le nombre est paire
	 * @param numeric $number = Le nombre à vérifier
	 * @return bool
	 */
	if (!function_exists('is_paire')) {
		function is_paire($number) {
			return !is_float($number / 2) ? true : false;
		}
	}

	/**
	 * Permet de générer un lien
	 * @param string $route = La route
	 * @return string $lien = Le lien généré
	 */
	if (!function_exists('lien')) {
		function lien($route)
		{
			return $_SERVER['REQUEST_URI'].'/'.$route;
		}
	}


	if (!function_exists('parse_slug')) {
		function parse_slug($slug) {
			$new_slug = strtolower($slug);
			$new_slug = preg_replace('# #', '-', $new_slug);
			$new_slug = preg_replace('#é#', 'e', $new_slug);
			$new_slug = preg_replace('#è#', 'e', $new_slug);
			$new_slug = preg_replace('#à#', 'a', $new_slug);
			$new_slug = preg_replace('#â#', 'a', $new_slug);
			$new_slug = preg_replace('#ê#', 'e', $new_slug);
			$new_slug = preg_replace('#û#', 'u', $new_slug);
			$new_slug = preg_replace('#ü#', 'u', $new_slug);
			$new_slug = preg_replace('#ï#', 'i', $new_slug);
			$new_slug = preg_replace('#î#', 'i', $new_slug);
			$new_slug = preg_replace('#ä#', 'a', $new_slug);
			$new_slug = preg_replace('#ë#', 'e', $new_slug);
			$new_slug = preg_replace('#ô#', 'o', $new_slug);
			$new_slug = preg_replace('#ö#', 'o', $new_slug);
			$new_slug = preg_replace("#'#", '-', $new_slug);

			return $new_slug;
		}
	}

	if (!function_exists('unparse_slug')) {
		function unparse_slug($slug) {
			return ucfirst(preg_replace('#-#', ' ', $slug));
		}
	}

	if (!function_exists('debug')) {
		function debug($data)
		{
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			die();
		}
	}

	if (!function_exists('dump')) {
		function dump($data) {
			var_dump($data);
			die();
		}
	}

	if (!function_exists('mois')) {
		function mois($mois) {
			switch ($mois) {
				case '01':
					$mois = 'Janvier';
					break;
				case '02':
					$mois = 'Fevrier';
					break;
				case '03':
					$mois = 'Mars';
					break;
				case '04':
					$mois = 'Avril';
					break;
				case '05':
					$mois = 'Mai';
					break;
				case '06':
					$mois = 'Juin';
					break;
				case '07':
					$mois = 'Juillet';
					break;
				case '08':
					$mois = 'Aout';
					break;
				case '09':
					$mois = 'Septembre';
					break;
				case '10':
					$mois = 'Octobre';
					break;
				case '11':
					$mois = 'Novembre';
					break;
				case '12':
					$mois = 'Decembre';
					break;

				default:
					return false;
					break;

			}
			
			return $mois;
		}
	}

	if (!function_exists('format_date')) {
		function format_date(DateTime $date) {
			$jour = $date->format('d');
			$mois = mois($date->format('m'));
			$annee = $date->format('Y');

			return $jour . ' ' . $mois . ' ' . $annee;
		}
	}
 ?>