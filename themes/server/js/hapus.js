$(document).ready(function(){

	$('#modal-hapus-admin').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","admin&hapus="+id+".php");
	});
        
	$('#modal-hapus-karyawan').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","karyawan&hapus="+id+".php");
	});

	$('#modal-hapus-jabatan').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","jabatan&hapus="+id+".php");
	});

	$('#modal-hapus-absensi').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","absensi&hapus="+id+".php");
	});

	$('#modal-hapus-keterangan').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","keterangan&hapus="+id+".php");
	});

	$('#modal-hapus-departemen').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","departemen&hapus="+id+".php");
	});

	$('#modal-hapus-denda').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

		// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
		var id = div.data('id')
		var modal = $(this)

		// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
		modal.find('#hapus-true-data').attr("href","denda&hapus="+id+".php");
	});

});
