function getXMLHTTPRequest() {
  if (window.XMLHttpRequest) {
    // code untuk modern browsers
    // Semua browser modern (Chrome, Firefox, IE7+, Edge, Safari, Opera)
    // memiliki objek XMLHttpRequest bawaan.

    return new XMLHttpRequest();
  } else {
    // code untuk old IE browsers
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}
// function Update() {
//     var xmlhttp = getXMLHTTPRequest();

//     xmlhttp.onreadystatechange = function () {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             // Perbarui status dengan respons dari server
//             document.getElementById("status").innerHTML = xmlhttp.responseText;
//         }
//     };

//     xmlhttp.open('GET', 'update_status.php?idloker=' + idloker.value, true);
//     xmlhttp.send();
// }

// // Jalankan pembaruan status setiap 5 detik
// setInterval(updateStatus, 5000); // Ubah angka 5000 sesuai dengan interval yang Anda inginkan (dalam milidetik)

// updateStatus();

// update_status.js

// function updateStatus(idloker) {
//     // Buat objek XMLHttpRequest
//     var xhr = new XMLHttpRequest();

//     // Definisikan fungsi yang akan dijalankan ketika permintaan selesai
//     xhr.onreadystatechange = function () {
//         if (xhr.readyState === 4 && xhr.status === 200) {
//             // Perbarui status loker berdasarkan respons yang diterima dari server
//             var status = xhr.responseText;
//             document.getElementById("status").innerText = status;
//         }
//     };

//     // Buat permintaan GET untuk memperbarui status
//     xhr.open("GET", "update_status.php?idloker=" + idloker, true);
//     xhr.send();
// }

function selesaikanSeleksi() {
  location.reload();
}

function refreshPage() {
  setTimeout(function () {
    location.reload();
  }, 1000); // 1000 milliseconds (1 second) delay before refreshing
  window.onload = refreshPage;
}

// Call the refreshPage function when the page is loaded
