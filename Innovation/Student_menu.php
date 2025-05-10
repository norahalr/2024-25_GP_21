<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="u-menu u-menu-one-level u-menu-open-right u-offcanvas u-menu-1" data-responsive-from="MD">
  <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700; text-transform: uppercase;">
    <a class="u-button-style u-nav-link" href="#" style="padding: 0px; font-size: calc(1em + 0.5px);">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 302 302" class="u-svg-content">
        <rect y="36" width="302" height="30" fill="lightblue"></rect>
        <rect y="136" width="302" height="30" fill="lightblue"></rect>
        <rect y="236" width="302" height="30" fill="lightblue"></rect>
      </svg>
    </a>
  </div>

  <div class="u-custom-menu u-nav-container">
    <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
      <li class="u-nav-item">
        <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
          u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
          u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90 
          <?php echo $currentPage == 'StudentHomePage.php' ? 'u-nav-link-active' : ''; ?>" 
          href="StudentHomePage.php" style="padding: 10px 0px;">Student Home Page</a>
      </li>
      <li class="u-nav-item">
        <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
          u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
          u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90 
          <?php echo $currentPage == 'StudentProfile.php' ? 'u-nav-link-active' : ''; ?>" 
          href="StudentProfile.php" style="padding: 10px 0px;">Profile</a>
      </li>
      <li class="u-nav-item">
        <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
          u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
          u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90 
          <?php echo $currentPage == 'StudentRequest.php' ? 'u-nav-link-active' : ''; ?>" 
          href="StudentRequest.php" style="padding: 10px 0px;">Request List</a>
      </li>
      <li class="u-nav-item">
        <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
          u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
          u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" 
          href="Home.php" style="padding: 10px 0px;">Log out</a>
      </li>
    </ul>
  </div>

  <div class="u-custom-menu u-nav-container-collapse">
    <div class="u-container-style u-inner-container-layout u-opacity u-opacity-95 u-palette-1-dark-2 u-sidenav">
      <div class="u-inner-container-layout u-sidenav-overflow">
        <div class="u-menu-close"></div>
        <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
          <li class="u-nav-item"><a class="u-button-style u-nav-link" href="StudentHomePage.php">Student Home Page</a></li>
          <li class="u-nav-item"><a class="u-button-style u-nav-link" href="StudentProfile.php">Profile</a></li>
          <li class="u-nav-item"><a class="u-button-style u-nav-link" href="StudentRequest.php">Request List</a></li>
          <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.php">Log out</a></li>
        </ul>
      </div>
    </div>
    <div class="u-menu-overlay u-opacity u-opacity-70 u-palette-1-dark-2"></div>
  </div>

  <style class="menu-style">
    @media (max-width: 939px) {
      [data-responsive-from="MD"] .u-nav-container {
        display: none;
      }
      [data-responsive-from="MD"] .menu-collapse {
        display: block;
      }
    }
    .u-nav-link-active {
      border-bottom: 2px solid #1a73e8;
    }
  </style>
</nav>
