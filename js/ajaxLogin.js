$( "#login" ).click(function() { // ini skrip jika tombol login di klik dgn selector id="login" (trigger) pemicu
	var email=$("#email").val(); // ini variable pengirim email
	var password=$("#password").val(); // ini variable pengirim password
	var dataString = 'email='+email+'&password='+password; // digabungkan  kedalam dataString
	$.ajax({ // lakukan pengiriman via ajax
		type	: "POST", // ini metode pengiriman via POST
		url		: "login.php", // ini url file yang berisikan proses PHP
		data	: dataString, // ini perintah pengiriman data dari gabungan STRING diatas
		dataType	: "JSON", // metode respon balik dari proses PHP menggunakan metode json
		beforeSend	: function(){ // ini perintah saat proses pengiriman data dari frontend ke backend
		$("#login").text('Connecting...');  // selagi proses pengiriman tombol login diubah text nya jadi Connecting..
		$("#email").attr("disabled",true);  // selagi proses pengiriman field email akan di disabled
		$("#password").attr("disabled",true);// selagi proses pengiriman field password akan di disabled
		},
		success: function(response){ // ini perintah jika ada respon dari proses PHP dengan kondisi sukes terhubung ke backend
		if(response.status == 'valid'){ // logika dari perintah respon backend jika respon dengan status valid maka 
			setTimeout(function(){ // maka lakukan timing dengan durasi 5000 (5 detik) sebelum eksekusi direction diarahkan 
				window.location = ''+response.direction;+''; // ini untuk mengarahkan direction sesuai perintah dari backend
			}, 3000); 
			$("#login-box-msg").html("<span style='color:green'>"+response.message+"</span>"); // tampilkan pesan sukses dari backend
			$("#login").text('Connected'); // ubah text menadi connected agar tau bahwa itu sudah terhubung
		}else if(response.status == 'invalid'){ // ini logika kebalikan dari jika sukses 
			$('#exampleModal').effect('shake'); // jika tidak sukses maka eksekusi <div id="exampleModal"> untuk di goyangkan.. aseekk...!!!
			$("#email").attr("disabled",false); // input email yang di disabled dikembalikan normal agar bisa diketik ulang
			$("#password").attr("disabled",false); // input password yang di disabled dikembalikan normal agar bisa diketik ulang
			$("#login").text('Login');// tombol dikembalikan sebagai text : Login
			$("#login-box-msg").html("<span style='color:red'>"+response.message+"</span>"); // tampilkan pesan error dari backend PHP
		}
		}
	});

});