  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
      <a title="<?php echo APP_DESC; ?>" class="navbar-brand js-scroll-trigger" href="javascript:void(0);" onclick="page('nest', 'index', 'open', 'about', 'close', 'welcome')"><?php echo APP_NAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="javascript:void(0);" onclick="page('about')">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="javascript:void(0);" onclick="page('features')">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger"href="javascript:void(0);" onclick="page('documentation')">Documentation</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>