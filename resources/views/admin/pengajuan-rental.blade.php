<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PATANI Admin</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('assets/img/logo_square.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo_square.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/assets/css/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="index.html">
                            <i class="menu-icon fa fa-book"></i>Pengajuan Rental 
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="{{ asset('assets/img/footer-logo.png') }}" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{ asset('assets/img/footer-logo.png') }}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="user-area float-right">
                        <a href="{{ url('do-logout') }}" class="dropdown-toggle">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </header><!-- /header -->
        <!-- Header-->

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Pengajuan Rental Alat</strong>
                            </div>
                            <div class="card-body">
                                <table class="table" id="pageTable">
                                    <thead>
                                        <tr>
                                          <th scope="col">Alat disewa</th>
                                          <th scope="col">User</th>
                                          <th scope="col">Tanggal disewa</th>
                                          <th scope="col">Tanggal dikembalikan</th>
                                          <th scope="col">Status pembayaran</th>
                                          <th scope="col">Status penyewaan</th>
                                          <th scope="col" class="text-center">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($rent as $r)
                                        <tr>
                                            <th>{{ $r->alat_disewa }}</th>
                                            <td>{{ $r->nama }}</td>
                                            <td>{{ $r->tanggal_disewa }}</td>
                                            <td>{{ $r->tanggal_dikembalikan }}</td>
                                            <td>{{ $r->status_pembayaran }}</td>
                                            <td>{{ $r->status_penyewaan }}</td>
                                            <td>
                                                @if($r->status_penyewaan == 'diajukan')
                                                <div class="btn-group">
                                                    <a class="btn btn-success" href='#' data-toggle="modal" data-target="#myModal" data-id="{{ $r->id }}" data-alat="{{ $r->alat_disewa }}" data-nama="{{ $r->nama }}" onclick="setModal(this)">Terima</a>
                                                    <a class="btn btn-danger" href='{{ url("/admin/rent/set-status/ditolak/$r->id") }}'>Tolak</a>
                                                </div>
                                                @elseif($r->status_penyewaan == 'dibayar')
                                                <a class="btn btn-success" href='{{ url("/admin/rent/set-status/dipinjam/$r->id") }}'>Dipinjam</a>
                                                @elseif($r->status_penyewaan == 'dipinjam')
                                                <a class="btn btn-success" href='{{ url("/admin/rent/set-status/dikembalikan/$r->id") }}'>Dikembalikan</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

<div class="clearfix"></div>

<footer class="site-footer">
    <div class="footer-inner bg-white">
        <div class="row">
            <div class="col-sm-6">
                Copyright &copy; 2018 Ela Admin
            </div>
            <div class="col-sm-6 text-right">
                Designed by <a href="https://colorlib.com">Colorlib</a>
            </div>
        </div>
    </div>
</footer>

</div><!-- /#right-panel -->

<!-- Right Panel -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">#<span id="modal_id"></span></h4>
      </div>
      <div class="modal-body">
        <p>Peminjam : <span id="modal_nama"></span></p>
        <p>Alat dipinjam : <span id="modal_alat"></span></p>
        <form method="post" action="{{ url('admin/rent/approved') }}">
            @csrf
            <input type="hidden" name="id" id="form_id">
            <div class="form-group">
                <label>Penyedia</label>
                <select name="penyedia" class="form-control">
                    @foreach($supplier as $p)
                        <option value="{{ $p->id_penyedia }}">{{ $p->nama_penyedia }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Biaya Sewa</label>
                <input class="form-control" name="biaya" type="number">
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi"></textarea>
            </div>
            <button class="btn btn-success">Approve</button>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
<script src="{{ asset('assets/admin/assets/js/main.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    @if (session('status'))
        alert("{{ session('status') }}");
    @endif

    jQuery('#pageTable').DataTable({
      filter: false,
      order: [[ 2, "desc" ]],
    });

    function setModal(e) {
        jQuery('#modal_id').text(jQuery(e).data('id'));
        jQuery('#form_id').val(jQuery(e).data('id'));
        jQuery('#modal_nama').text(jQuery(e).data('nama'));
        jQuery('#modal_alat').text(jQuery(e).data('alat'));
    }
</script>
</body>
</html>
