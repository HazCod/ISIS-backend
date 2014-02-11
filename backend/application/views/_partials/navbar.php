    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand">ISIS</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
          <? foreach ($this->menuitems as $menuitem): ?>
            <li class="<?= ($menuitem['link'] == URL::getCurrentPath()) ? 'active' : ''; ?>">
              <a href="<?= URL::base_uri(); ?><?= $menuitem['link']; ?>"><?= $menuitem['description']; ?></a>
            </li>
          <? endforeach; ?>
          </ul>
          <? if (isset($_SESSION['user'])): ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= URL::base_uri(); ?>home/logout">Logout</a></li>
          </ul>
          <? endif; ?>
        </div>
      </div>
    </div>
