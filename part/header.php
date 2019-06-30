<?
    use React\Core\Store;  
    use React\Core\User;  

    //todo !!!
    Store::Prepare('SELECT name,id FROM category ');
    Store::Execute();
    $data = Store::FetchAll();
?>
<header>
    <div class="porn-navbar-main-outer">
        <div class="porn-navbar-main">
            <div class="porn-navbar-panel">
                <div class="porn-navbar-icon-outer">
                    <a class="porn-navbar-icon" href="/">DIRTY<span>Storage</span></a>
                </div>
            </div>
            <div class="porn-navbar-main-element">
                <div class="porn-navbar-nav-wrap">
                    <ul class="porn-navbar-nav">
                        <li class="porn-nav-item active">
                            <a class="porn-nav-link" href="/">Видео</a>
                            <ul class="porn-header__submenu-sub">
                            <? foreach ($data as $category) :?>
                             <li><a class="porn-nav-link-sub" href="/videos/<?=$category['id']?>"><?=$category['name']?></a></li>
                            <? endforeach;?>
                            </ul>
                        </li>


                        <li class="porn-nav-item"><a class="porn-nav-link" href="/photos">Фотографии</a></li>
                        <li class="porn-nav-item"><a class="porn-nav-link" href="/memes">Мемы</a></li>
                        <li class="porn-nav-item"><a class="porn-nav-link" href="/stories">Истории</a></li>
                        <li class="porn-nav-item"><a class="porn-nav-link" href="/comics">Комиксы</a></li>
                        <? if (User::Check() == false) : ?>
                        <div class="porn-user-header">

                            <a href="/auth" class="porn-logout-bt">Войти</a>
                            <a href="/reg" class="porn-logout-bt">Регистрация</a>
                        </div>
                        <? else :?>
                        <div class="porn-user-header">
                        <a href="/user/<?=$_SESSION['user']['id']?>">
                            <div class="porn-user-header-img"><img src="<?=$_SESSION['user']['img']?>" alt=""></div>
                            <div class="porn-user-header-login">
                                <div class="login"><?=$_SESSION['user']['login']?></div>
                            </div>
                            </a>
                            <a href="/logout" class="porn-logout-bt">Выйти</a>
                        </div>
                        <? endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</header>