<section class="content">
    <div class="container-fluid">
       
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> <br></h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th><center>Nama</center></th>
                    <th style="width:40%"><center>Aksi</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($Nama as $isinya) 
                  <tr>
                    <td>
                      {{$isinya}}
                    </td>

                    <td>
                      <center>
                      <a href="{{$isinya}}">
                        <i class="fas fa-eye pink"> Read </i> 
                      </a>
                            &nbsp;&nbsp; | &nbsp;&nbsp;
                      <a href="{{$isinya}}">
                        <i class="fas fa-edit cyan"> Edit</i>
                      </a>
                            &nbsp;&nbsp; | &nbsp;&nbsp;
                      <a href="{{$isinya}}">
                        <i class="fas fa-trash indigo"> Delete</i>
                      </a>
                      </center>
                    </td>
                    <!--
                      <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-info"><i class="fas fa-eye"> Read</i></a>
                          <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    -->
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>