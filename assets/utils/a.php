<?php
 
/* Muestra la sesión*/
session_start();
 
/* Debemos modificar segun el directorio de instalación*/
require_once __DIR__ . '/facebook/src/Facebook/autoload.php';
 
$fb = new Facebook\Facebook([
  'app_id' => 'Su App ID',
  'app_secret' => 'Su App Secret',
  'default_graph_version' => 'v2.4',
]);
  
$helper = $fb->getRedirectLoginHelper();
  
$permissions = ['email']; // Generar permisos opcionales
$loginUrl = $helper->getLoginUrl('http://localhost/PHP/ejemplos/facebook/fb-callback.php', $permissions);
  
/* Aquí el enlace a la página de login Facebook*/
echo '<a href="'. htmlspecialchars($loginUrl) . '">Iniciar sesión con Facebook!</a>';
 
?>
Paso #02 Creamos un fichero con el nombre fb-callback.php:
A continuación mostramos el contenido de dicho fichero a implementar en nuestro login Facebook.

<?php
 
//Cargar la sesión
session_start();
 
// Cambiar de acuerdo donde hemos instalado el script
require_once __DIR__ . '/facebook/src/Facebook/autoload.php';
 
$fb = new Facebook\Facebook([
  'app_id' => 'Su App ID',
  'app_secret' => 'Su App Secret',
  'default_graph_version' => 'v2.4',
]);
   
$helper = $fb->getRedirectLoginHelper(); 
   
try { 
  $accessToken = $helper->getAccessToken(); 
} catch(Facebook\Exceptions\FacebookResponseException $e) { 
  // Cuando Graph devuelve un error
  echo 'Graph returned an error: ' . $e->getMessage(); 
  exit; 
} catch(Facebook\Exceptions\FacebookSDKException $e) { 
  // Cuando la validación falla 
  echo 'Facebook SDK returned an error: ' . $e->getMessage(); 
  exit; 
} 
 
if (! isset($accessToken)) { 
  if ($helper->getError()) { 
    header('HTTP/1.0 401 Unauthorized'); 
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else { 
    header('HTTP/1.0 400 Bad Request'); 
    echo 'Bad request'; 
  } 
  exit; 
} 
 
// Login directo 
echo '<h3>Acceso Token</h3>'; 
var_dump($accessToken->getValue()); 
   
// Controlador de cliente de OAuth 2.0, para gestionar los accesos
$oAuth2Client = $fb->getOAuth2Client(); 
   
$tokenMetadata = $oAuth2Client->debugToken($accessToken); 
echo '<h3>Metadata</h3>'; 
var_dump($tokenMetadata); 
   
$tokenMetadata->validateExpiration();  
    
if (! $accessToken->isLongLived()) { 
  // Cambiando uno de corta duración a una de larga duración
  try { 
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken); 
  } catch (Facebook\Exceptions\FacebookSDKException $e) { 
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>"; 
    exit; 
  }
  echo '<h3>Long-lived</h3>'; 
  var_dump($accessToken->getValue()); 
}
 
$_SESSION['fb_access_token'] = (string) $accessToken; 
   
?>