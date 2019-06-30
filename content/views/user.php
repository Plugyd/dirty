<?
    use React\Core\Store;  
    use React\Core\User;  

?>
<section class="section section-140" id="">

    <section class="section section-100" id="">
        <section class="section section-20" id="">
            <div class="container-10">
                <div class="row row-50 ">
                    <div class="title"><?=$_SESSION['user']['name'] . " " ?><?=$_SESSION['user']['surname']?></div>
                </div>
            </div>
        </section>
        <section class="section section-20" id="">
            <div class="container-10">
                <div class="row row-50 ">
                    <div class="user-infos">
                        <div class="l0">
                            <div class="l1">Логин: </div>
                            <div class="l2"><?=$_SESSION['user']['login']?></div>
                        </div>
                        <div class="l0">
                            <div class="l1">Электронная почта: </div>
                            <div class="l2"><?=$_SESSION['user']['email']?></div>
                        </div>
                        <div class="l0">
                            <div class="l1">Ф.И.О: </div>
                            <div class="l2"><?=$_SESSION['user']['name'] . " " ?><?=$_SESSION['user']['surname']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </section>


    <section class="section section-120" id="">
        <div class="row row-150 ">
            <div class="avatar">
                <img src="<?=$_SESSION['user']['img']?>" alt="">
                <div class="but-c ">
                    <div class="spec">Обновить фото</div>
                    <? if ($_SESSION['user']['mode'] == 69) : ?>
                    <div class="spec">Загрузить контент</div>
                        <? endif ;?>
                    


                </div>
            </div>

        </div>
    </section>
</section>