<?php
ob_start();
session_start();

require_once 'config/connect.php';

// Check if the session has a user ID; otherwise, redirect to login
if (!isset($_SESSION['user_id'])) {
  echo "Error: User is not logged in.";
  header("Location: LogIn.php");
  exit();
}

$userEmail = $_SESSION['user_id'] ; // Get user ID from session
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role']; // Retrieve the role from the cookie
    if ($role == 'leader') {
        //echo "User is a leader.";
        $welcomeMessage = "Welcome, Leader!";
    } elseif ($role == 'member') {
       // echo "User is a member.";
        $welcomeMessage = "Welcome, Member!";
    } else {
        echo "Role is not defined.";
    }
} else {
    echo "Role cookie not set.";
}

$stmt = $con->prepare("SELECT supervisor_email FROM teams WHERE leader_email = :email");
$stmt->bindParam(':email', $userEmail);
$stmt->execute();
$teamData = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_SESSION['message'])) {
    $message = htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8');
    echo "
    <div id='popup' style='
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        z-index: 1000;
        text-align: center;
    '>
        <p>$message</p>
        <button id='confirmButton' style='
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        '>OK</button>
    </div>
    <div id='overlay' style='
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    '></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('confirmButton').addEventListener('click', function() {
                document.getElementById('popup').style.display = 'none';
                document.getElementById('overlay').style.display = 'none';
            });
        });
    </script>
    ";
    unset($_SESSION['message']);
}

try {

    $fieldStmt = $con->prepare("SELECT DISTINCT field FROM past_projects");
    $fieldStmt->execute();
    $fields = $fieldStmt->fetchAll(PDO::FETCH_COLUMN);

    $techStmt = $con->prepare("SELECT DISTINCT name FROM technologies");
    $techStmt->execute();
    $technologies = $techStmt->fetchAll(PDO::FETCH_COLUMN);

    $supervisorStmt = $con->prepare("SELECT name, email, interest, availability FROM supervisors");
    $supervisorStmt->execute();
    $supervisors = $supervisorStmt->fetchAll(PDO::FETCH_ASSOC);

    $projectsStmt = $con->prepare("SELECT id, name, description, document FROM past_projects");
    $projectsStmt->execute();
    $projects = $projectsStmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($projects)) {
        throw new Exception("No projects found in the database. Please check the `past_projects` table.");
    }

} catch (PDOException $e) {
    die("Database error: " . htmlspecialchars($e->getMessage()));
} catch (Exception $e) {
    die("Application error: " . htmlspecialchars($e->getMessage()));
}


$userEmail = $_SESSION['user_id'];  
$apiUrl = 'https://app8800.pythonanywhere.com/recommend?student_id=' . urlencode($userEmail);

$response = @file_get_contents($apiUrl); 
if ($response === FALSE) {
    echo "Error: Unable to reach the recommendation service.";
    $recommendedSupervisors = []; 
} else {
    $data = json_decode($response, true);
    $recommendedSupervisors = isset($data['recommended_supervisors']) ? $data['recommended_supervisors'] : [];
}


$recommendedEmails = array_column($recommendedSupervisors, 'email');

$otherSupervisors = array_filter($supervisors, function($supervisor) use ($recommendedEmails) {
    return !in_array($supervisor['email'], $recommendedEmails);
});
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
<?php include "Student_menu.php";?>
      <a href="#" class="u-image u-logo u-image-1">
        <img src="images/logo_GP-noname.png" class="u-logo-image u-logo-image-1">
      </a>
    </div></header>
    <!-- 📦 InnoBot Chat UI -->
<!-- Chat Button -->
<div id="chat-toggle">
    💬
</div>

<!-- Chat Popup -->
<div id="chat-popup" style="display: none;">
    <div id="chat-header">
        <span>InnoBot</span>
        <button id="chat-close">&times;</button>
    </div>
    <div id="chat-output"></div>
    <div id="chat-controls">
        <input type="text" id="chat-input" placeholder="Ask me something...">
        <button id="chat-submit">Send</button>
    </div>
</div>

