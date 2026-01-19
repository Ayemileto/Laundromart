<script src="<?=assetUrl("plugins/qrcodejs/qrcode.min.js")?>"></script>

<script>
    function showQRCode(text, append_to)
    {
        var qrdata = document.getElementById(append_to);
        var qrcode = new QRCode(qrdata, {
            text: text,
            width: 200,
            height: 200,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    }
</script>