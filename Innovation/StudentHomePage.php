<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'InnovationEngine';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch distinct fields for field filter dropdown
    $fieldStmt = $con->prepare("SELECT DISTINCT field FROM past_projects");
    $fieldStmt->execute();
    $fields = $fieldStmt->fetchAll(PDO::FETCH_COLUMN);

    // Fetch distinct technologies for technology filter dropdown
    $techStmt = $con->prepare("SELECT DISTINCT name FROM technologies");
    $techStmt->execute();
    $technologies = $techStmt->fetchAll(PDO::FETCH_COLUMN);

    // Fetch initial list of supervisors
    $supervisorStmt = $con->prepare("SELECT name, email, interest, availability FROM supervisors");
    $supervisorStmt->execute();
    $supervisors = $supervisorStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error executing queries: " . $e->getMessage());
}
if (isset($_SESSION['message'])) {
    echo "<div class='message'>{$_SESSION['message']}</div>";
    unset($_SESSION['message']);  // Clear the message after displaying
}
?>


<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>StudentHomePage</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="StudentHomePage.css" media="screen">
    <script src="jquery.js" defer=""></script>
    <script src="nicepage.js" defer=""></script>
</head>
<body class="u-body u-xl-mode">

<header class="u-clearfix u-header" id="sec-4e01"><div class="u-clearfix u-sheet u-sheet-1">
      <nav class="u-menu u-menu-one-level u-menu-open-right u-offcanvas u-menu-1" data-responsive-from="MD">
        <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px; font-weight: 700; text-transform: uppercase;">
          <a class="u-button-style u-custom-active-border-color u-custom-active-color u-custom-border u-custom-border-color u-custom-borders u-custom-hover-border-color u-custom-hover-color u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link" href="#" style="padding: 0px; font-size: calc(1em + 0.5px);">
            <svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 302 302"><use xlink:href="#svg-5247"></use></svg>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="svg-5247" x="0px" y="0px" viewBox="0 0 302 302" style="enable-background:new 0 0 302 302;" xml:space="preserve" class="u-svg-content"><g><rect y="36" width="302" height="30"></rect><rect y="236" width="302" height="30"></rect><rect y="136" width="302" height="30"></rect>
  </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
          </a>
        </div>
        <div class="u-custom-menu u-nav-container">
          <ul class="u-nav u-spacing-30 u-unstyled u-nav-1">
            <!-- <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" href="StudentHomePage.html" style="padding: 10px 0px;">Student Home page</a>
  </li> -->
  
  <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="StudentProfile.php">Profile</a>
  </li>
  
  <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="StudentRequest.php">Request list</a>
  
  </li>
  
  <li class="u-nav-item"><a class="u-border-2 u-border-active-palette-1-base u-border-hover-palette-1-light-1 u-border-no-left u-border-no-right u-border-no-top u-button-style u-nav-link u-text-active-grey-90 u-text-grey-90 u-text-hover-grey-90" style="padding: 10px 0px;" href="index.php">Log out</a>
  </li></ul>
        </div>
      </nav>
      <a href="#" class="u-image u-logo u-image-1" data-image-width="276" data-image-height="194">
        <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
      </a>
    </div></header>

<section class="u-clearfix u-section-1" id="sec-9f4c" style="padding-bottom:20px;">
    <div class="u-clearfix u-sheet u-sheet-1">
        <div class="custom-expanded u-form u-form-1">
            <form id="searchForm" class="u-clearfix u-form-horizontal u-inner-form" style="padding: 10px;">
                <div class="u-form-group u-form-select u-label-none u-form-group-1">
                    <label for="select-7000" class="u-label">Search by</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-7000" name="search_category" class="u-input u-input-rectangle" onchange="updateSearchField()" style="width:400px;">
                            <option value="SupervisorName">Supervisor Name</option>
                            <option value="Track">Supervisor Track</option>
                            <option value="ProjectName">Project Name</option>
                        </select>
                    </div>
                </div>
                <div class="u-form-group u-form-select u-label-none u-form-group-2" id="trackDropdown" style="display: none;">
                    <label for="select-90a6" class="u-label">Track</label>
                    <div class="u-form-select-wrapper">
                        <select id="select-90a6" name="track" class="u-input u-input-rectangle">
                            <option value="Artificial Intelligence">AI</option>
                            <option value="Cybersecurity">Security</option>
                            <option value="Internet of Things">IoT</option>
                        </select>
                    </div>
                </div>
                
                <div class="u-form-group u-label-none u-form-group-3" id="textField">
                    <label for="text-5fe6" class="u-label">-</label>
                    <input type="text" placeholder="Search" id="text-5fe6" name="query" class="u-input u-input-rectangle" style=" width:300px;">
                </div>

                <div class="u-align-left u-form-group u-form-submit u-label-none">
                    <button type="button" class="u-btn u-btn-submit u-button-style u-btn-1" onclick="performSearch()">Search</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Filter Bar -->
