@extends('template.rent-master')
@section('content')

	<section id="pricing">
      <div class="container">
      	<a href="{{ url('/#services') }}">Services</a> > Rent 
	      <hr>

        @if (!Session::has('id'))
        <div class="template-notice">
          You must be logged in to rental the equipment.
        </div>
        
        <div class="login-first">
          <form action="{{ url('do-login') }}" method="post" class="form">
            @csrf
            <input type="hidden" name="redirect_back" value="true">
            <div class="row">
              <div class="col-md-6">
                <h3>Login</h3>
                <div class="form-group">
                  <input class="form-control" type="text" name="username" placeholder="Username">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <input class="form-control" type="password" name="password" placeholder="Password">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <button type="submit">LOGIN</button>
              </div>
            </div>
          </form>
        </div>

        @else

        <div class="row">
          <div class="col-md-8">
            <h2>Form Peminjaman</h2>
            <form action="{{ url('/rent/do-rent') }}" method="post">
              @csrf
              <div class="form-group">
                <label>Alat Disewa</label>
                <input type="text" class="form-control" name="alat" autofocus="true">
              </div>
              <div class="form-group">
                <label>Tgl Peminjaman</label>
                <input type="date" class="form-control" name="tgl_awal">
              </div>
              <div class="form-group">
                <label>Tgl Pengembalian</label>
                <input type="date" class="form-control" name="tgl_akhir">
              </div>
              <input class="btn btn-main" type="submit" value="Ajukan Peminjaman">
            </form>
          </div>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-12">
            <h2>Peminjaman Anda</h2>
            <table class="table" width="100%" id="pageTable">
              <thead>
                <tr>
                  <td>Alat</td>
                  <td>Tgl Peminjaman</td>
                  <td>Tgl Pengembalian</td>
                  <td>Status</td>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @foreach($rent as $r)
                  <tr>
                    <td>{{ $r->alat_disewa }}</td>
                    <td>{{ $r->tanggal_disewa }}</td>
                    <td>{{ $r->tanggal_dikembalikan }}</td>
                    <td>{{ $r->status }}</td>
                    <td>
                      @if($r->status == 'diterima')
                        <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-success" data-id="{{ $r->id }}" data-penyedia="{{ $r->nama_penyedia }}" data-biaya="{{ $r->nominal }}" data-deskripsi="{{ $r->deskripsi }}" onclick="setModal(this)">Bayar</a>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        @endif
      </div>
    </section>
@endsection

@section('modal')
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>Penyedia : <span id="modal_penyedia"></span></p>
        <p>Biaya : <span id="modal_biaya"></span></p>
        <p>Deskripsi : <span id="modal_deskripsi"></span></p>
        <form method="post" action="{{ url('/rent/purchase') }}">
            @csrf
            <input type="hidden" name="id" id="form_id">
            <div class="form-group">
                <label>Jenis Pembayaran</label>
                <input class="form-control" name="jenis" type="text">
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input class="form-control" name="bank" type="text">
            </div>
            <button class="btn btn-success">Bayar</button>
        </form>
      </div>
    </div>

  </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
  $('#pageTable').DataTable({
      filter: false,
    });

  function setModal(e) {
    $('#form_id').val($(e).data('id'));
    $('#modal_penyedia').text($(e).data('penyedia'));
    $('#modal_biaya').text($(e).data('biaya'));
    $('#modal_deskripsi').text($(e).data('deskripsi'));
  }
</script>
@endsection

