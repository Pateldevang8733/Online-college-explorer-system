<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include("links.php");?>
   
</head>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderWrapper = document.querySelector('.slider-wrapper');
            const slides = document.querySelectorAll('.slide');
            const totalSlides = slides.length;
            let index = 0;

            document.querySelector('.slider-nav.next').addEventListener('click', function() {
                if (index < totalSlides - 1) {
                    index++;
                } else {
                    index = 0; 
                }
                updateSlider();
            });

            document.querySelector('.slider-nav.prev').addEventListener('click', function() {
                if (index > 0) {
                    index--;
                } else {
                    index = totalSlides - 1; 
                }
                updateSlider();
            });

            function updateSlider() {
                const offset = -index * 100; 
                sliderWrapper.style.transform = `translateX(${offset}%)`;
            }
        });
    </script>
<body>
<div class="middelmenu">
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="slide">
                    <img src="./image/1.jpg.jpg" alt="Slide 1" />
                </div>
                <div class="slide">
                    <img src="./image/4.jpg" alt="Slide 2" />
                </div>
                <div class="slide">
                    <img src="./image/3.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/2.jpg.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/3.jpg.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/parul.jpg" alt="Slide 3" />
                </div>

                <div class="slide">
                    <img src="./image/best.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/best2.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/iim3.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/new1.jpg" alt="Slide 3" />
                </div>
                <div class="slide">
                    <img src="./image/3.jpg.jpg" alt="Slide 3" />
                </div>
             
            </div>
             Navigation buttons 
             <button class="slider-nav prev">&#10094;</button>
            <button class="slider-nav next">&#10095;</button> 
        </div> 
    </div> 
     <!-- <div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./image/1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img src="./image/4.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img src="./image/3.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>  -->

    <div class="endmenu">
        <text id="t">
    <P><span style="color: rgb(255, 0, 0);font-weight: bold;">100+ Colleges</span> Here , Find Your Best College<br>Login For More</P></text>
    <a href="login.php"> <button type="button" class="btn btn-outline-success">Login </button></a>




    </div>
    <div class="endmenu2">
        <h1><span style="color: rgb(247, 200, 112);">Top Colleges For You</h1></span>
            <div class="container">
                <img src="./image/1.jpg">
                <img src="./image/4.jpg">
                <img src="./image/5.jpg">
                <img src="./image/3.jpg">
                <img src="./image/6.jpg">

            </div>
    </div>

</body>
</html>