<div style="background-color: #e7f1fa; width: 100vw; height: 70px; display: flex; justify-content: right;">
    <div class="custom-expanded u-form u-form-1" id="filterBar" style="display: none; margin-top: 20px; width: 670px; float: right; margin: 20px 20px 20px 0px;">
        <form id="filterForm" class="u-clearfix u-form-horizontal u-inner-form" style="display: flex; align-items: center;">
            <div class="u-form-group u-form-select u-label-none u-form-group-1" style="flex: 1;">
                <label for="fieldFilter" class="u-label">Filter by Field</label>
                <div class="u-form-select-wrapper">
                    <select id="fieldFilter" name="field" class="u-input u-input-rectangle" style="width: 100%;">
                        <option value="">Select Field</option>
                        <?php foreach ($fields as $field): ?>
                            <option value="<?= htmlspecialchars($field) ?>"><?= htmlspecialchars($field) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="u-form-group u-form-select u-label-none u-form-group-2" style="flex: 1;">
                <label for="technologyFilter" class="u-label">Filter by Technology</label>
                <div class="u-form-select-wrapper">
                    <select id="technologyFilter" name="technology" class="u-input u-input-rectangle" style="width: 100%;">
                        <option value="">Select Technology</option>
                        <?php foreach ($technologies as $technology): ?>
                            <option value="<?= htmlspecialchars($technology) ?>"><?= htmlspecialchars($technology) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="u-align-left u-form-group u-form-submit u-label-none">
                <button type="button" class="u-btn u-btn-submit u-button-style u-btn-1" onclick="performFilter()">Filter</button>
            </div>
        </form>
    </div>
</div>

<section id="initialSupervisors" class="u-align-center u-clearfix u-container-align-center u-gradient u-section-2" style="background-color: #e9f2fa; width: 100vw;">
    <!-- Supervisor display code here -->
    <div class="u-clearfix u-sheet u-sheet-1" style="max-width: 1600px; margin: 0 auto;">
        <h2 class="u-align-center u-text u-text-default u-text-palette-1-dark-1 u-text-1" style="margin:10px 20px 20px 20px;">Welcome...</h2>
        <div class="u-expanded-width u-layout-grid u-list u-list-1">
            <div class="u-repeater u-repeater-1">
                <?php foreach ($supervisors as $supervisor): ?>
                    <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
                         style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); margin-bottom: 20px;">
                        <div class="u-container-layout u-similar-container u-container-layout-1">
                            <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2"><?= htmlspecialchars($supervisor['name']) ?></h5>
                            <div class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-2" style="margin-bottom: 35px;"></div>
                            <a href="ViewSupervisor.php?supervisor_email=<?= urlencode($supervisor['email']) ?>" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">View</a>
                            <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3"><?= htmlspecialchars($supervisor['email']) ?></h6>
                            <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-4">Interest:</h6>
                            <ul class="u-align-left u-text u-text-5">
                                <?php foreach (explode(',', $supervisor['interest']) as $interest): ?>
                                    <li><?= htmlspecialchars(trim($interest)) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-6" 
                                style="color: <?= $supervisor['availability'] === 'Unavailable' ? 'red' : '#5cb85c'; ?>; display: inline;">
                                <?= htmlspecialchars($supervisor['availability']) ?>
                                <span class="u-file-icon u-icon u-icon-1" style="display: inline; vertical-align: middle; margin-left: 5px; margin-bottom: 10px;">
                                    <img src="images/<?= $supervisor['availability'] === 'Unavailable' ? 'Incorrect.png' : '3699459-d2dcaf9f.png'; ?>" alt="Availability Icon" style="width: 16px; height: 16px; vertical-align: middle; ">
                                </span>
                            </h6>
                            <a href="RequestSupervisor.php?supervisor_email=<?= urlencode($supervisor['email']) ?>" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">REQUEST</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<div id="searchResults"></div>

