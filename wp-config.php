<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'itteville_sur_mer');


/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');


/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');


/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');


/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');


/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ']ypn[`:*?)?=|Y!B8}r|4b2?x`.:HyzVc%CP3_CWNj=vHJ6#_#Fhg0?L_?6`k1NP');

define('SECURE_AUTH_KEY',  '6;=)tC5qNjn>04m]YYfM_GGDf6Y{?31u5P0;in5e;0CGC+khZ5wmwqB;oY+[A/Ic');

define('LOGGED_IN_KEY',    '.Id-;t2]#)x/&q][s -+>4su+)WcD>LlRjA[TE?8P2ytS.f_%!Q2K}Z1VG2Bl:CF');

define('NONCE_KEY',        '@&lS[_]k4pOPQ-ygvYXUs& Pn_8D3P_}NmD1/5^~35|c9!9Tj@/6j{T]z[EgUrIg');

define('AUTH_SALT',        '8@Z<]RvMZDvUWFraLDE0??L?k?*qtvK?ss@m{jeY|}Mb;ODZtIr^tF)>XLY1xFCb');

define('SECURE_AUTH_SALT', 'z)Opa};3ZD;]=MvEE_@Owu=lLaEGie9;RlHd!cEnq@mfoPhO~$5l^h5x1zn:2 p2');

define('LOGGED_IN_SALT',   '!@z0yMGR{fM&v<L3|qfqUU{Em]r=*ad7a^b,Vn*F+p??dq)5[r,@/NVhqa@OwyvY');

define('NONCE_SALT',       '+0]H`uZkvCx[/cMC5K4tJI~2wKF^L %dh{IcB@8)bl.rr6[sA/&7F(PQO{9lxUAH');

/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'al_';


/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');