<style>
    /* Chat Toggle Button */
    #chat-toggle {
        position: fixed;
        bottom: 25px;
        right: 25px;
        width: 60px;
        height: 60px;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        z-index: 999;
        transition: background-color 0.3s;
    }

    #chat-toggle:hover {
        background-color: #0056b3;
    }

    /* Chat Popup */
    #chat-popup {
        position: fixed;
        bottom: 100px;
        right: 25px;
        width: 350px;
        max-height: 500px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        font-family: Arial, sans-serif;
        z-index: 1000;
        overflow: hidden;
    }

    #chat-header {
        background-color: #007bff;
        color: white;
        padding: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
    }

    #chat-close {
        background: transparent;
        border: none;
        font-size: 18px;
        color: white;
        cursor: pointer;
    }

    #chat-output {
        flex: 1;
        padding: 12px;
        overflow-y: auto;
        background: #f9f9f9;
    }

    #chat-controls {
        display: flex;
        padding: 10px;
        gap: 8px;
        border-top: 1px solid #eee;
        background: #fff;
    }

    #chat-input {
        flex: 1;
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    #chat-submit {
        padding: 8px 14px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    #chat-submit:hover {
        background-color: #0056b3;
    }

    p {
        margin: 6px 0;
    }

    .bot-loading {
        color: gray;
        font-style: italic;
    }
</style>

<script>
    // Handle toggle and close
    const chatToggle = document.getElementById('chat-toggle');
    const chatPopup = document.getElementById('chat-popup');
    const chatClose = document.getElementById('chat-close');

    chatToggle.addEventListener('click', () => {
        chatPopup.style.display = 'flex';
        chatToggle.style.display = 'none';
    });

    chatClose.addEventListener('click', () => {
        chatPopup.style.display = 'none';
        chatToggle.style.display = 'flex';
    });

    // DOM loaded: chat logic
    document.addEventListener("DOMContentLoaded", function () {
        const chatInput = document.getElementById("chat-input");
        const chatSubmit = document.getElementById("chat-submit");
        const chatOutput = document.getElementById("chat-output");

        function appendMessage(sender, message) {
            const messageHtml = `<p><strong>${sender}:</strong> ${message}</p>`;
            chatOutput.innerHTML += messageHtml;
            chatOutput.scrollTop = chatOutput.scrollHeight;
        }

        async function sendMessage() {
            const userMessage = chatInput.value.trim();
            if (!userMessage) return;

            appendMessage("You", userMessage);
            appendMessage("InnoBot", "<span class='bot-loading'>Typing...</span>");

            try {
                const response = await fetch("https://app8800.pythonanywhere.com/chatbot", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ message: userMessage })
                });

                const data = await response.json();

                // Remove typing placeholder
                chatOutput.lastElementChild.remove();
                appendMessage("InnoBot", data.reply);
            } catch (error) {
                chatOutput.lastElementChild.remove();
                appendMessage("InnoBot", "❌ Couldn't reach the server.");
            }

            chatInput.value = "";
        }

        chatSubmit.addEventListener("click", sendMessage);
        chatInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") sendMessage();
        });
    });
</script>


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
                <button type="button" class="u-btn u-btn-submit u-button-style u-btn-1" onclick="performSearch()">
                <img src="/images/211817_search_strong_icon.png" alt="Search Icon" style="width: 20px; height: 20px;">
</button>                </div>
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
    





<!-- بداية عرض المشرفين المرشحين -->
<section id="recommendedSupervisors" class="u-align-center u-clearfix u-container-align-center u-gradient u-section-2" style="background-color: #e9f2fa; width: 100vw;">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-text u-text-palette-1-dark-1 u-text-1" style="margin:10px;">Recommended Supervisors</h2>
        <div class="u-layout-grid u-list u-list-1" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
            <div class="u-repeater u-repeater-1">
                <?php
                usort($recommendedSupervisors, function ($a, $b) {
                    return $a['availability'] === 'Unavailable' ? 1 : -1;
                });
                ?>

                <?php if (empty($recommendedSupervisors)): ?>
                    
                    <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1"
 style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); width: 1200px; min-height: 100px; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 20px; font-size: 32px;">
                        <p style="font-size: 18px; color: #4D7397;">
                            No recommended supervisors found for your current interests.
                        </p>
                    </div>
                <?php else: ?>
                    <?php foreach ($recommendedSupervisors as $supervisor): ?>
                    <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
                         style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); margin-bottom: 20px;">
                        <div class="u-container-layout u-similar-container u-container-layout-1" >

                            
                            <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2">
     Dr. <?= htmlspecialchars($supervisor['name']) ?> (Recommended)
