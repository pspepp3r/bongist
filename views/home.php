
<?php

$sliders = slider::all();
$count = count($sliders);

if ($sliders) {
//    request::pre($sliders);
    ?>
<!-- Hero Section-->
<section class="home-full-slider-wrapper">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 100%;">
        <ol class="carousel-indicators">
            <?php
            $sf = 0;
            foreach ($sliders as $slider) {
                ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $sf; ?>" class="<?php
            if ($sf == 0) {
                echo 'active';
                $sf++;
            }
            ?>"></li>
            <?php
            }
            ?>

        </ol>
        <div class="carousel-inner" role="listbox" style="height: 100%;">
            <?php
$sd = 0;
            foreach ($sliders as $slider) {
                ?>
                <div class="carousel-item <?php
                if ($sd == 0) {
                    echo 'active';
                    $sd++;
                }
                ?>" style="height: 100%;">
                    <div style="background: #f8d5cf; height: 100%;" class="item home-full-item"><img src="<?php echo config::baseUploadSliderUrl().$slider['image']; ?>" alt="" class="bg-image">
                        <div class="container-fluid h-100 py-5">
                            <div class="row align-items-center h-100">
                                <div class="col-lg-8 col-xl-6 mx-auto text-white text-center">
                                    <h1 class="mb-5 display-2 font-weight-bold text-serif"><?php echo $slider['title']; ?></h1>
                                    <p class="lead mb-4"><?php echo $slider['description']; ?></p>
                                    <?php
                                    if ($slider['link']) {
                                        ?>
                                        <p> <a href="<?php echo $slider['link']; ?>" target="_blank" class="btn btn-light">Shop Now</a></p>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<?php
}

?>
<section>
    <div class="container py-6">
        <div class="row">
            <div class="col-xl-8 mx-auto text-center mb-5">
                <h2 class="text-uppercase">Our picks for Winter 2018 </h2>
                <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="row align-items-md-stretch">
            <div class="col-lg-4 d-flex align-items-lg-stretch">
                <div style="background: center center url('https://d19m59y37dris4.cloudfront.net/sell/1-2-5/img/photo/rahul-anil-214671-unsplash.e675ae0f.jpg') no-repeat; background-size: cover;" class="d-flex align-items-center text-white border-0 w-100 py-6 py-lg-4 text-center mb-30px mb-lg-0"><a href="category.html" class="tile-link"> </a>
                    <div class="w-100">
                        <h1 class="text-uppercase">Men</h1>
                        <p class="lead">Consectetur adipisicing elit sed do eiusmod tempor.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card light-overlay text-dark border-0 mb-30px"><img src="https://d19m59y37dris4.cloudfront.net/sell/1-2-5/img/photo/pete-bellis-189599-unsplash.a0427960.jpg" alt="Card image" class="card-img"><a href="category.html" class="tile-link"> </a>
                    <div class="card-img-overlay d-flex align-items-center">
                        <div class="text-center w-100 overlay-content">
                            <h1 class="text-uppercase">Ladies</h1>
                            <p class="lead">Consectetur adipisicing elit sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card text-white border-0 mb-lg-0 mb-30px"><img src="https://d19m59y37dris4.cloudfront.net/sell/1-2-5/img/photo/haley-phelps-62815-unsplash.6aa3da96.jpg" alt="Card image" class="card-img"><a href="category.html" class="tile-link"> </a>
                            <div class="card-img-overlay d-flex align-items-center">
                                <div class="text-center w-100">
                                    <h2 class="text-uppercase mb-0">Denim</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card dark-overlay text-white border-0 mb-lg-0 mb-30px"><img src="https://d19m59y37dris4.cloudfront.net/sell/1-2-5/img/photo/matese-fields-233175-unsplash.1f338b35.jpg" alt="Card image" class="card-img"><a href="category.html" class="tile-link"> </a>
                            <div class="card-img-overlay d-flex align-items-center">
                                <div class="text-center w-100 overlay-content">
                                    <h4 class="text-uppercase mb-0">Accessories</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card text-white border-0"><img src="https://d19m59y37dris4.cloudfront.net/sell/1-2-5/img/photo/brooke-cagle-195856-unsplash.1bc85bd4.jpg" alt="Card image" class="card-img"><a href="category.html" class="tile-link"> </a>
                            <div class="card-img-overlay d-flex align-items-center">
                                <div class="text-center w-100">
                                    <h2 class="text-uppercase mb-0">Sales</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$products = product::view(4);

if ($products) {
    ?>
    <section class="py-6 bg-gray-100">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto text-center mb-5">
                    <h2 class="text-uppercase">Latest Products</h2>
                    <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
            <div class="row">
                <?php

                $products = product::view(8);

                if ($products) {
                    ?>

                    <?php

                    foreach ($products as $product) {
                        product::display($product, true);
                    }

                }

                ?>
            </div>
        </div>
    </section>
    <?php



}

?>

<section class="py-6 position-relative light-overlay"><img src="https://d19m59y37dris4.cloudfront.net/sell/1-2-5/img/photo/benjamin-voros-260869-unsplash.b4e74271.jpg" alt="" class="bg-image">
    <div class="container">
        <div class="overlay-content text-center text-dark">
            <p class="text-uppercase font-weight-bold mb-1 letter-spacing-5">Old Collection                  </p>
            <h3 class="display-1 font-weight-bold text-serif mb-4">Summer Sales</h3><a href="category.html" class="btn btn-dark">Shop Now</a>
        </div>
    </div>
</section>