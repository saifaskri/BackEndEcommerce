<?php
if(isset($_SESSION["username"])){
echo'
</div>
<footer>
        <div class="container myVcenter text-center">
            <div class="foter-img-cont">
                Logo
            </div>    
            <h4>Find Us In Social Media</h4>
            <ul class=" myHcenter social-media-icons">
            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
            <li><a href=""><i class="fab fa-twitter"></i></a></li>
            <li><a href=""><i class="fas fa-home"></i></a></li>
            <li><a href=""><i class="fab fa-linkedin"></i></a></li> 
            </ul>
            <p class="copyright">&copy  <span class="year"> <?php echo date("Y"); ?> Company </span> <span class="name">  Askri Halava </span> All Rigth Reserved</p>
        </div>
</footer>';
}
?>
<script src="<?php echo $js_path?>all.min.js"></script>
<script src="<?php echo $js_path?>bootstrap.min.js"></script>
<script src="<?php echo $js_path?>main.js"></script>
</body>
</html>