</h5>

                            <div class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-2" style="margin-bottom: 35px;"></div>
                            <a href="ViewSupervisor.php?supervisor_email=<?= urlencode($supervisor['email']) ?>" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">View</a>
                            <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3"><?= htmlspecialchars($supervisor['email']) ?></h6>
                            <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-4"> </h6>
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
                                    <img src="images/<?= $supervisor['availability'] === 'Unavailable' ? 'Incorrect.png' : '3699459-d2dcaf9f.png'; ?>" alt="Availability Icon" style="width: 16px; height: 16px; vertical-align: middle;">
                                </span>
                            </h6>

                                                   <?php if ($supervisor['availability'] !== 'Unavailable' && empty($teamData['supervisor_email'])): ?>
    <?php if ($_SESSION['role'] === 'leader'): ?>
        <a href="RequestSupervisor.php?supervisor_email=<?= urlencode($supervisor['email']) ?>" 
           class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">
           REQUEST
        </a>
    <?php endif; ?>
<?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<!-- </section> -->
<?php endif; ?>
<!-- نهاية المشرفين المرشحين -->


<!-- بداية المشرفين الآخرين -->
<div id="otherSupervisorsSection" class="u-clearfix u-sheet u-sheet-1">
    <div class="u-clearfix u-sheet u-sheet-1">
        <h2 class="u-align-center u-text u-text-palette-1-dark-1 u-text-1" style="margin:10px;">Other Supervisors</h2>
        <div class="u-layout-grid u-list u-list-1">
            <div class="u-repeater u-repeater-1">
            <?php
usort($otherSupervisors, function ($a, $b) {
    return $a['availability'] === 'Unavailable' ? 1 : -1;
});
?>
                <?php foreach ($otherSupervisors as $supervisor): ?>
                    <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
                         style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); margin-bottom: 20px;">
                        <div class="u-container-layout u-similar-container u-container-layout-1">

                          
                            <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2">
     Dr. <?= htmlspecialchars($supervisor['name']) ?>
</h5>

                            <div class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-2" style="margin-bottom: 35px;"></div>
                            <a href="ViewSupervisor.php?supervisor_email=<?= urlencode($supervisor['email']) ?>" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">View</a>
                            <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3"><?= htmlspecialchars($supervisor['email']) ?></h6>
                            <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-4"> </h6>
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
                                    <img src="images/<?= $supervisor['availability'] === 'Unavailable' ? 'Incorrect.png' : '3699459-d2dcaf9f.png'; ?>" alt="Availability Icon" style="width: 16px; height: 16px; vertical-align: middle;">
                                </span>
                            </h6>

                           <?php if ($supervisor['availability'] !== 'Unavailable' && empty($teamData['supervisor_email'])): ?>
    <?php if ($_SESSION['role'] === 'leader'): ?>
        <a href="RequestSupervisor.php?supervisor_email=<?= urlencode($supervisor['email']) ?>" 
           class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">
           REQUEST
        </a>
    <?php endif; ?>
<?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</section>
<!-- نهاية المشرفين الآخرين -->



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
const recommendedSection = document.getElementById("recommendedSupervisors");
const otherSupervisorsSection = document.getElementById("otherSupervisorsSection");

// Reset input visibility
trackDropdown.style.display = "none";
textField.style.display = "none";
filterBar.style.display = "none";

// Show input fields based on selected category
if (searchCategory === "SupervisorName") {
    textField.style.display = "block";
    // Show supervisors
    if (recommendedSection) recommendedSection.style.display = "block";
    if (otherSupervisorsSection) otherSupervisorsSection.style.display = "block";

} else if (searchCategory === "Track") {
    trackDropdown.style.display = "block";
    // Show supervisors
    if (recommendedSection) recommendedSection.style.display = "block";
    if (otherSupervisorsSection) otherSupervisorsSection.style.display = "block";

} else if (searchCategory === "ProjectName") {
    textField.style.display = "block";
    filterBar.style.display = "flex";

    // Hide supervisors
    if (recommendedSection) recommendedSection.style.display = "none";
    if (otherSupervisorsSection) otherSupervisorsSection.style.display = "none";

    loadInitialProjects(); // Fetch initial projects list
}
}

