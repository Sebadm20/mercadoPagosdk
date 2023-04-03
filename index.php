<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
$access_token='ESCRIBIR ACA TU TOKEN';
MercadoPago\SDK::setAccessToken($access_token);

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls=array(
    "success"=>"http://localhost/mp/correcto.php",
    "failure"=>"http://localhost/mp/falla.php",
    "pending"=>"http://localhost/mp/falla.php"
);


$productos=[];
$item = new MercadoPago\Item();
$item->title = 'zapatillas';
$item->quantity = 1;
$item->unit_price = 75.56;
array_push($productos, $item);

$preference->items = $productos;
$preference->save();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Prueba mp</title>
</head>
<body>
<script src="https://sdk.mercadopago.com/js/v2"></script>
<div>
    <h1>Utilice el boton para pagar por mercado pago</h1>
</div>
<div class="contenedor-btn"></div>

<!-- SDK MercadoPago.js -->
<script>
    var public_key = 'ESCRIBIR ACA TU CLAVE PUBLICA';
    const mp = new MercadoPago(public_key, {
        locale: 'es-AR'
    });

    mp.checkout({
        preference: {
            id: '<?php echo $preference->id; ?>'
        },
        render: {
            container: '.contenedor-btn',
            label: 'Pagar',
        }
    });
</script>




</body>
</html>
