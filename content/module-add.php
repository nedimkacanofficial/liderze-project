    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Modül İşlemleri</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Modül İşlemleri</a></li>
                            <li class="breadcrumb-item active">Modül İşlemleri</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary justify-content-center">
                            <div class="card-header">
                                <h3 class="card-title">Modul Ekle</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="#" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Başlık</label>
                                        <input type="text" class="form-control" id="title" placeholder="Başlık" name="title">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="status" name="status" value="1" checked="checked">
                                        <label class="form-check-label" for="status">Aktif / Pasif</label>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Oluştur</button>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <?php
                                            if ($_POST) {
                                                $execute = $DB->insertModule();
                                                if ($execute) {
                                            ?>
                                                    <div class="alert alert-success alert-dismissible">
                                                        Modül başarılı bir şekilde oluşturuldu.
                                                    </div>
                                                <?php
                                                } else {
                                                ?>
                                                    <div class="alert alert-danger alert-dismissible">
                                                        Modül oluşturulurken bir hata oluştu.
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->