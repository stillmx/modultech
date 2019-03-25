<?php
    //Lee todas las imagenes de la carpeta album/agencia
    $directory="images/blog";
    $dirint = dir($directory);
    $i=0;

    while (($archivo = $dirint->read()) !== false && (eregi("jpg", $archivo) || eregi("png", $archivo)))
    {

                if($i++ ==0) echo 'hola'. "\n";

              // echo $i.'<div class="item ">
              //   <a href="#"><img class="img-responsive" src="./'.$directory."/".$archivo.'" alt=""></a>
              // </div>'."\n";



    }
    $dirint->close();
?>

<?php
    //Lee todas las imagenes de la carpeta album/agencia
    $directory="images/blog";
    $dirint = dir($directory);
    $i=0;
    while (($archivo = $dirint->read()) !== false)
    {
        if (eregi("jpg", $archivo) || eregi("png", $archivo)){
            if($i==0){
              echo '<div class="item active">
                <a href="#"><img class="img-responsive" src="images/blog/'.$archivo.'" alt=""></a>
              </div>'."\n";
            }else{
              echo '<div class="item">
                <a href="#"><img class="img-responsive" src="images/blog/'.$archivo.'" alt=""></a>
              </div>'."\n";
            }

        }
    }
    $dirint->close();
?>
<section id="team">
  <div class="container">
    <div class="row">
      <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
        <h2>Productos</h2>
        </div>
        <div class="blog-posts">
        <div class="row">
        <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="post-thumb">
            <div id="post-carousel"  class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php
                    //Lee todas las imagenes de la carpeta album/agencia
                    $directory="images/blog";
                    $dirint = dir($directory);
                    $i=0;
                    while (($archivo = $dirint->read()) !== false)
                    {
                        if (eregi("jpg", $archivo) || eregi("png", $archivo)){
                            echo '<li type="1" data-target="#post-carousel" data-slide-to="'.$i++ .'"class="active"></li>'."\n";
                        }
                    }
                    $dirint->close();
                ?>
                <!-- <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#post-carousel" data-slide-to="1"></li>
                <li data-target="#post-carousel" data-slide-to="2"></li>
                <li data-target="#post-carousel" data-slide-to="3"></li> -->
              </ol>
              <div class="carousel-inner">
                <?php
                    //Lee todas las imagenes de la carpeta album/agencia
                    $directory="images/blog";
                    $dirint = dir($directory);
                    while (($archivo = $dirint->read()) !== false)
                    {
                        if (eregi("jpg", $archivo) || eregi("png", $archivo)){
                            echo '<div class="item">
                              <a href="#"><img class="img-responsive" src="images/blog/'.$archivo.'" alt=""></a>
                            </div>'."\n";
                        }
                    }
                    $dirint->close();
                ?>
                <!-- <div class="item active">
                  <a href="#"><img class="img-responsive" src="images/blog/2.jpg" alt=""></a>
                </div>
                <div class="item">
                  <a href="#"><img class="img-responsive" src="images/blog/1.jpg" alt=""></a>
                </div>
                <div class="item">
                  <a href="#"><img class="img-responsive" src="images/blog/3.jpg" alt=""></a>
                </div>
                <div class="item">
                  <a href="#"><img class="img-responsive" src="images/blog/4.jpg" alt=""></a>
                </div> -->
              </div>
              <a class="blog-left-control" href="#post-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
              <a class="blog-right-control" href="#post-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
            </div>
            <div class="post-meta">
              <span><i class="fa fa-comments-o"></i> 3 Comments</span>
              <span><i class="fa fa-heart"></i> 0 Likes</span>
            </div>
            <div class="post-icon">
              <i class="fa fa-picture-o"></i>
            </div>
          </div>
          <div class="entry-header">
            <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
            <span class="date">June 26, 2014</span>
            <span class="cetagory">in <strong>Photography</strong></span>
          </div>
          <div class="entry-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
          </div>
        </div>
      </div>
    </div>
        <!-- <video src="images/videos/modultech.mp4" autoplay width="500" loop preload="none" ></video> -->
      </div>
    </div>
  </div>

</section><!--/#team-->
