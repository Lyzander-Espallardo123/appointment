<?php

include ('header.php');

?>
<div id="homeSection">
    <div class="homeContainer">
    <h1>Welcome to our vibrant Online <br>Tutoring Community!</h1>
     <p>We're thrilled to have you here, ready to embark on a journey of knowledge and growth. 
     Whether you're here to sharpen your skills, conquer challenges, or simply explore new 
     horizons, you've come to the right place. Our dedicated team of expert tutors is here to 
     illuminate your learning path and make every session an enjoyable experience. Let the joy 
     of learning begin!</p>
    </div>
</div>
<div id="tutorsSection">
    <div class="tutorContainer">
    <h2>OUR TUTORS</h2>
            <div class="tutor-image">
            <img src="img/teacher1.png" alt="Image 1">
            <h3>Christine Joy Cepeda</h3>
            <p>Math Tutor</p>
            </div>
            <div class="tutor-image">
            <img src="img/teacher2.jpg" alt="Image 2">
            <h3>Yolly Mae Blanco</h3>
            <p>English Tutor</p>
            </div>
            <div class="tutor-image">
            <img src="img/teacher3.jpg" alt="Image 3">
            <h3>Elizabeth Juguan</h3>
            <p>Science Tutor</p>
            </div>
            <div class="tutor-image">
            <img src="img/teacher4.jpg" alt="Image 4">
            <h3>Cristina Moonton</h3>
            <p>Physical Education Coach</p>
            </div>
            
            <div class="tutor-controls">
                <div class="tutor-control" onclick="prevImage()">&#10094;</div>
                <div class="tutor-control" onclick="nextImage()">&#10095;</div>
            </div>
            <div class="dots">
                <div class="dot" onclick="selectDot(0)"></div>
                <div class="dot" onclick="selectDot(1)"></div>
                <div class="dot" onclick="selectDot(2)"></div>
                <div class="dot" onclick="selectDot(3)"></div>
            </div> 
    </div>
    
</div>
<div id="aboutSection">
    <div class="aboutContainer">
        <h1>ABOUT US</h1>
        <p>
    The story began with a team of passionate educators and tech enthusiasts, 
    united by the belief that education should be accessible, engaging, and personalized for every learner.
In the heart of our virtual realm, the founders embarked on a quest to bridge the gap between knowledge seekers
 and expert guides. With pixels as their canvas and algorithms as their compass, they crafted an online sanctuary
  where learners of all ages and backgrounds could thrive.
Picture a tapestry woven with tales of triumph, where students discovered the joy of understanding complex concepts,
 conquered academic challenges, and ignited a spark for lifelong learning. Our tutors, the unsung heroes of this digital 
 saga, brought their expertise to life through interactive sessions, fostering a dynamic exchange of ideas and insights.
As the platform blossomed, a diverse community of learners emerged, creating a vibrant tapestry of global connections. 
Students from different corners of the world joined hands in the pursuit of knowledge, breaking down geographical barriers 
and embracing the beauty of cultural diversity.
Our story is one of growth, adaptation, and continuous innovation. We evolved with the ever-changing landscape of education,
 incorporating cutting-edge technology to enhance the learning experience. From virtual whiteboards to real-time collaboration
  tools, our platform became a modern-day magic carpet, transporting learners to new realms of understanding.
But our tale doesn't end here; it's an ongoing narrative shaped by the dreams and aspirations of our users. As we invite you to
 be a part of our story, we hope to inspire and empower you on your educational journey. Together, let's turn the page and create 
 a future where learning knows no limits, a story of knowledge, connection, and endless possibilities. Welcome to our online tutoring adventure!
</p>    
</div>
   
</div>
<?php

include ('footer.php');

?>
<script>
    let currentImage = 0;
    
    function nextImage() {
    currentImage = (currentImage + 1) % 4;
    showImage(currentImage);
    }
    
    function prevImage() {
    currentImage = (currentImage - 1 + 4) % 4;
    showImage(currentImage);
    }
    
    function selectDot(dotIndex) {
    currentImage = dotIndex;
    showImage(currentImage);
    }
    
    function showImage(imageIndex) {
    let tutorImages = document.getElementsByClassName('tutor-image');
    for (let i = 0; i < tutorImages.length; i++) {
    tutorImages[i].style.display = 'none';
    }
    tutorImages[imageIndex].style.display = 'block';
    
    let Dots = document.getElementsByClassName('dot');
    for (let i = 0; i < Dots.length; i++) {
    Dots[i].classList.remove('active');
    }
    Dots[imageIndex].classList.add('active');
    }
    
    showImage(currentImage);
    </script>