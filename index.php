<?php


require('vendor/autoload.php');

use App\Http\Controllers\BotManController;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Attachments\Location;
use BotMan\BotMan\Messages\Attachments\File;
use BotMan\BotMan\Messages\Attachments\Video;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

//$botman = resolve('botman');

$config = [
  'telegram' => [
      'token' => '612894582:AAHIJ4VOpYDWdnLvtAfRiEHDq8ZjVJm6hCI',
  ]

];

// Load the driver(s) you want to use
DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
//DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

// Create an instance

$botman = BotManFactory::create($config);

$botman = BotManFactory::create($config);

$botman->hears('.*(Hi|Hello|Hola).*', function ($bot) {
  $bot->typesAndWaits(2);
    $bot->reply('¡Hola!, Soy Accubot ');
    $bot->typesAndWaits(2);
    $bot->reply('¿En que te puedo ayudar?');
});

$botman->hears('.*(Gracias|Ok).*', function ($bot) {
  $bot->typesAndWaits(2);
    $bot->reply('Ha sido un placer. Escribe "ayuda" para mostrar opciones de interes. ');
});

$botman->hears('.*(Contactarlos|contacto).*', function ($bot) {
  $bot->typesAndWaits(2);
    $bot->reply('Nuestro telefono de contacto es (442) 245 15 65');
});


$botman->hears('.*(Soy {name}|Me llamo {name}).*', function ($bot, $name) {
  $bot->typesAndWaits(2);
  $bot->reply('¿En que te puedo ayudar '.$name.' ? ');
});

$botman->fallback(function($bot) {
  $bot->reply('Podrias ser mas especifico. Escribe "Ayuda" para mas opciones');
});


$botman->hears('Promocion', function (BotMan $bot) {
    // Create attachment
    //$attachment = new Image('http://lorempixel.com/400/200/');
     $attachment = new Image('http://accutone-usa.com/wp-content/uploads/2016/05/610-B.jpg');

    // Build message object
    $message = OutgoingMessage::create('Aprovecha nuestra Promoción del mes')
                ->withAttachment($attachment);

    // Reply message object
    $bot->reply($message);
});


$botman->hears('.*(Ubicacion|¿En donde estan?|Direccion|Dirección|Donde estan?|Donde te encuentras?).*', function ($bot) {
  $attachment = new Location(20.606539, -100.378297, [
      'custom_payload' => true,
  ]);

  // Build message object
  $message = OutgoingMessage::create('Estamos ubicados justo aqui : https://www.google.com.mx/maps/place/Accutone+M%C3%A9xico/@20.606539,-100.378297,15z/data=!4m5!3m4!1s0x0:0xc8c93aa69861bf13!8m2!3d20.606539!4d-100.378297')
              ->withAttachment($attachment);

  // Reply message object
  $bot->reply($message);

});

$botman->hears('.*(Jabra|Plantronics|Logitech).*', function ($bot) {
  $bot->typesAndWaits(2);
    $bot->reply('No vendemos esa marca, pero puedes encontrar tu mejor opcion en: https://www.accutone.com.mx, donde te puede atender mi compañera Humana por medio del chat');
});

$botman->hears('.*(PWB|PWM|AD2|AD5|ADLEXUS|UCM|UCB|USB|USM|WT|M910|BT|Bluetooth|Cable|Laptop|Computadora|Ordenador|Callcenter|inalambrica|alambrica|Precio).*', function ($bot) {
  $bot->typesAndWaits(2);
    $bot->reply('Puedes consultar tu mejor opción, precio y disponibilidad en nuestro sitio web: https://www.accutone.com.mx, mi compañera humana te puede atender en el chat y resolver tus dudas.');
});

$botman->hears('.*(Sitio|Pagina web|Página|Pagina).*', function ($bot) {
  $bot->typesAndWaits(1);
    $bot->reply('https://www.accutone.com.mx');
});

$botman->hears('.*(Cotizar|Pedir|Pedido|Comprar|Cotizacion|Cotización|Propuesta).*', function ($bot) {
  $bot->typesAndWaits(1);
    $bot->reply('Aqui puedes elegir tu diadema y realizar tu cotización: https://www.accutone.com.mx/que-diadema-elegir');
});

$botman->hears('.*(Soporte|soporte|soporte técnico|soporte tecnico|support|garantia|ticket|descompuso|descompuesta|no funciona|no se escucha|no se oye|no sirve|no la detecta|no conecta|no puedo conectar).*', function ($bot) {
  $bot->typesAndWaits(1);
    $bot->reply('Puedes ingresar al siguiente link para ir a soporte: https://www.accutone.com.mx/soporte-tecnico');
});

$botman->hears('Audifonos', function ($bot) {
  $bot->typesAndWaits(1);
    $bot->reply('Este es nuestro catalogo :D https://www.dropbox.com/s/tnnusjir0rf61rn/Accutone_Catalogo_de_Audifonos.pdf?dl=0');
});
///////////////////////////EN MODO ARCHIVO///////////////////////////////////////
/*$botman->hears('Audifonos', function ($bot) {
    // Create attachment
    $attachment = new File('https://accutone--c.na30.content.force.com/sfc/servlet.shepherd/version/renditionDownload?rendition=SVGZ&versionId=0683600000C6x7h&operationContext=CHATTER&contentId=05T3600000aqJMO&page=0', [
        'custom_payload' => true,
    ]);

    // Build message object
    $message = OutgoingMessage::create('Este es nuestro catalogo.')
                ->withAttachment($attachment);

    // Reply message object
    $bot->reply($message);
});*/
///////////////////////////COMO ESTA EN FACEBOOK///////////////////////////////////////
/*$botman->hears('Audifonos', function ($bot) {
  // Create attachment
  $attachment = new Location(20.606539, -100.378297, [
      'custom_payload' => true,
  ]);

  // Build message object
  $message = OutgoingMessage::create('Este es nuestro catalogo :D https://www.dropbox.com/s/tnnusjir0rf61rn/Accutone_Catalogo_de_Audifonos.pdf?dl=0')
              ->withAttachment($attachment);

  // Reply message object
  $bot->reply($message);

});*/




$botman->hears('Ayuda', BotManController::class.'@startConversation');

//$botman->hears('Iniciar Platica', BotManController::class.'@iniciarPlatica');

$botman->listen();

?>