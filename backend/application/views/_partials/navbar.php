<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse">
                <ul class="nav">
                    <?php foreach ($this->menuitems as $menuitem): ?>
                        <li class="<?php echo ($menuitem['link'] == URL::getCurrentPath()) ? 'active' : ''; ?>"><a href="<?php echo URL::base_uri(); ?><?php echo $menuitem['link']; ?>"><?php echo $menuitem['description']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>