<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- bootstrap Lib -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- datatable lib -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="jquery.toaster.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>

    <!-- validation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <!-- timer -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>

    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- QR Code -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.js"></script>
</head>

<body>
    <h1>QR Code</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form class="form-horizontal" method="post" id="codeForm" onsubmit="return false">
                    <div class="form-group">
                        <label class="control-label">Code Description : </label>
                        <input class="form-control col-xs-1" id="description" type="text" required="required">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Code Quality : </label>
                        <select class="form-control col-xs-10" id="quality">
                            <option value="H">H - best</option>
                            <option value="M">M</option>
                            <option value="Q">Q</option>
                            <option value="L">L - smallest</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Size : </label>
                        <input type="number" min="1" max="10" step="1" class="form-control col-xs-10" id="size" value="5">
                    </div>
                    <div class="form-group">
                        <label class="control-label"></label>
                        <input type="submit" name="submit" id="submit" class="btn btn-success" value="Generate QR Code">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <div class="showQRCode"></div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#codeForm').on('submit', function(e) {
            var description = $('#description').val();
            var quality = $('#quality').val(); 
            var size = $('#size').val();
            $.ajax({
                url: "../database.php",
                type: "POST",
                data: {
                    description: description,
                    quality: quality,
                    size: size,
                    method: 'qrcode'
                },
                success: function(data) {
                    console.log("data");
                    console.log(data);
                    $('.showQRCode').html(data);
                }
            })
        });
    });
</script>
</html>