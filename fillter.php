<?php
include_once 'admin/db.php';
?>
<head>
<link rel="stylesheet" type="text/css" href="/CSSPage/fillter.css">
</head>
<body>
    <button id="fillter"> Lọc phim </button>
    <div class="form_fillter">
        
    </div>
    <script>
        let fillter = document.querySelector('#fillter');
        let form_fillter = document.querySelectorAll('.from_fillter');
        fillter.onclick = function(){
            form_fillter.classList.toggle('active');
        }
    </script>
</body>