const recommendedEmails = <?= json_encode($recommendedEmails); ?>;

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
            // document.getElementById("initialSupervisors").style.display = "none"; // Hide initial supervisors
            // Hide recommended and other supervisors sections
            const recommendedSection = document.getElementById("recommendedSupervisors");
            const otherSupervisorsSection = document.getElementById("otherSupervisorsSection");
            if (recommendedSection) recommendedSection.style.display = "none";
            if (otherSupervisorsSection) otherSupervisorsSection.style.display = "none";
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


function openDocument(documentPath) {
    const url = documentPath.trim(); // Use the path as stored in the database
    window.open(url, '_blank'); // Open the document in a new tab
}

function fetchAndOpenDocument(button) {
    const projectId = button.getAttribute('data-project-id');

    // Perform an AJAX request to fetch the document URL
    fetch(`getDocument.php?project_id=${projectId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.documentUrl) {
                // Open the document in a new tab
                window.open(data.documentUrl, '_blank');
            } else {
                alert('Failed to retrieve document. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error fetching document URL:', error);
            alert('An error occurred. Please try again.');
        });
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
        resultsDiv.innerHTML = "<h4 style='background-color: #E7F1FA; color: #4D7397; margin: -10px; padding: 40px 0px 500px 0px; text-align: center;'>No results found.</h4>";
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
            style="background-image: linear-gradient(#e9f2fa, #adcce9); width: 100vw; padding: 30px -40; box-sizing: border-box; margin-left: calc(-50vw + 50%);">
                
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
                                    <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2" style="margin: 10px 200px 10px 100px;">${item.name}</h5>
                                    <p style="margin-bottom: 100px; font-size: 16px; line-height: 1.6; text-align: left; padding-right: 20px;">${item.description}</p>
                                    
                                   <!-- <a href="${item.document}" target="_blank" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1" style=" margin:50px 200px 50px 450px">View</a> -->
<span class="u-btn u-button-style u-palette-1-base u-btn-1" style="margin:50px 200px 50px 450px; cursor: not-allowed; opacity: 0.6;">View</span>
                                </div>
                            </div>` : `
                            <div class="u-container-style u-list-item u-repeater-item u-shape-rectangle u-white u-list-item-1" 
     style="background-color: white; box-shadow: 5px 5px 19px rgba(0,0,0,0.15); margin-bottom: 20px;">
                                
    <div class="u-container-layout u-similar-container u-container-layout-1">
    <h5 class="u-align-center u-text u-text-palette-1-dark-1 u-text-2">
    ${item.name}${recommendedEmails.includes(item.email) ? ' (Recommended)' : ''}
</h5>
        <div class="u-border-5 u-border-palette-1-dark-1 u-image u-image-circle u-image-2" data-image-width="309" data-image-height="309" style="margin-bottom: 35px;"></div>
        
        <a href="ViewSupervisor.php?supervisor_email=${encodeURIComponent(item.email)}" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-1">View</a>
        <h6 class="u-align-left u-text u-text-default-lg u-text-default-md u-text-default-sm u-text-default-xl u-text-3">${item.email}</h6>

        <h6 class="u-align-left u-text u-text-default u-text-palette-1-dark-1 u-text-4">Interest:</h6>
        
        <ul class="u-align-left u-text u-text-5">
            ${item.interest.split(',').map(interest => `<li>${interest.trim()}</li>`).join('')}
        </ul>

        <h6 class="u-align-center-xs u-align-left-lg u-align-left-md u-align-left-sm u-align-left-xl u-custom-font u-font-oswald u-text u-text-6" 
            style="color: ${item.availability === 'Unavailable' ? 'red' : '#5cb85c'}; display: inline;">
            ${item.availability}
            <span class="u-file-icon u-icon u-icon-1" style="display: inline; vertical-align: middle; margin-left: 5px; margin-bottom: 10px;">
                <img src="images/${item.availability === 'Unavailable' ? 'Incorrect.png' : '3699459-d2dcaf9f.png'}" alt="Availability Icon" style="width: 16px; height: 16px;">
            </span>
        </h6>
        
        ${item.availability !== 'Unavailable' ? `
            <a href="RequestSupervisor.php?supervisor_email=${encodeURIComponent(item.email)}" class="u-btn u-button-style u-hover-palette-1-dark-1 u-palette-1-base u-btn-2">REQUEST</a>
        ` : ''}
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



