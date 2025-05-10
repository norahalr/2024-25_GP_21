<?php
$currentPage = basename($_SERVER['PHP_SELF']);
// Check if any updates exist
$sql = "SELECT COUNT(*) FROM team_idea_request WHERE supervisor_email = :email AND is_updated = 1";
$stmt = $con->prepare($sql);
$stmt->bindParam(':email', $supervisorEmail);
$stmt->execute();
$hasUpdates = $stmt->fetchColumn() > 0;
$hasUpdates = $hasUpdates ?? false;

function isActive($page) {
  global $currentPage;
  return $currentPage === $page ? 'u-nav-link-active' : '';
}

$supervisorMenu = '
<li class="u-nav-item">
  <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
    u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
    u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90 ' . isActive('SupervisorHomePage.php') . '" 
    href="SupervisorHomePage.php" style="padding: 10px 0px;">
    Supervisor Home' . ($hasUpdates ? '<span style="background:red; border-radius:50%; width:10px; height:10px; display:inline-block; margin-left:5px;"></span>' : '') . '
  </a>
</li>
<li class="u-nav-item">
  <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
    u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
    u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90 ' . isActive('supervisorProfile.php') . '" 
    href="supervisorProfile.php" style="padding: 10px 0px;">
    Profile
  </a>
</li>
<li class="u-nav-item">
  <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
    u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
    u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90 ' . isActive('SupervisorGroup.php') . '" 
    href="SupervisorGroup.php" style="padding: 10px 0px;">
    Supervisor Group
  </a>
</li>
<li class="u-nav-item">
  <a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 
    u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link 
    u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" 
    href="Home.php" style="padding: 10px 0px;">
    Log out
  </a>
</li>';
?>

<nav class="u-menu u-menu-one-level u-menu-open-right u-offcanvas u-menu-1" data-responsive-from="MD">
  <div class="menu-collapse" style="font-size: 1rem; font-weight: 700; text-transform: uppercase;">
    <a class="u-button-style u-nav-link" href="#" style="padding: 0px;">
      <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302">
        <use xlink:href="#svg-5247"></use>
      </svg>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 302 302" class="u-svg-content" id="svg-5247">
        <g>
          <rect y="36" width="302" height="30" fill="lightblue"></rect>
          <rect y="136" width="302" height="30" fill="lightblue"></rect>
          <rect y="236" width="302" height="30" fill="lightblue"></rect>
        </g>
      </svg>
    </a>
  </div>

  <!-- Desktop Menu -->
  <div class="u-custom-menu u-nav-container">
    <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
      <?php echo $supervisorMenu; ?>
    </ul>
  </div>

  <!-- Mobile / Collapsed Menu -->
  <div class="u-custom-menu u-nav-container-collapse">
    <div class="u-container-style u-inner-container-layout u-opacity u-opacity-95 u-palette-1-dark-2 u-sidenav">
      <div class="u-inner-container-layout u-sidenav-overflow">
        <div class="u-menu-close"></div>
        <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2">
          <?php echo $supervisorMenu; ?>
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
      border-bottom: 2px solid #1a73e8; /* Light blue underline for active page */
    }
  </style>
</nav>
