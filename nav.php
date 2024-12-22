<nav style="display: flex; justify-content: space-between;margin-top:10px ; padding:10px ; box-sizing:border-box">
<div class="logo">
    <p style="margin: 0px">ONLINE VOTING</p>
</div>
<div class="links">
    <?php 
    if(isset($_SESSION['loggedin'])){
        echo"
        <a href='logout.php' class='btn'>Logout</a>";
    }
    ?>
</div>
</nav>