<script>
let lastSearchData = null; // Stores search results for filtering
let isSearchPerformed = false; // Tracks if a search has been executed



// Update search field visibility based on the selected category
function updateSearchField() {
    const searchCategory = document.getElementById("select-7000").value;
    const trackDropdown = document.getElementById("trackDropdown");
    const textField = document.getElementById("textField");
    const filterBar = document.getElementById("filterBar");

    // Reset visibility of fields
    trackDropdown.style.display = "none";
    textField.style.display = "none";
    filterBar.style.display = "none";

    if (searchCategory === "SupervisorName") {
        textField.style.display = "block"; // Show text input for Supervisor Name
    } else if (searchCategory === "Track") {
        trackDropdown.style.display = "block"; // Show dropdown for Track
    } else if (searchCategory === "ProjectName") {
        textField.style.display = "block"; // Show text input for Project Name
        filterBar.style.display = "flex"; // Show additional filters for Project Name
        loadInitialProjects(); // Ensure initial projects load when Project Name is selected
    }
}


function performSearch() {
    const searchCategory = document.getElementById("select-7000").value;
    const query = document.getElementById("text-5fe6").value.trim(); // Ensure no whitespace issues
    const track = document.getElementById("select-90a6").value; // Track dropdown

    // Basic validation
    if ((searchCategory === "ProjectName" || searchCategory === "SupervisorName") && !query) {
        alert("Please enter a search query!");
        return;
    }

    const formData = new FormData();
    formData.append("search_category", searchCategory);

    if ((searchCategory === "SupervisorName" || searchCategory === "ProjectName") && query) {
        formData.append("query", query);
    } else if (searchCategory === "Track" && track) {
        formData.append("track", track);
    }

    fetch("search.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            displayResults(data); // Display results
            lastSearchData = data; // Cache results for filters
            isSearchPerformed = true; // Mark search as performed
            document.getElementById("initialSupervisors").style.display = "none"; // Hide initial supervisors
        })
        .catch((error) => console.error("Error:", error));
}






// Function to load initial projects when needed
function loadInitialProjects() {
    fetch("search.php", {
        method: "POST",
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: "initial_projects=true"
    })
    .then(response => response.json())
    .then(data => {
        displayResults(data);
        lastSearchData = data; // Store initial projects
        isSearchPerformed = false; // No search performed
        document.getElementById("initialSupervisors").style.display = "none"; // Hide supervisor list
    })
    .catch(error => console.error("Error fetching initial projects:", error));
}





