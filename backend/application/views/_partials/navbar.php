<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a class="brand" href="<?php echo URL::base_uri()?>">KHLeuven inzagerecht</a> </li>
                <?php foreach ($this->menuitems as $menuitem): ?>
                    <li class="<?php echo ($menuitem['link'] == URL::getCurrentPath()) ? 'active' : ''; ?>"><a href="<?php echo URL::base_uri(); ?><?php echo $menuitem['link']; ?>"><?php echo $menuitem['description']; ?></a></li>
                <?php endforeach; ?>
                </ul>
                <a class="btn btn-primary btn-small pull-right" href="<?php echo URL::base_uri()?>login/loguit">log uit</a>
                <?php if (isset($_SESSION['vorigerol'])&&($_SESSION['vorigerol']=="studieadviseur")&&(isset ($_SESSION['vorigelogin']))) :?>
                    <a class="btn btn-small btn-success pull-right ruimterechts" href="<?php echo URL::base_uri()?>login/vorigerol">studieadviseur</a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>