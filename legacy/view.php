<?php

include "config.php";
global $con;
global $BaseUrl;
global $keyword;
global $keyword2;
global $keyword3;
global $keyword4;

// Cek apakah variabel $keyword tersedia
// Artinya cek apakah user telah mengklik tombol search atau belum
// variabel $keyword ini berasal dari file search.php,
// dimana isinya adalah apa yang diinput oleh user pada textbox pencarian

if (!empty($keyword) || !empty($keyword2) || !empty($keyword3) || !empty($keyword4)) {

    session_start();
    // Jika veriabel $keyword ada (user telah mengklik tombol search)

    $param1 = '%' . mysqli_real_escape_string($con, $keyword) . '%';
    $param2 = '%' . mysqli_real_escape_string($con, $keyword2) . '%';
    $param3 = '%' . mysqli_real_escape_string($con, $keyword3) . '%';
    $param4 = '%' . mysqli_real_escape_string($con, $keyword4) . '%';

    $tmp_tgl = explode("/", $keyword4);
    $new_tgl = $tmp_tgl[2] . "-" . $tmp_tgl[1] . "-" . $tmp_tgl[0];

    $fltr = "";
    if (!empty($param1)) {
        $fltr .= " AND a.nama LIKE '" . $param1 . "'";
    }
    if (!empty($param2)) {
        $fltr .= " AND d.nama_departemen LIKE '" . $param2 . "'";
    }
    if (!empty($param3)) {
        $fltr .= " AND e.keterangan LIKE '" . $param3 . "'";
    }
    if (!empty($param4)) {
        $fltr .= " AND a.tanggal LIKE '" . $new_tgl . "'";
    }

    echo '
          <link rel="stylesheet" type="text/css" href="datatable/datatables.min.css"/>
          <script type="text/javascript" src="datatable/datatables.min.js"></script>

          <table id="table_id" class="table table-bordered table-striped table-responsive nowrap">
          <thead>
              <tr>
                  <th style="background:#f39c12;">TANGGAL</th>
                  <th style="background:#f39c12;">JAM</th>
                  <th style="background:#f39c12;">NAMA LENGKAP</th>
                  <th style="background:#f39c12;">USERNAME</th>
                  <th style="background:#f39c12;">DEPARTEMEN</th>
                  <th style="background:#f39c12;">KETERANGAN</th>
                  <th style="background:#f39c12;">ALASAN</th>
                  <th style="background:#f39c12;">EDIT</th>
              </tr>
          </thead>
          <tbody>';


    $query = mysqli_query($con, "SELECT a.id_absensi_detail,a.tanggal,a.jam,a.id_keterangan, b.nama_lengkap, a.nama, c.nama_jabatan, d.nama_departemen,e.keterangan,a.alasan FROM tb_absensi_detail a
                      LEFT JOIN tb_karyawan b ON a.nama = b.username
                      LEFT JOIN tb_jabatan c ON b.id_jabatan = c.id_jabatan
                      LEFT JOIN tb_departemen d ON b.id_departemen = d.id_departemen
                      LEFT JOIN tb_keterangan e ON a.id_keterangan = e.id_keterangan WHERE a.id_keterangan <> '0' $fltr ORDER BY a.tanggal DESC");

    while ($data = mysqli_fetch_array($query)) {

        $tmp_tgl    = explode("-", $data['tanggal']);
        $format_tgl = $tmp_tgl[2] . "/" . $tmp_tgl[1] . "/" . $tmp_tgl[0];

        $tgl_range  = date('Y-m-d');

        echo '
                  <tr class="datarow">
                      <td style="text-align:left;">' . $format_tgl . '</td>
                      <td style="text-align:left">' . $data["jam"] . '</td>
                      <td style="text-align:left;">' . $data["nama_lengkap"] . '</td>
                      <td style="text-align:left;">' . $data["nama"] . '</td>
                      <td style="text-align:left;">' . $data["nama_departemen"] . '</td>
                      <td style="text-align:left;">' . $data["keterangan"] . '</td>
                      <td style="text-align:left;">' . $data["alasan"] . '</td>';
        if ($data['tanggal'] < $tgl_range && $_SESSION['role'] == 'GA') {

            echo '<td style="text-align:left;"><button class="btn btn-default btn-sm" title="EDIT DATA" disabled>
                                                                        <i class="fa fa-edit"></i>
                                                                      </button></td>';
        } else if ($data['tanggal'] < $tgl_range && $_SESSION['role'] == 'USER') {
            echo '<td style="text-align:left;"><button class="btn btn-default btn-sm" title="EDIT DATA" disabled>
                                                                        <i class="fa fa-edit"></i>
                                                                      </button></td>';
        } else {

            echo '<td style="text-align:left;"><a href="#" class="btn btn-success open_modal" id="' . $data['id_absensi_detail'] . '" title="EDIT DATA">
                                                                        <i class="fa fa-edit"></i>
                                                                      </a></td>';
        }
        echo '</tr>';
    }
    echo '
          </tbody>
        </table>';
} else {

    echo '
          <table id="example" class="table table-bordered table-striped table-responsive nowrap">
          <thead>
              <tr>
                  <th style="background:#f39c12;">TANGGAL</th>
                  <th style="background:#f39c12;">JAM</th>
                  <th style="background:#f39c12;">NAMA LENGKAP</th>
                  <th style="background:#f39c12;">USERNAME</th>
                  <th style="background:#f39c12;">DEPARTEMEN</th>
                  <th style="background:#f39c12;">KETERANGAN</th>
                  <th style="background:#f39c12;">ALASAN</th>
              </tr>
          </thead>
          </table>
          ';
}

?>

<!-- MODAL EDIT -->
<div id="ModalEdit" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            order: [],
            columnDefs: [{
                orderable: false,
                targets: 'no-sort'
            }],
            bSort: false,
            "scrollX": false,
            "autoWidth": true,
            "searching": false
        });
    });
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
    $(document).ready(function() {
        $(".open_modal").click(function(e) {
            var m = $(this).attr("id");
            var n = $(this).attr("id");
            $.ajax({
                url: "<?php echo $BaseUrl; ?>/views/modal-edit.php",
                type: "POST",
                data: {
                    id_absensi_detail: m,
                },
                success: function(ajaxData) {
                    $("#ModalEdit").html(ajaxData);
                    $("#ModalEdit").modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        });
    });
</script>