// Filter function that applies filters to the correct data
function performFilter() {
    const field = document.getElementById("fieldFilter").value;
    const technology = document.getElementById("technologyFilter").value;

    const dataToFilter = isSearchPerformed ? lastSearchData : null;

    if (dataToFilter) {
        // Apply filter on search results if a search was performed
        const filteredResults = dataToFilter.filter(item =>
            (!field || item.field === field) &&
            (!technology || item.technologies && item.technologies.includes(technology))
        );
        displayResults(filteredResults);
    } else {
        // If no search was performed, request the filtered initial project list from the server
        const formData = new FormData();
        if (field) formData.append("field", field);
        if (technology) formData.append("technology", technology);

        fetch("search.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => displayResults(data))
        .catch(error => console.error("Error:", error));
    }
}






function displayResults(data) {
    const resultsDiv = document.getElementById("searchResults");
    const title = document.querySelector("h2.u-text-1"); // Select the "Search Results" title element

    // Check if data is an array
    if (!Array.isArray(data)) {
        console.error("Invalid data format received:", data);
        title.style.display = "none"; // Hide the title in case of an error
        resultsDiv.innerHTML = "<p style='background-color: #E7F1FA; padding: 20px; text-align: center;'>Unexpected error occurred. Please try again.</p>";
        return;
    }

    if (data.length === 0) {
        // No results found
        title.style.display = "none"; // Hide the title
        resultsDiv.innerHTML ="<h4 style='background-color: #E7F1FA; color: #4D7397; margin: -10px; padding: 40px 0px 500px 0px; text-align: center;'>No results found.</>";
        return;
    }

    title.style.display = "block"; // Show the title if there are results

    const minItems = 6; // Set the minimum number of items to display

    // Add filler items if the data count is less than the minimum required
    while (data.length < minItems) {
        data.push({ filler: true }); // Add filler items
    }

    resultsDiv.innerHTML = `
        <section class="u-align-center u-clearfix u-container-align-center u-gradient u-section-2 u-body u-xl-mode" 
            style="background-image: linear-gradient(#e9f2fa, #adcce9); width: 100vw; padding: 30px 0; box-sizing: border-box; margin-left: calc(-50vw + 50%);">
                
                <div class="u-clearfix u-sheet u-sheet-1" style="max-width: 1200px; margin: 0 auto; padding: 30px;">
                    <h2 class="u-align-center u-text u-text-default u-text-palette-1-dark-1 u-text-1">Search Results</h2>
                    
                    <div class="u-expanded-width u-layout-grid u-list u-list-1">
                        <div class="u-repeater u-repeater-1">
                            ${data.map(item => item.filler ? `
                                <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
                                    style="background-color: transparent; box-shadow: none; margin-bottom: 20px;">
                                </div>` : item.hasOwnProperty('description') ? `
                                <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
                                    style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); margin-bottom: 20px;">
                                    
                                    <div class="u-container-layout u-similar-container u-container-layout-1">
                                        <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2" style="margin:10px 200px 10px 100px ;">${item.name}</h5>
                                        <p style="margin-bottom:100px; font-size: 16px; line-height: 1.6; text-align: left; padding-right: 20px;">${item.description}</p>
                                        
                                        <a href="documents/${item.document}" target="_blank" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1" style=" margin:50px 200px 50px 450px" >View</a>
                                    </div>
                                </div>` : `
                                <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
                                    style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); margin-bottom: 20px;">
                                    
                                    <div class="u-container-layout u-similar-container u-container-layout-1">
                                        <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2">${item.name}</h5>
                                         <div class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-2" data-image-width="309" data-image-height="309" style="margin-bottom: 35px"></div>
                                       
                                       <a href="ViewSupervisor.php?email=${encodeURIComponent(item.email)}" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">View</a>
                                       <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3">${item.email}</h6>

                                        <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-4">Interest:</h6>
                                        
                                        <ul class="u-align-left u-text u-text-5">
                                            ${item.interest.split(',').map(interest => `<li>${interest.trim()}</li>`).join('')}
                                        </ul>

                                        <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-6" style="color: ${item.availability === 'Unavailable' ? 'red' : '#5cb85c'}; display: inline;">
                                            ${item.availability}
                                            <span class="u-file-icon u-icon u-icon-1" style="display: inline; vertical-align: middle; margin-left: 5px; margin-bottom: 10px;">
                                                <img src="images/${item.availability === 'Unavailable' ? 'Incorrect.png' : '3699459-d2dcaf9f.png'}" alt="Availability Icon" style="width: 16px; height: 16px; vertical-align: middle; margin-bottom: 10px;">
                                            </span>
                                        </h6>
                                        
                                        <a href="RequestSupervisor.php?email=${encodeURIComponent(item.email)}" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">REQUEST</a>
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            </section>`;
}



</script>

<footer class="u-clearfix u-custom-color-3 u-footer" id="sec-9e3e">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
        <div class="data-layout-selected u-clearfix u-expanded-width u-gutter-30 u-layout-wrap u-layout-wrap-1">
            <div class="u-gutter-0 u-layout">
                <div class="u-layout-row">
                    <div class="u-align-left u-container-style u-layout-cell u-left-cell u-size-60 u-layout-cell-1">
                        <div class="u-container-layout u-container-layout-1">
                            <h5 class="u-align-center u-text u-text-default u-text-1">Thank you for visiting our website!<br>If you have any suggestions, please do not hesitate to contact us
                            </h5>
                            <div class="u-social-icons u-spacing-10 u-social-icons-1">
                                <a class="u-social-url" title="Email" target="_blank" href="#">
                                    <span class="u-file-icon u-icon u-social-facebook u-social-icon u-icon-1"><img src="images/542740.png" alt=""></span>
                                </a>
                                <a class="u-social-url" title="Department website" target="_blank" href="https://ccis.ksu.edu.sa/ar">
                                    <span class="u-file-icon u-icon u-social-icon u-social-linkedin u-icon-2"><img src="images/3308395.png" alt=""></span>
                                </a>
                                <a class="u-social-url" title="Twitter" target="_blank" href="https://x.com/fccis_ksu?s=11&amp;t=U-hrOO7JjdBm0Zm8XnUG6A">
                                    <span class="u-file-icon u-icon u-social-icon u-social-twitter u-icon-3"><img src="images/11823292.png" alt=""></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>