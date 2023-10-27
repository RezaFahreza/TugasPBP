<script>
    document.addEventListener('DOMContentLoaded', function () {
        function updateStatus() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'update_status.php?idloker=<?php echo $idloker; ?>', true);

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Perbarui status dengan respons dari server
                    document.getElementById('status').textContent = xhr.responseText;
                }
            };

            xhr.send();
        }

        // Jalankan pembaruan status setiap 5 detik
        setInterval(updateStatus, 5000); // Ubah angka 5000 sesuai dengan interval yang Anda inginkan (dalam milidetik)
    });
</script>
