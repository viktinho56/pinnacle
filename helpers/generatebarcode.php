<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require __DIR__. '/../partials/header2.php';
require __DIR__. '/../partials/navbar2.php';
?>

<script src="https://unpkg.com/jsbarcode@latest/dist/JsBarcode.all.min.js"></script>
<body>
<img id="barcode"/>
</body>
<?php
require __DIR__. '/../partials/footer2.php';
$code=$_GET['code'];
?>
<script>
    var code = "<?php echo $code; ?>";
    $(document).ready(function(){
        
        JsBarcode("#barcode", code, {
  format: "CODE128B",
  ean128: true
});


var youtubeimgsrc = document.getElementById("barcode").src;
console.log(youtubeimgsrc);
var valueOfElement = document.getElementById("barcode").src;
                const API_ENDPOINT = 'https://api.cloudinary.com/v1_1/viktinho/upload';
                const fileData = new FormData();
                fileData.append('file', valueOfElement);
                fileData.append('upload_preset', 'dlm0grpa'); // upload preset
                fileData.append('tags', 'xxxxxx'); // optional

                fetch(API_ENDPOINT, {
                        method: 'post',
                        body: fileData
                    }).then(response => response.json())
                    .then(data => {
                        console.log('Success:', data.secure_url);
                       
                    })
                    .catch(err => console.error('Error:', err));
    });
</script>