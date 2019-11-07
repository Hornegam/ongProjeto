<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'ongSoPorElas' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '~vM*gB~]d?1ccqZA|Sx7qo$iyk/;cRpgsvSQRI~PbnyP(}Ws#=K3;/bbe8dgof,r' );
define( 'SECURE_AUTH_KEY',  'BIhII&lX0$SaG/26LKyI!;b()HDxWV5u.1$Tru-%NmYHA>#+@kr+]5Y`ctH paG,' );
define( 'LOGGED_IN_KEY',    '/t{@f2?>z7,&aM+}IqBPY:F=_m*-I@)dIC>[t+EIW/Xs<mM;.8N8hY9#0xARP$8[' );
define( 'NONCE_KEY',        '_-<etE~8ed.DI5rtz_UF*_O0 u=kd|0G==l:w*n%IdGVIeQ{+H=e~TXScX>`dg}+' );
define( 'AUTH_SALT',        ':qZjPO!RVt|[DYc$P=xpoOq|LxvF5(Bp9lblJsoH!4@*=3nmQI>xlBfsxT^&jFTo' );
define( 'SECURE_AUTH_SALT', 'x}i1/aU]GW .Wc8n!R1}O~79NG>3v.WL=raMrY3lO%L^az~`{fLE&W0D<-%L{n3R' );
define( 'LOGGED_IN_SALT',   'LCC)N<T,5*R*EnNUa.3^P?~;$%BZDWkTKx@to;2(Bi5V.*Mv-%hOg0NkY+ L@3,l' );
define( 'NONCE_SALT',       'B?Q$hN&^EB]2N&gooF5h(}+E>r1[<O0@^2Tp:2v1ww<*bltI<3wm(iJYd}X9}6_3' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
