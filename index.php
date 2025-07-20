<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/about.css">
    <link rel="stylesheet" href="assets/css/project.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body class="home-body">

  <?php include "components/header.html"; ?>

  <main>
    <?php include "components/home.html"; ?>
    <?php include "components/about.html"; ?>
    <?php include "components/project.html"; ?>
    <?php include "components/contact.html"; ?>
  </main>

  <?php include "components/footer.html"; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Scroll animation function
      const animateOnScroll = () => {
        const elements = document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right, .scale-in');
        
        elements.forEach(element => {
          const elementPosition = element.getBoundingClientRect().top;
          const windowHeight = window.innerHeight;
          
          // If element is in viewport
          if (elementPosition < windowHeight - 100) {
            element.classList.add('active');
          }
        });
      };
      
      // Run once on load
      setTimeout(animateOnScroll, 100);
      
      // Add scroll event listener
      window.addEventListener('scroll', animateOnScroll);
    });
  </script>
</body>
</html> 