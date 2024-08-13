<?= $this->extend('Views/Dashboard/plantillaCoordinador'); ?>
<?= $this->section('contenido'); ?>
<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Coordinador</h4>
    <!-- Bootstrap carousel -->
    <div class="col-md">
                <div id="carouselExample" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExample" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExample" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center">
                                <img class="d-block img-fluid" src="<?= base_url('/assets/img/favicon/img_2.jpg'); ?>" alt="First slide" />
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <img class="d-block img-fluid" src="<?= base_url('/assets/img/favicon/img_3.jpg'); ?>" alt="Second slide" />
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <img class="d-block img-fluid" src="<?= base_url('/assets/img/favicon/img_1.jpg'); ?>" alt="Third slide" />
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>
        </div>
</div>
<!-- / Content -->
<?= $this->endSection(); ?>