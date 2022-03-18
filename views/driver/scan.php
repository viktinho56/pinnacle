<?php


require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
require __DIR__ . '/../../partials/drivernavbar.php';

?>
<style>
        /* In order to place the tracking correctly */
        canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 0;
            top: 0;
        }
    </style>
<div id="myid" class="full-panel mt-6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-9 mx-auto grid-margin mb-4 mb-xl-0">
        <div class="row">
          <div class="col-3">
        
           
          </div>
          <div class="col-9">
            <h4 class="font-weight-bold  text-left text-dark">Welcome <span id="username"><?php echo $_SESSION['forename']; ?></span> to your Dashboard</h4>
            <p class="font-weight-normal mb-2 text-muted"></p>
          </div>
        </div>

      </div>
    </div>

    <div class="col-xl-9 d-flex mx-auto grid-margin stretch-card">
       <!-- Div to show the scanner -->
    <div id="scanner-container"></div>
    <input type="button" id="btn" value="Start/Stop the scanner" />

   

    </div>

    <div id="scanner-result"></div>

    </div>
</div>
<script>
  var app = new Vue({
    el: '.full-panel',
    data() {
      return {
        id: '<?php echo $_SESSION["driverid"] ?>',
       order_arr: [],

      };
    },
    methods: {
        Send() {
        axios.get('../../api/order/view_assigned_orders.php?id=<?php echo $_SESSION["driverid"] ?>').then(response => {
          if (response.data.code == 0) {
            
           
          } else {
           
            this.order_arr = response.data;
          console.log(this.order_arr);
           
          }
          
        })
      }
    },
  
    mounted() {
        this.Send();
    },

  });
</script>
 <!-- Include the image-diff library -->
 <script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2@1.2.6/dist/quagga.js"></script>

<script>
    var _scannerIsRunning = false;

    function startScanner() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#scanner-container'),
                constraints: {
                    width: 480,
                    height: 320,
                    facingMode: "environment"
                },
            },
            decoder: {
                readers: [
                    "code_128_reader",
                    "ean_reader",
                    "ean_8_reader",
                    "code_39_reader",
                    "code_39_vin_reader",
                    "codabar_reader",
                    "upc_reader",
                    "upc_e_reader",
                    "i2of5_reader"
                ],
                debug: {
                    showCanvas: true,
                    showPatches: true,
                    showFoundPatches: true,
                    showSkeleton: true,
                    showLabels: true,
                    showPatchLabels: true,
                    showRemainingPatchLabels: true,
                    boxFromPatches: {
                        showTransformed: true,
                        showTransformedBox: true,
                        showBB: true
                    }
                }
            },

        }, function (err) {
            if (err) {
                console.log(err);
                return
            }

            console.log("Initialization finished. Ready to start");
            Quagga.start();

            // Set flag to is running
            _scannerIsRunning = true;
        });

        Quagga.onProcessed(function (result) {
            var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

            if (result) {
                if (result.boxes) {
                    drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                    result.boxes.filter(function (box) {
                        return box !== result.box;
                    }).forEach(function (box) {
                        Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                    });
                }

                if (result.box) {
                    Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                }

                if (result.codeResult && result.codeResult.code) {
                    Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                }
            }
        });


        Quagga.onDetected(function (result) {
            console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
            document.querySelector('#scanner-container').innerHTML=result.codeResult.code;
        });
    }


    // Start/stop scanner
    document.getElementById("btn").addEventListener("click", function () {
        if (_scannerIsRunning) {
            Quagga.stop();
        } else {
            startScanner();
        }
    }, false);
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>

