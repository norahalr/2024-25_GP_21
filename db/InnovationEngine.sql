-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 02, 2024 at 04:26 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `InnovationEngine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `name`, `password`) VALUES
('443200556@student.ksu.edu.sa', 'Norah Alrajhi', '1234'),
('443200794@student.ksu.edu.sa', 'Marya Asaad', '1234'),
('443200961@student.ksu.edu.sa', 'Alhanouf Alshalan', '1234'),
('443202519@student.ksu.edu.sa', 'Alia Alrassan', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `external_departments_requests`
--

CREATE TABLE `external_departments_requests` (
  `id` int(20) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `collage` varchar(100) NOT NULL,
  `idea_description` text NOT NULL,
  `status` enum('Pending','Approved','Rejected','Canceled') NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `past_projects`
--

CREATE TABLE `past_projects` (
  `id` int(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `keywords` varchar(500) NOT NULL,
  `document` varchar(500) NOT NULL,
  `field` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `past_projects`
--

INSERT INTO `past_projects` (`id`, `name`, `description`, `keywords`, `document`, `field`) VALUES
(1, 'Mehrab', 'Mehrab is a mobile app designed to enhance mosque management and community engagement by leveraging IoT technology. This comprehensive system improves user experience in managing mosque activities through effective communication and task delegation among mosque managers (Imam and Muezzin) and community members. The application incorporates smart locks for secure access control, enabling trackable delegation of responsibilities such as opening and closing doors. With a focus on inclusivity and data confidentiality, Mehrab aims to create a connected mosque community that efficiently manages religious activities while promoting collaboration and active participation. ', 'mosque,smart mosque,community management,iot,building automation,smart locks, real time monitoring,visitor management,event scheduling,access management,community outreach,mobile application,smart delegation,facility management,community feedback,building', 'PastProjects/3_Mehrab_Release-2.pdf', 'Smart Cities & Environment'),
(2, 'Naqi', 'NAQI is a mobile app that monitors and improves air quality using IoT and LoRaWAN technology. It tracks indoor and outdoor air quality in real-time, focusing on CO2 and dust levels (PM2.5). The app provides personalized alerts based on users\' health status and controls ventilation automatically when CO2 exceeds safe limits. NAQI generates daily, weekly, and monthly reports and is ideal for those with respiratory issues. Developed with Flutter and integrated with Google Cloud.', 'air,air pollution,indoor air quality,outdoor air quality,carbon dioxide,poor ventilation,virus transmission,dust pollution,internet of things,lorawan,real-time monitoring,air quality sensors,co2 thresholds,fan automation,air pollution control,cities,personalized alerts,breathing issues,air quality reports,smart home integration', 'PastProjects/19_Naqi_Release-2.pdf', 'Smart Cities & Environment'),
(3, 'GRN Vtools', 'GRN VTOOLS is a web-based platform that streamlines Gene Regulatory Network (GRN) construction and analysis for biologists. It features pre-installed tools like DIANE and SeqNet, utilizing methods such as GENIE3 and Gaussian graphical models (GGM) for GRN inference. Users can compare GRNs generated from different methods or datasets in a single interactive dashboard. GRN VTOOLS offers visualization, comparison, and analysis features, particularly valuable for patient-focused studies, making it easier to explore gene pathways and regulatory dynamics.\n', 'gene,regulatory,network,data ,grn,inference,diane,seqnet,genie3,ggm,biologists,visualization,comparative,analysis,prediction,pathways,gene-expression,hub-genes,cellular-processes,grn-tools,interactive-dashboard', 'PastProjects/20-GRNVtool_report.pdf', 'Data Analysis'),
(4, 'Maternal', 'Maternal is an Arabic Android application designed to support and guide Arabic pregnant women throughout their pregnancy journey.The app provides essential pregnancy tracking features, including week-by-week updates, vital signs tracking, and a contraction timer. Its unique Arabic AI chatbot, built using the AraGPT2 model and a custom Arabic knowledge base, allows users to ask questions and receive instant, accurate responses, addressing concerns and providing reassurance. The app aims to fill the gap in high-quality Arabic pregnancy tools and improve maternal health outcomes.', 'pregnancy,tracking,arabic,vital signs,contraction timer,ai support,motherhood,prenatal care,health monitoring,aragpt2 model,maternal', 'PastProjects/21-Maternal_Release-2.pdf', 'Health'),
(5, 'Hiral', 'Hiral is a Django-based web application designed to enhance the efficiency of the job search process by connecting job seekers with recruiters. Utilizing advanced technology, it automates skill extraction from job seekers\' CVs and job postings through the SkillNer NLP module, continually expanding its skills dictionary. By employing sentence transformers, Hiral matches candidates to job opportunities based on semantic similarity, streamlining the search experience for both parties. The platform provides personalized recommendations, an analytical dashboard, and valuable insights to improve hiring efficiency and job searching. Ultimately, Hiral simplifies the complexities of the job market, making it easier for job seekers to find suitable positions and for recruiters to identify qualified candidates.', 'career searching,job search,recruitment,candidate matching,skill extraction,nlp,skillner,automated screening,cv parsing,job posts,semantic similarity,sentence transformers,analytical dashboard,job seekers,recruiters,skills dictionary,job opportunities,job recommendations,employment,ai,job market,personalized recommendations', 'PastProjects/22-Hiral_Release2.pdf', 'Human Resources'),
(6, 'Elmam', 'Elmam is a website designed for smart building monitoring, specifically targeting public building managers in educational institutions. It integrates IoT technologies to monitor environmental factors such as air quality, temperature, and noise levels. The website provides real-time data, enabling proactive decision-making, space optimization, and improved occupant well-being. Elmam features an easy-to-use interface for managing room availability, generating reports, and displaying environmental data through an interactive map. By promoting sustainability and efficient space usage, the system aligns with Saudi Arabia’s Vision 2023 goals.', 'smart building,monitoring system,iot,air quality,temperature sensors,noise sensors,real time data,space optimization,building management,environmental monitoring,productivity improvement,indoor conditions,sustainability,saudi arabia vision 2023', 'PastProjects/23-Elmam.pdf', 'Smart Cities & Environment'),
(7, 'OpenData Insights', 'OpenData Insights is a web-based platform designed to assess the quality of open datasets based on six international standards: accuracy, completeness, timeliness, consistency, reliability, and comprehensiveness. This tool provides users with detailed statistics and recommendations to improve the trustworthiness and utility of their datasets. By uploading datasets, users can visualize data quality metrics, compare results, and receive suggestions for dataset improvement. OpenData Insights is intended to aid business owners, government agencies, and individuals in making data-driven decisions, improving operational efficiency, and contributing to informed market analysis.', 'open data,data quality,nternational standards,accuracy,timeliness, completeness,consistency,reliability,comprehensiveness,data driven decisions,dataset comparison,dataset assessment,data statistics,open dataset\r\n,improve dataset,dataset improvement, recommendations,data quality metrics,dataset improvement suggestions, dataset,analysis\r\n\r\n\r\n\r\n\r\n', 'PastProjects/1-Project OpenData Dr Lulah.pdf', 'Data Analysis'),
(8, 'Taboua', 'Taboua is an innovative waste management system designed to tackle the challenges of effective waste disposal in Saudi Arabia, particularly in Riyadh. This user-friendly platform serves both individuals and the Riyadh Municipality, integrating advanced technologies such as image classification and interactive mapping. Leveraging Firebase Firestore for database management, Flutter for mobile app development, and React for web application development, Taboua enhances user experience through real-time data processing and administrative capabilities. By utilizing TensorFlow and Keras for image classification and incorporating the Google Maps API for location-based services, Taboua empowers users to manage waste responsibly and efficiently. This solution aims to promote sustainable practices, encouraging community engagement in waste management while contributing to environmental goals.', 'waste,waste management,image classification,mapping,api,real time data,sustainability,community,environmental responsibility,tensorflow,keras,interactive mapping,sustainability,mapping Features,Google Maps', 'PastProjects/2-Project Taboua Dr_Ebtisam.pdf', 'Smart Cities & Environment'),
(9, 'Business Gate', 'The Business Gate is a comprehensive platform designed to enhance the operational efficiency of Business Units (BUs) at King Saud University (KSU) in alignment with Saudi Arabia\'s Vision 2030. This workflow management system includes a web-based application and a mobile app, addressing communication gaps and resource management issues faced by BUs. By streamlining daily operations, facilitating project assignments, and improving communication, Business Gate will enable KSU to promote sustainable development and innovation while effectively managing the complexities of educational and consultancy services.', 'business gate,business units,workflow management,king saud university,vision 2030,operational efficiency,communication,resource management,sustainable development,technology,consultancy services,project management,training programs,faculty communication,user centered design,data collection,task tracking,collaboration,educational innovation,knowledge economy,kai,business units,process improvement,digital transformation', 'PastProjects/25-Project Naasiq Dr_Nora_Alrosais.pdf', 'Academic Solutions'),
(10, 'Techقصّـ ', 'Techقصّـ is an innovative application aimed at transforming the storytelling landscape by allowing users to create and share engaging narratives in Arabic. By combining text with interactive images, the app provides a robust platform for users to craft illustrated stories that resonate with readers. Leveraging advanced image generation techniques and natural language processing, Techّ facilitates the creation of relevant visuals that enhance the storytelling experience. Users can easily generate images corresponding to their story events, publish their work, and share it across social media platforms, fostering a communal and creative storytelling environment. Designed to empower writers, Techّ emphasizes creativity and language development while ensuring a dynamic exploration of human experiences.', 'storytelling,image generation,natural language processing,Arabic literature,visual storytelling,creativity,user engagement,mobile application,social media sharing,communal experience,intuitive tools,illustrated narratives,language development,narrative visualization,multimedia storytelling,interactive images,personalization,user experience,PDF export,agile methodology,emotional connection,narrative elements,visual representation,character illustration', 'PastProjects/4-Project-4 Techقص Dr_Manal.pdf', 'Entertainment'),
(11, 'InnerJoy', 'InnerJoy is a platform addressing the need for accessible and personalized mental health support while breaking down stigma. It offers features like depression and anxiety assessments, daily reminders, a supportive chatbot, therapeutic plans, guided meditation, stress-relief games, and yoga exercises. Developed with agile principles, InnerJoy uses iterative sprints for user needs analysis, design, development, and testing, incorporating regular feedback.', 'mental health,depression,health,anxiety, well being,self help,support app,stigma free,chatbot,therapeutic plans,guided meditation,stressre lief,yoga practices,phq9,gad7,ananda yoga,anusara yoga,hatha yoga,cbt,mindfulness,progress tracking,color blind friendly,personalized recommendations,mental health journey,relaxation techniques,brick breaker', 'PastProjects/5-Project-5 InnerJoy Dr_Afshan.pdf', 'Health'),
(12, 'TeXel', 'Texel is an innovative mobile application designed to address the challenges faced by technology professionals and enthusiasts in navigating the complex landscape of technical information and assistance. By consolidating features from various platforms into a single, user-friendly interface, Texel enhances productivity, collaboration, and learning within the tech community. Utilizing advanced AI-driven recommendations, Texel offers personalized content tailored to each user’s interests and needs, transforming the often-frustrating search for technical solutions into a seamless experience. Ultimately, Texel empowers individuals to stay informed, connected, and engaged in their professional development, fostering a vibrant ecosystem of knowledge sharing and collaboration.', 'technology community,productivity,collaboration,ai recommendations,knowledge sharing,technical assistance,digital transformation,information access,professional growth,event tracking,course recommendations, academic,user,freelance opportunities,seamless navigation,frustration reduction,centralized platform', 'PastProjects/6-Project-6 TechXcel Dr_Mashael.pdf', 'Academic Solutions'),
(13, 'Watheq', 'Watheq is a centralized platform connecting job seekers and providers through a mobile and web application. It streamlines the job search and recruitment process by offering personalized job recommendations and AI-powered interview simulations using GPT-3.5. Job seekers can browse and apply for jobs, receive personalized interview training, and track applications, while job providers can post job offers, manage applications, and receive candidate recommendations.', 'job,career,job seeker,recruitment,interview simulation,gpt3.5,job recommendations,,job search,job providers,ai driven,cv matching,employment matching,job platform,candidate recommendation,application tracking,hiring process,career opportunities,automated recruitment,skill matching,job posting platform,personalized interviews,ai interview coaching', 'PastProjects/7 Project Watheq Dr_Hessah.pdf', 'Human Resources'),
(14, 'Secure Box', 'The Secure Box is a mobile application designed to tackle limited storage capacity and security risks in mobile file storage. It offers a secure platform for file storage and sharing by utilizing server-based storage and advanced encryption techniques. Additionally, Secure Box incorporates measures to prevent shoulder surfing attacks, enhancing user privacy. The app includes various file management functions, such as uploading, sharing, and organizing files, along with features like two-factor authentication and fingerprint biometrics. ', 'file storage,mobile file sharing,server based storage,encryption,shoulder surfing attacks,privacy,security,two factor authentication,fingerprint biometrics,file management,storage', 'PastProjects/8 Project Secure Box Dr_Khulood_Alsaleh.pdf', 'Security'),
(15, 'TheraSense', 'TheraSense is a mobile application developed to improve rehabilitation processes for patients with Spinal Cord Injuries (SCI) by providing a reliable activity recognition system. The solution comprises an Android app and a wrist-mounted wearable sensor that monitor and recognize upper limb physical activities. By utilizing advanced machine learning techniques, the system achieves an accuracy of 95%, allowing therapists to accurately assess patient adherence to prescribed physical activity. TheraSense aims to enhance the evaluation of rehabilitation programs, enabling therapists to make informed decisions based on real-time data rather than self-reported measures, which often exhibit variability. This innovative approach not only supports patient recovery but also promotes a better quality of life through increased independence.', 'spinal cord injuries,activity recognition system,physical activities,rehabilitation,sci,therapists,patient adherence,real time data,machine learning,health', 'PastProjects/9 Project TheraSense Dr_Nora_Alhammad.pdf', 'Health'),
(16, 'Wjjhni', 'Wjjhni is a mobile application designed for female students in the College of Computer and Information Sciences at King Saud University, aimed at enhancing academic advising. It features an AI chatbot powered by IBM Watson Assistant to answer common questions about courses and university rules. The app allows students to book advising appointments online, access academic resources, and communicate with advisors in real-time. With tools like an academic calendar, absence calculator, and an admin dashboard for managing database operations, Wjjhni streamlines the advising process, improving communication and accessibility for a more efficient academic journey.', 'academic advising,chatbot,ibm Watson assistant,student support,appointment booking,real time communication,academic resources,king saud university,College of Computer and Information Sciences,academic calendar,absence calculator', 'PastProjects/10-Project Wijihni Dr_Hend.pdf', 'Academic Solutions'),
(17, 'S’hail', 'S\'hail is an Android mobile application designed to enhance the tourism experience in Saudi Arabia by providing easy access to information about tourist attractions, malls, and restaurants. Aligned with the country\'s Vision 2030, the app aims to improve the overall user experience for both locals and travelers by offering features like detailed information, user-generated content, a content-based recommendation system, and an interactive map for easy navigation. By addressing existing gaps in current tourism applications, \"S\'hail\" seeks to support the growth of Saudi Arabia\'s tourism sector.', 'tourism,saudi arabia,ksa,mobile application, attractions,restaurants,recommendation system,recommender,interactive map,localization,user generated content,trip planning,travel guide,geolocation,feedback system,dining options,malls,cultural experiences,economic growth,user engagement', 'PastProjects/11-Project S\'hil Dr_Nouf.pdf', 'Entertainment'),
(18, 'Novoy', 'Novoy is a mobile application designed to simplify trip planning by providing personalized itineraries tailored to users\' preferences. The app addresses the challenges of overwhelming travel options and limited information by allowing users to schedule daily destinations, access real-time information, and generate shareable to-do lists. With features like blogging and experience sharing, Novoy fosters a community of travelers.\n\nBuilt using Scrum methodology and developed with Flutter, Novoy ensures cross-platform compatibility and efficient resource utilization. Integration with Google Places and Google Maps APIs enhances navigation, while the tf-idf algorithm powers personalized recommendations. User feedback highlights its intuitive interface and efficient itinerary creation, significantly improving the travel planning experience.', 'tourism,travel app,trip planning,personalized itineraries,real time information,collaboration,blogging,tf idf algorithm,google maps integration,sightseeing recommendations,itinerary creation,travel community,destination suggestions,travel organization,shared planning,travel automation,user satisfaction,travel data,recommendations,travel features,group planning,leisure travel,travel management,cultural exploration,travel itinerary,experience sharing,ai technology,navigation support', 'PastProjects/12-Project Novoy Dr. Lama Alzaben.pdf', 'Entertainment'),
(19, 'Learniverse', 'Learniverse is a centralized platform designed to streamline the management and integration of various educational tools, addressing the issue of fragmented learning experiences. Built with agile methodologies, it promotes continuous enhancement based on user feedback, thereby improving students\' resource management and academic productivity. By facilitating better collaboration and efficient study practices, Learniverse elevates the educational landscape, making learning more integrated and accessible for students at all levels.', 'education,learn,educational platform,resource management,learning tools,academic productivity,student support,integration,user feedback,study efficiency,personalized learning,educational technology,API,ChatGPT,quiz generation,summarization,unified platform,learning experience', 'PastProjects/13-Project Learnverse Dr_Rehab.pdf', 'Academic Solutions'),
(20, '91', 'The 91 is a mobile application is designed to tackle the challenges associated with gas consumption and congestion at gas stations. By leveraging advanced AI technology, the app enables users to calculate their fuel consumption and expenses based on their bills while providing real-time occupancy information of nearby gas stations. Utilizing the YOLO (You Only Look Once) object detection algorithm, \"91\" processes video footage from entrance and exit cameras to determine gas station occupancy levels and recognize vehicles through their license plates.', 'gas,fuel,computer vision,real time occupancy detection,license plate recognition,license plate extraction,fuel consumption tracking,artificial intelligence in transportation,gas station management,fuel economy,qr code integration,gas station congestion, expense tracking,user feedback integration,yolo algorithm,video processing,consumption insights,ai powered solutions,smart gas station,auto mobile sector,resource management,air', 'PastProjects/14-Project 91 Dr_Hailah.pdf', 'Smart Cities & Environment'),
(21, 'Riyadh Guide', 'Riyadh Guide is a mobile application designed to assist users in discovering and exploring entertainment and leisure options in Riyadh. It includes a robust recommender system that provides personalized suggestions based on user preferences and previous interactions. The app features a comprehensive database of attractions, interactive maps for easy navigation, and user-generated reviews to enhance the overall experience. With its user-friendly interface, Riyadh Guide aims to help locals and visitors alike find the best spots to enjoy in the city.', 'leisure,entertainment,recommender system,attractions,user generated reviews, reviews,tourism,machine learning,sentiment analysis,user reviews,event calendar,loyalty programs,bank offers,places of interest,cultural heritage,quality of life,vision 2030,riyadh,ksa', 'PastProjects/15-Project Riyadh Guide Dr_Lama_AlSudais.pdf', 'Entertainment'),
(22, 'Game Geek', 'Game Geek is a web-based system designed to help users find video games that are appropriate for their age groups. Addressing the critical issue of inappropriate game exposure, especially for children, this system employs a custom CNN model to estimate users\' age based on facial recognition. After determining the user\'s age group, the system recommends suitable games from the App Store dataset, minimizing the need for parental oversight. Built using Agile methodology, the platform integrates user feedback through iterative development cycles to enhance usability and functionality. Game Geek ultimately promotes responsible gaming habits and ensures a safer gaming environment for all age demographics.', 'video games,age appropriate games,facial recognition,cnn model,user feedback,responsible gaming,app Store,gaming safety,child protection,content filtering,game recommendations,deep learning,user interface,software development,game selection,gaming industry,parental controls,entertainment technology,user engagement,digital,gaming experience', 'PastProjects/16-Project Game Geek Dr_Wejdan.pdf', 'Entertainment'),
(23, 'Qusasa', 'Qusasa is an AI-powered platform that revolutionizes data analytics by simplifying the intricate process of data collection. Designed for users at all technical levels, Qusasa focuses primarily on YouTube data, harnessing robust APIs to deliver automated, comprehensive analysis. Users can access insights through scheduled analysis, AI-driven data interpretation, and enhanced manipulation tools. Evaluations indicate that Qusasa not only enables deeper data understanding through intuitive reports and visuals but also significantly boosts user engagement and satisfaction, making advanced analytics accessible and actionable.', 'data analytics,ai,predictivean alytics,YouTube,automation,data interpretation,visualization,api,web scraping,data collection,metrics,trend analysis,data extraction,insights,actionable data,decision making,analysis', 'PastProjects/17-Project قصاصة Dr_Khulood_Alyahya.pdf', 'Data Analysis'),
(24, 'Physio', 'The Physio project is an innovative initiative designed to transform physiotherapy services in Saudi Arabia by addressing challenges such as limited access to therapy centers and appointment scheduling difficulties. By integrating virtual reality (VR) technology, the project offers an immersive platform that allows patients to engage in personalized treatment plans, instructional videos, and interactive therapy sessions. The application is designed to enhance accessibility, reduce costs, and increase engagement for patients while providing therapists with tools to monitor and adjust treatments effectively. This solution aims to improve the overall physiotherapy experience, particularly for those with upper body pain.', 'vr in physiotherapy,physiotherapy app,therapy,vr-based rehab,customized treatment plans,therapy accessibility,interactive exercises,patient progress tracking,virtual therapy tools\r\n', 'PastProjects/18_Physio_Release-2 .pdf', 'Health'),
(25, 'Rehaab', 'an innovative system designed to streamline the management of electric vehicles at Al-Masjid Al-Haram, providing an accessible and efficient solution for visitors, vehicle managers, and administrators. The system enables visitors to easily reserve, track, and manage their electric vehicle usage during Tawaf, reducing waiting times and improving accessibility for the elderly and disabled. With features like real-time vehicle availability, automatic Tawaf tracking, and congestion heatmaps, Rehaab enhances the overall experience for pilgrims, ensuring they can optimize their time at the sacred site while administrators efficiently manage vehicle operations.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 'rehaab system,al-masjid al-haram,electric vehicles management,tawaf tracking,vehicle reservation app,pilgrim accessibility,elderly and disabled support,real-time vehicle availability,vehicle congestion heatmap,al-haram visitor experience,vehicle management system,automatic check-out,gps tracking for tawaf,computer vision in vehicle management,building', 'PastProjects/24-rehaab.pdf', 'Smart Cities & Environment'),
(26, 'RASD', 'The RASD system is an innovative mobile application designed to detect and report traffic violations such as drifting, driving in the opposite direction, and overtaking in Saudi Arabia. By integrating dashcam footage with computer vision technology, RASD uses real-time video streams to automatically identify traffic violations, generate reports, and send them to the appropriate authorities. The system leverages AI models like MobileNetv2 and YOLOv5 for accurate vehicle detection and violation analysis, contributing to enhanced road safety. It also simplifies the reporting process for drivers, reducing the need for manual recording and ensuring a streamlined approach to improving traffic safety.', 'rasd system,traffic violation detection,dashcam integration,computer vision,artificial intelligence,drifting detection,driving in opposite direction,overtaking detection,mobile application,violation reporting,road safety,yolo model,mobilenetv2,video stream processing,saudi arabia traffic safety,automated violation reporting', 'PastProjects/26-RASD_Release-2.pdf', 'Smart Cities & Environment'),
(27, 'Read Me a Story ', '\"Read Me a Story\" is a tablet application designed to help parents and educators easily find children\'s books categorized by specific morals, such as friendship, honesty, respect, bravery, and patience. The app utilizes advanced machine learning technology, specifically the RoBERTa transformer model, to classify stories into these moral categories with 91% accuracy. In addition to reading, users can listen to the stories, bookmark pages, and save favorite books. The app simplifies the process of teaching children moral lessons through stories, providing both psychological and educational benefits. It supports English-language books and aims to make storytelling a more targeted and efficient tool for moral education.', 'read me a story,children\'s books,moral values,storytelling,machine learning,book classification,friendship, honesty,respect,bravery,patience,educational app,moral education,listening to stories,parenting,teaching morals through stories', 'PastProjects/27-ReadMeAStory_Release-2.pdf', 'Children Solutions'),
(28, 'Elfaa', 'The Elfaa system is an innovative IoT-based mobile application designed to help parents monitor their children\'s whereabouts in crowded public places. The system uses a child-friendly wearable accessory embedded with GPS and GSM sensors, allowing parents to track their child\'s location in real time through an Android app. The app sends alerts when the child exceeds a set safe distance and allows parents to report missing children to security guards, who can also track and manage these reports. Admins can oversee security guard accounts and manage missing child reports.Elfaa aims to provide a safer environment by enabling quick response times and facilitating the process of finding lost children, particularly in public spaces within Saudi Arabia.', 'child tracking,iot wearable,gps tracking,gsm sensors,mobile application,child safety,lost children,real-time location tracking,safe distance alerts,missing child reports,security guards,arabic language,public places,child monitoring system', 'PastProjects/28-Elfaa_Release-2.pdf', 'Children Solutions'),
(29, 'Ewaa', 'The EWAA application is an Android-based platform designed to simplify and digitalize the pet adoption process in Riyadh, Saudi Arabia. It connects pet owners and adopters, providing a reliable and efficient solution for finding suitable homes for pets. The app features a recommender system that suggests pets based on user preferences and offers functions such as browsing available pets, submitting and managing adoption requests, and sharing pet details. By streamlining the adoption process and raising awareness about pet adoption, **EWAA** aims to reduce the reliance on social media and physical visits to shelters, offering a trustworthy and user-friendly platform dedicated to pet adoption in Saudi Arabia.', 'pet adoption,android application,pet owners,pet adopters,digital pet adoption,riyadh,saudi arabia,pet recommender system,adoption requests,animal shelters,cats and dogs,pet adoption platform,user-friendly app,pet adoption awareness', 'PastProjects/29-Ewaa_Release-2.pdf', 'Smart Cities & Environment'),
(30, 'Findly', 'Findly is an Android mobile application developed to address the issue of lost and found items on the King Saud University (KSU) female campus. The app provides a platform for campus members—students, faculty, and staff—to post announcements about lost and found items, improving communication between those who find items and those who have lost them. Key features include private chat functionality, a chatbot for assistance, and a notification system that alerts users when matching lost/found announcements are posted.Findly enhances the process of reconnecting items with their owners, saving time and promoting a sense of community. The app can also serve as inspiration for similar platforms in other high-traffic areas like airports and shopping malls.', 'lost and found,ksu female campus,item announcements,private chat,chatbot assistant,notification system,lost items,found items,campus communication,university community,mobile application,sustainability,user satisfaction,item recovery', 'PastProjects/30-Findly_ Release-2.pdf', 'Smart Cities & Environment'),
(31, 'Halaqa', 'Halaqa is a web-based mobile application designed to enhance communication between parents and schools, specifically targeting educational institutions in Saudi Arabia. The platform offers a wide range of features, including real-time chat between parents and teachers, student grade and attendance tracking, document uploads, and a streamlined student pickup system. Halaqa supports both iOS and Android platforms and focuses on providing a more efficient, digitalized method for managing school-parent communication.Halaqa ensures flexibility and continuous improvement throughout its development. The application simplifies interactions between schools and parents, ultimately benefiting students by creating a more cohesive and supportive educational environment.', 'school-parent communication,student tracking,attendance tracking,grade tracking,real-time chat,document upload,student pickup system,arabic education app,school administration,educational technology,digital school management,parent-teacher collaboration', 'PastProjects/31-Halaqa_Release-2.pdf', 'Children Solutions'),
(32, 'Faydh', 'Faydh is an Arabic mobile application developed to reduce food waste in Saudi Arabia by connecting individuals and businesses with surplus food to charitable organizations and people in need. The app provides an easy platform for users to donate surplus food, share food waste awareness content, and track their donations. Designed with Saudi Arabia\'s food culture and Vision 2030\'s sustainability goals in mind, Faydh aims to combat food waste and promote a greener future.the app received positive feedback from users for its ease of use and readiness for launch.', 'food waste reduction,surplus food donation,food sharing,sustainable food practices,food awareness,charitable organizations,food banks,environmental sustainability,vision 2030,waste,enviroment', 'PastProjects/32-AYDH_Report.pdf', 'Smart Cities & Environment'),
(33, 'CyberPhish', 'CyberPhish is a mobile application designed to protect Gmail users from phishing attacks by leveraging a Support Vector Machine (SVM) classification model. The app syncs with a user\'s Gmail inbox, analyzes emails for phishing indicators using machine learning, and provides feedback on whether an email is legitimate or a phishing attempt. With an accuracy of 97%, CyberPhish helps users detect phishing emails by analyzing email content, sender reputation, and potential threats. Additionally, the app offers educational features, including awareness articles, games, and quizzes to help users understand phishing risks better.\r\n\r\n', 'phishing detection,support vector machine,email security,gmail,mobile application,phishing awareness,cybersecurity,machine learning,phishing attacks,phishing prevention', 'PastProjects/33-CyberPhish_Release-2.pdf', 'Security'),
(34, 'Medcore', 'MedCore is an iOS mobile application designed to enhance healthcare in Saudi Arabia by creating a centralized system that connects all hospitals and unifies patient files. The application enables physicians, patients, and laboratory specialists to access medical information easily, helping to reduce unnecessary tests and procedures. MedCore also features an AI-based diagnostic tool trained on 4,899 patients with 140 symptoms, achieving 91% accuracy. This tool supports physicians in diagnosing rare cases by predicting diseases and providing contact information for specialists. The application aims to improve healthcare efficiency, save costs, and enhance patient outcomes.', 'centralized healthcare system,unified patient records,AI-based diagnostic tool,decision trees,hospital communication,physician collaboration,lab test management,medical data integration,healthcare efficiency,patient outcomes,machine learning in healthcare,data-driven diagnosis,healthcare in Saudi Arabia,medical resource optimization,digital health records.', 'PastProjects/34-MedCore_ Release-2.pdf', 'Health'),
(35, 'eClinic', 'eClinic is an innovative system designed to assist students, faculty members, and administrators at the College of Computer and Information Sciences (CCIS) in King Saud University by addressing the challenges students face with graduation projects. The system provides an accessible platform for students to browse past graduation projects, schedule consultations with faculty members, view FAQs, and connect with graduates. It also supports faculty and administrators in managing help desk hours and coordination. eClinic enhances the guidance process and improves project management, making it a valuable tool for both local and global academic environments.', 'graduation projects,guidance,consultations,faculty members,students,help desk,past projects,project management,web portal,mobile application,king saud university,ccis,firebase,flutter,dart,technical issues,appointment scheduling,educational support', 'PastProjects/35-eClinic_ Release-2.pdf', 'Academic Solutions'),
(36, 'Masroofi', 'Masroofi is a web-based cashless payment system designed to transform the traditional school payment system in Saudi Arabia. The system utilizes facial recognition technology and pre-ordered meals to facilitate secure, efficient, and convenient transactions. By providing a unified platform for parents, canteen moderators, and school administrators to manage school payments, canteen orders, and student information, Masroofi aims to address the challenges of traditional payment methods, such as delayed payments, crowded canteens, and lost or damaged cash. With its user-friendly interface and reliable functionality, Masroofi offers an ideal solution for Saudi schools to improve administrative processes, save time and effort, and enhance communication with parents.', 'online payment,cashless payment,school payment system,facial recognition,education sector,digital transformation,financial management,parent communication,student information,canteen management,meal ordering,secure transactions,efficient payments,convenient transactions.\r\n\r\n', 'PastProjects/36-Masroofi_Release-2.pdf', 'Children Solutions'),
(37, 'Motazen', 'The Motazen mobile application is a life coaching tool designed to help individuals achieve a balanced life and accomplish their goals. It utilizes the Wheel of Life methodology to assess users\' current life balance and provide a visual representation of areas that need improvement. The application allows users to set goals, create to-do lists, and track progress, as well as join public and private communities to share goals and engage in friendly competition. Additionally, it features a journal space with prompts related to users\' goals and applies gamification techniques to motivate users. The application is developed using Flutter\'s Dart framework and supports the Arabic language, targeting users aged 18 and above who struggle to maintain goals and habits.', 'ife coaching,mobile application,wheel of life,goal setting,task management,journaling,gamification,motivation,self development,personal growth,productivity,organization,community,progress tracking,habit formation,mental,health.\r\n\r\n', 'PastProjects/37-motazen_Release2-.pdf', 'Health'),
(38, 'Autisme', 'The Autisme application is a revolutionary mobile app designed to educate Arabic-speaking autistic children aged 6-12 in English letters and numbers. Utilizing cutting-edge Virtual Reality (VR) technology, the app creates an immersive and interactive learning environment that caters to the unique needs of autistic children. By combining engaging games and lessons, Autisme aims to make learning fun and accessible, while also providing parents and guardians with a valuable tool to support their child\'s educational journey. With its innovative approach and commitment to inclusivity, Autisme has the potential to make a significant impact on the lives of autistic children and their families, both locally and globally.', 'autism,virtual reality,mobile application,education,arabic-speaking,autistic children,english letters and numbers,interactive learning environment,inclusive education,special needs education,assistive technology, mobile learning,game-based learning,edtech\r\n\r\n', 'PastProjects/38-Autisme_ Release-2.pdf', 'Children Solutions'),
(39, 'Circlight', 'Circlight is a mobile application designed to transform the traditional student pick-up process in Saudi schools, which is often laborious and potentially hazardous for both parents and children. Typically, parents must wait in line to announce their arrival over the school’s microphone, while children remain alert to these announcements amid a crowded and noisy environment. This outdated system can increase anxiety and fear in children and pose safety risks due to the crowded school entrances. Working parents also find this process time-consuming and inconvenient. Circlight addresses these challenges by leveraging Internet of Things (IoT) technology and smart bracelets to create a more efficient, secure, and convenient pick-up experience for families in Saudi schools.', 'iot,bracelet,smart bracelet,children,children pickup,iot,parent,parent pickup,school pickup,school', 'PastProjects/39-Circlight_Realese 2.pdf', 'Children Solutions'),
(40, 'Dhyaa', 'Dhyaa is a mobile application that connects students with qualified tutors, providing a convenient and effective private tutoring experience. The app allows students to search for tutors based on various criteria, such as subject, hourly rate, and location, and facilitates online payment for lessons. Tutors can manage their availability, receive appointment requests, and rate their students. With its user-friendly interface and robust features, Dhyaa aims to bridge the gap between students and tutors, making private tutoring more accessible and convenient.', 'dhyaa,mobile,application,connects,students,qualified,tutors,private,tutoring,experience,search,subject,hourly rate,online payment,lessons,manage,availability,receive,appointment,requests,rate,students,user friendly,accessible,convenient\r\n\r\n', 'PastProjects/40-Dhyaa__Release-2.pdf', 'Academic Solutions'),
(41, 'Nozol', 'Nozol is a cutting-edge Android mobile application designed to revolutionize the real estate experience in Saudi Arabia. This innovative platform connects property owners and seekers, providing a seamless and user-friendly interface to advertise, search, and manage properties. With features like property tour appointment bookings, accurate content-based recommendations, and a rental affordability calculator, Nozol streamlines the property search process, making it easier for users to find their ideal home. By addressing the limitations and issues of existing local real estate applications, Nozol aims to bridge the gap in the Saudi real estate market, providing a comprehensive and intuitive solution for all stakeholders involved.\r\n\r\n', 'real estate,android,mobile application,saudi arabia,property owners,property,online platform,property search,property management,user experience,software development,digital transformation\n\n', 'PastProjects/41-Nozol_Release-2.pdf', 'Smart Cities & Environment'),
(42, 'Count Me In', 'Count Me In is a mobile application developed to enhance the extracurricular experience for King Saud University students by providing a unified platform that displays all available activities and opportunities, such as courses, workshops, events, and volunteer work. The app uses a hybrid recommender system to suggest activities tailored to students’ interests and preferences, making it easier for them to participate and manage their schedules. By centralizing information and facilitating seamless enrollment, \"Count Me In\" aims to enrich students\' university experience, encouraging skill development and active participation in campus life.', 'extracurricular activities,university students,mobile application,hybrid recommender system,skill development,student engagement,course enrollment,volunteer opportunities,workshop participation,event management,student support,King Saud University,personalized recommendations,activity discovery,campus resources', 'PastProjects/42-CountMeIn_Release-2.pdf', 'Entertainment'),
(43, 'Tiryaq ', 'Tiryaq is a location-based mobile application designed to help customers in Saudi Arabia quickly locate and order medications from the nearest pharmacies. By bridging the gap between customers and pharmacies, the app aims to reduce the time and effort required to find specific medications, promoting efficient medication consumption and reducing stockpiling issues in pharmacies. Developed using the Flutter framework, Tiryaq offers features such as browsing medications, tracking orders, and real-time location detection. The app also includes an admin dashboard for managing orders, customers, and pharmacies. ensuring user feedback was incorporated at each stage to enhance usability and meet user needs effectively.', 'location-based,medication,pharmacy,order,inventory,Flutter,dart,customer,real-time,delivery,healthcare,admin dashboard,tracking,order management', 'PastProjects/43-Tiryaq_Release-2.pdf', 'Health'),
(44, 'Sekkah', '\"Sekkah\" is a hybrid mobile application designed to enhance the public transportation experience for Riyadh\'s metro and bus passengers. It offers a range of features, including interactive maps to locate nearby stations, route planning, real-time journey tracking, and online ticket purchases. Developed using the Scrum agile methodology, the application integrates the Dijkstra algorithm and Google Maps API for optimized route planning. An admin dashboard complements the app, providing real-time updates on station availability and delays. \"Sekkah\" aims to streamline public transportation, reducing traffic congestion and improving commuter convenience across Riyadh.', 'public transportation,riyadh metro,bus passengers,route planning,interactive maps,real-time tracking,online ticket purchase,google maps,admin dashboard,traffic congestion,commuter convenience', 'PastProjects/44-Sekkah_Release-2.pdf', 'Smart Cities & Environment'),
(45, 'Huna KSA', 'Huna KSA is a mobile application designed to enhance tourism in Saudi Arabia by providing tourists and locals with personalized recommendations based on their interests. The app uses machine learning algorithms and a recommender system to suggest tourist destinations, activities, and recreational spots, including specialized options for women and children. By integrating Google Maps API, users can easily locate and navigate to their chosen sites. Developed using Flutter and Firebase, Huna KSA aligns with Saudi Arabia’s Vision 2030, promoting tourism and showcasing the country’s diverse attractions while providing a modern solution to boost visitor engagement.', 'tourism,recommendation,SaudiArabia,mobileapplication,machinelearning,GoogleMapsAPI,Vision2030', 'PastProjects/45-HunaKSA_Release-2.pdf', 'Entertainment'),
(46, 'STEGO', 'STEGO is an Android mobile application designed to enhance the security of information exchange through the use of steganography. It allows users to hide secret messages within images, making them appear as innocent photos to anyone without access. Using the camera or selecting from the gallery, users can embed confidential messages, which only the intended recipient can decode with a shared secret key. The application leverages asymmetric key cryptography to securely share this key, ensuring high security for private communications.STEGO prioritizes user convenience and data protection.', 'steganography,security,privacy,android,application,encryption,secretmessage,communication,data,cryptography,agilemethodology,imageembedding,cameraintegration,asymmetrickey,confidentiality', 'PastProjects/46-STEGO_Report.pdf', 'Security'),
(47, 'ALQ', 'ALQ is an educational mobile application designed for young learners aged 10 to 15, aimed at making the study of human anatomy interactive and engaging. By utilizing augmented reality (AR) technology, the app allows users to visualize 3D models of various human body systems and interact with these models in real time. Users can explore and rotate the models, learning about different organs and their functions. The app also includes quizzes after each system to test and reinforce users\' knowledge, making learning both informative and enjoyable.', 'augmentedreality,humananatomy,younglearners,educationalapp,interactivelearning,3dmodels,anatomyquiz,learningplatform', 'PastProjects/47-ALAQ_Release_2.pdf', 'Academic Solutions');

-- --------------------------------------------------------

--
-- Table structure for table `projects_technology`
--

CREATE TABLE `projects_technology` (
  `project_id` int(20) NOT NULL,
  `technology_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects_technology`
--

INSERT INTO `projects_technology` (`project_id`, `technology_id`) VALUES
(1, 1),
(2, 1),
(6, 1),
(31, 1),
(43, 1),
(2, 2),
(3, 2),
(7, 2),
(15, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(28, 2),
(30, 2),
(31, 2),
(32, 2),
(46, 2),
(1, 3),
(2, 3),
(6, 3),
(25, 3),
(28, 3),
(29, 3),
(39, 3),
(1, 4),
(2, 4),
(9, 4),
(14, 4),
(19, 4),
(24, 4),
(32, 4),
(40, 4),
(44, 4),
(4, 5),
(10, 5),
(11, 5),
(16, 5),
(27, 5),
(30, 5),
(37, 5),
(38, 5),
(3, 6),
(4, 6),
(5, 6),
(7, 6),
(8, 6),
(9, 6),
(11, 6),
(12, 6),
(13, 6),
(14, 6),
(15, 6),
(20, 6),
(21, 6),
(22, 6),
(23, 6),
(26, 6),
(27, 6),
(30, 6),
(33, 6),
(34, 6),
(37, 6),
(45, 6),
(9, 7),
(12, 7),
(13, 7),
(17, 7),
(18, 7),
(21, 7),
(22, 7),
(29, 7),
(30, 7),
(35, 7),
(37, 7),
(41, 7),
(42, 7),
(45, 7),
(22, 8),
(36, 8),
(47, 8);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `team_email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`name`, `email`, `team_email`, `phone_number`) VALUES
('shoug alshaya', '443200001@student.ksu.edu.sa', '443200001@student.ksu.edu.sa', NULL),
('Reema Alqassem', '443200002@student.ksu.edu.sa', '443200001@student.ksu.edu.sa', NULL),
('Norah Alrajhi', '443200556@student.ksu.edu.sa', '443200556@student.ksu.edu.sa', NULL),
('Alhanouf Alshalan', '443200961@student.ksu.edu.sa', '443200556@student.ksu.edu.sa', NULL),
('Alia Alrassan', '443202519@student.ksu.edu.sa', '443200556@student.ksu.edu.sa', NULL),
('Marya Asaad', '443200794@student.ksu.edu.sa', '443200556@student.ksu.edu.sa', NULL),
('Sarah al', '443200003@student.ksu.edu.sa', '443200003@student.ksu.edu.sa', NULL),
('myriam al', '443200004@student.ksu.edu.sa', '443200003@student.ksu.edu.sa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `track` enum('Artificial Intelligence','Cybersecurity','Internet of Things') DEFAULT NULL,
  `idea` text,
  `interest` text,
  `availability` enum('Available','Unavailable') NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`email`, `name`, `password`, `track`, `idea`, `interest`, `availability`, `phone_number`) VALUES
('aabeer@KSU.EDU.SA', 'Abeer Aldayel', '1', 'Artificial Intelligence', '', 'Computational Social Science,Natural Language Processing', 'Unavailable', ''),
('ajafri@KSU.EDU.SA', 'Afshan Jafri', '1', NULL, NULL, 'Natural Language Processing,Data Analytics,Cloud Computing,Distributed Programming,Parallel Programming,Scientific Computing', 'Available', ''),
('alyahya@KSU.EDU.SA', 'Maha AlYahya', '1', 'Artificial Intelligence', NULL, 'Arabic NLP,AI for Arabic Language ', 'Available', ''),
('amajdah@KSU.EDU.SA', 'Majdah Alshehri', '1', NULL, NULL, 'HCI,Inclusive Technology,Design Methods,Internet Of Things', 'Available', ''),
('dalsaeed@KSU.EDU.SA', 'Duaa Alsaeed', '1', 'Artificial Intelligence', NULL, 'Artificial Intelligence,Usability,User Experience,Image Processing,Recommender Systems. ', 'Available', ''),
('eabdulqader@KSU.EDU.SA', 'Ebtisam Alabdulqader', '1', NULL, NULL, 'Human Computer Interaction,Internet of Things,Artificial Intelligence', 'Available', ''),
('ealkhamis@KSU.EDU.SA', 'Esra Alkhamis', '$2y$10$kV.nQZVm28Ts8Y.NFHBX1eXSKkvgMvGzRYrQCY7lVSbdvkOtiOi8y', 'Cybersecurity', NULL, 'Usable Security,Information Security', 'Available', ''),
('halbaity@KSU.EDU.SA', 'Heyam AlBaity	', '1', NULL, NULL, 'Artificial Intelligence,Data Science,Machine Learning,Computer Vision,Biometrics', 'Available', ''),
('halhindi@KSU.EDU.SA', 'Hanan Alhindi', '1', 'Cybersecurity', NULL, 'Cybersecurity,Security', 'Available', ''),
('halsaaran@KSU.EDU.SA', 'Hessah Alsaaran', '1', 'Artificial Intelligence', NULL, 'Computer Vision,Image Analysis,Video Analysis,Machine Learning,Artificial Intelligence', 'Available', ''),
('healbassam@KSU.EDU.SA', 'Hend Albassam', '1', 'Artificial Intelligence', 'application designed to simplify the management of personal and professional schedules using Artificial Neural Networks (ANNs). The app integrates with users’ calendars, emails, and task management tools to analyze and prioritize activities based on deadlines, importance, and personal preference.', 'Software Engineering,User Experience Design,Artificial Intelligenc, prompt engineering.', 'Available', ''),
('hmokhtar@KSU.EDU.SA', 'Hala Mokhtar', '1', NULL, NULL, 'Internet of Things, Wireless Networks,Artificial Intelligence,Machine Learning,Smart Education Systems', 'Available', ''),
('kalyahya1@KSU.EDU.SA', 'Khulood Alyahya', '1', NULL, NULL, 'Artificial Intelligence,Large Language Models,Optimisation,General Machine Learning,Machine Learning in Finance,Data Visualisation,Time Series Forecasting,Data Science in Medical,Data Science in Biological,Data science in Behavioural and Decision Making', 'Available', ''),
('ksaleh@KSU.EDU.SA', 'Kholoud AlSaleh', '1', 'Cybersecurity', NULL, 'Searchable Encryption,Cryptography', 'Available', ''),
('lalbraheem@KSU.EDU.SA', 'Lamia Albraheem', '1', 'Internet of Things', NULL, 'Internet of Things,VANET,Wireless Networking,GIS,LiFi ', 'Available', ''),
('laldubaie@KSU.EDU.SA', 'Lulwa Aldubaie', '1', NULL, NULL, 'Natural Language Processing', 'Available', ''),
('lalhusain@KSU.EDU.SA', 'Luluah Alhusain', '1', NULL, NULL, 'Smart Cities,Healthcare,Machine Learning', 'Available', ''),
('lalsudias@KSU.EDU.SA', 'Lama Alsudias', '$2y$10$2q0PUN.pX8kkTjOLCZUhvO3/kkvj6WliQFeM98IOLikIefrRzTP16', 'Internet of Things', 'A web-based AI-powered platform designed to provide personalized insights and recommendations for businesses, students, and individuals. InsightBot AI leverages machine learning and NLP (Natural Language Processing) to analyze uploaded data, texts, or goals and provide actionable advice.', 'Natural Language Processing,Data Mining,Arabic applications', 'Available', '05555555556'),
('lalzaben@KSU.EDU.SA', 'Lama Alzaben', '1', NULL, NULL, 'Natural Language Processing,Mobile Applications,Web Applications,Lifestyle Applications,Educational Applications,Health Applications,Fitness Applications,Textual Data,Machine Learning,Smart Search Engines', 'Available', ''),
('maldayel@KSU.EDU.SA', 'Mashael Aldayel	\r\n', '1', 'Artificial Intelligence', NULL, 'Artificial Intelligence,Data Science, Machine Learning,Brain Computer Interface,Multidisciplinary,Neuro Tourism,Neuromarketing,Emotion Recognition,Bioinformatics,Recommenders System', 'Available', ''),
('malshardan@KSU.EDU.SA', 'Mona Alshardan', '1', NULL, NULL, 'Information Systems,Design Thinking,User Experience,Food Trucks Applications', 'Available', ''),
('nalrumaih@KSU.EDU.SA', 'Nouf Alrumaih', '1', NULL, NULL, 'Artificial Intelligence,Internet of Things', 'Available', ''),
('nhakbani@KSU.EDU.SA', 'Noura Hakbani', '1', 'Internet of Things', NULL, 'Internet of Things,Robotics,Virtual Reality,Fitness Applications,Rehabilitation,Education ', 'Available', ''),
('noralhammad@KSU.EDU.SA', 'Nora Alhammad', '1', NULL, NULL, 'Machine Learning,Artificial Intelligence', 'Available', ''),
('qalsmail@KSU.EDU.SA', 'Qatrunnada Alsmail', '$2y$10$lbt8RwIA1mi7RE.Db0IzBOyqThij9FQMj3yFqmFXBgTRAjKJEqLJO', 'Cybersecurity', NULL, 'Cybersecurity,Security', 'Available', ''),
('Qatrunnada@ksu.edu.sa', 'Qatrunnada', '$2y$10$lbt8RwIA1mi7RE.Db0IzBOyqThij9FQMj3yFqmFXBgTRAjKJEqLJO', 'Cybersecurity', 'A web-based AI-powered platform designed to provide advanced cybersecurity solutions for individuals and small businesses. SecureSphere AI helps users detect vulnerabilities, monitor threats, and take proactive measures to protect their digital assets.', '', 'Available', NULL),
('ralmurshed@KSU.EDU.SA', 'Rana Almurshed', '1', 'Artificial Intelligence', NULL, 'Image Processing,Artificial Intelligence', 'Available', ''),
('salrabiaah@KSU.EDU.SA', 'Sumayah AlRabiaa', '1', NULL, NULL, 'Optimization', 'Available', ''),
('sharefah@KSU.EDU.SA', 'Sharefah Al Ghamdi', '1', NULL, NULL, 'Natural Language Processing,Machine Learning', 'Available', ''),
('walkaldi@KSU.EDU.SA', 'Wejdan Alkaldi', '1', 'Artificial Intelligence', NULL, 'Artificial Intelligence,Deep Learning,Natural Language Processing,Image Processing, Reinforcement Learning', 'Available', '');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_idea_request`
--

CREATE TABLE `supervisor_idea_request` (
  `id` int(20) NOT NULL,
  `status` enum('Pending','Approved','Rejected','Canceled') NOT NULL,
  `team_email` varchar(255) NOT NULL,
  `supervisor_email` varchar(255) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supervisor_idea_request`
--

INSERT INTO `supervisor_idea_request` (`id`, `status`, `team_email`, `supervisor_email`, `request_date`) VALUES
(1, 'Pending', '443200001@student.ksu.edu.sa', 'lalsudias@KSU.EDU.SA', '2024-11-30'),
(2, 'Pending', '443200556@student.ksu.edu.sa', 'lalsudias@KSU.EDU.SA', '2024-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_projects`
--

CREATE TABLE `supervisor_projects` (
  `supervisor_email` varchar(255) NOT NULL,
  `pastproject_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supervisor_projects`
--

INSERT INTO `supervisor_projects` (`supervisor_email`, `pastproject_id`) VALUES
('laldubaie@KSU.EDU.SA', 7),
('eabdulqader@KSU.EDU.SA', 8),
('ajafri@KSU.EDU.SA', 11),
('halsaaran@KSU.EDU.SA', 13),
('ksaleh@KSU.EDU.SA', 14),
('noralhammad@KSU.EDU.SA', 15),
('healbassam@KSU.EDU.SA', 16),
('nalrumaih@KSU.EDU.SA', 17),
('lalzaben@KSU.EDU.SA', 18),
('dalsaeed@KSU.EDU.SA', 19),
('lalsudias@KSU.EDU.SA', 21),
('walkaldi@KSU.EDU.SA', 22),
('kalyahya1@KSU.EDU.SA', 23),
('alyahya@KSU.EDU.SA', 25),
('laldubaie@KSU.EDU.SA', 26),
('halsaaran@KSU.EDU.SA', 31),
('noralhammad@KSU.EDU.SA', 33),
('lalsudias@KSU.EDU.SA', 34),
('walkaldi@KSU.EDU.SA', 36),
('kalyahya1@KSU.EDU.SA', 37),
('lalbraheem@KSU.EDU.SA', 39),
('healbassam@KSU.EDU.SA', 40),
('malshardan@KSU.EDU.SA', 40),
('nalrumaih@KSU.EDU.SA', 41),
('lalhusain@KSU.EDU.SA', 43),
('ajafri@KSU.EDU.SA', 45),
('ksaleh@KSU.EDU.SA', 46);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `leader_email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `interest` text,
  `logo` varchar(255) DEFAULT NULL,
  `draft_ideas` text,
  `supervisor_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`leader_email`, `name`, `password`, `interest`, `logo`, `draft_ideas`, `supervisor_email`) VALUES
('443200001@student.ksu.edu.sa', 'shoug alshaya', '$2y$10$W4vWyNsd8cKt6.QVgrH/n.m.XVdhhZtWIa.slZYU15QFepWX2Tsem', '2,4,6', NULL, NULL, 'lalsudias@KSU.EDU.SA'),
('443200003@student.ksu.edu.sa', 'Sarah al', '$2y$10$crCeA/1deO7V2mE.XDMzIeb8AZAQu1AhO.otJJVyMX2Lv5CdUsvPq', '1,2,5', NULL, NULL, NULL),
('443200556@student.ksu.edu.sa', 'Norah Alrajhi', '$2y$10$V17rQ0oPZ4gpvM4f1g.FSek1QSi.tkFlXhUGIVyyJu/cyMMYHWzvm', '6,7,8', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_idea_request`
--

CREATE TABLE `team_idea_request` (
  `id` int(20) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Pending','Approved','Rejected','Canceled') NOT NULL,
  `team_email` varchar(255) NOT NULL,
  `supervisor_email` varchar(255) NOT NULL,
  `request_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_idea_request`
--

INSERT INTO `team_idea_request` (`id`, `project_name`, `description`, `status`, `team_email`, `supervisor_email`, `request_date`) VALUES
(3, 'ParkFinder', 'A map-based app that helps users locate nearby parks and green spaces. Includes filters for amenities like playgrounds, trails, and picnic areas.', 'Pending', '443200001@student.ksu.edu.sa', 'alyahya@KSU.EDU.SA', '2024-11-30'),
(6, 'StudyBuddy', 'A minimalist app for students to organize study schedules, set reminders for exams, and create flashcards for learning.', 'Pending', '443200003@student.ksu.edu.sa', 'lalsudias@KSU.EDU.SA', '2024-11-30'),
(7, 'PetPal', 'An app to schedule reminders for pet care, like feeding, grooming, and vet appointments. It also includes a journal to track your pet’s milestones.', 'Pending', '443200003@student.ksu.edu.sa', 'qalsmail@KSU.EDU.SA', '2024-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `technologies`
--

CREATE TABLE `technologies` (
  `id` int(20) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `technologies`
--

INSERT INTO `technologies` (`id`, `name`) VALUES
(1, 'Networking Technologies'),
(2, 'Data Monitoring & Analysis'),
(3, 'Internet of Things '),
(4, 'Cloud Computing'),
(5, 'Natural Language Processing'),
(6, 'Machine Learning'),
(7, 'Recommendation System'),
(8, 'Face Recognition');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `external_departments_requests`
--
ALTER TABLE `external_departments_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_adminemail_admin` (`admin_email`);

--
-- Indexes for table `past_projects`
--
ALTER TABLE `past_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects_technology`
--
ALTER TABLE `projects_technology`
  ADD PRIMARY KEY (`project_id`,`technology_id`),
  ADD KEY `FK_technologyid_projectstechnology` (`technology_id`),
  ADD KEY `FK_projectid_projectstechnology` (`project_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD KEY `FK_teamemail_team` (`team_email`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `supervisor_idea_request`
--
ALTER TABLE `supervisor_idea_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_supervisoremail_supervisor1` (`supervisor_email`),
  ADD KEY `FK_teamemail_team2` (`team_email`);

--
-- Indexes for table `supervisor_projects`
--
ALTER TABLE `supervisor_projects`
  ADD PRIMARY KEY (`supervisor_email`,`pastproject_id`),
  ADD KEY `FK_pastprojectid_pastprojects` (`pastproject_id`),
  ADD KEY `FK_supervisoremail_supervisor` (`supervisor_email`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`leader_email`),
  ADD KEY `FK_supervisoremail_supervisor` (`supervisor_email`);

--
-- Indexes for table `team_idea_request`
--
ALTER TABLE `team_idea_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_teamemail_team1` (`team_email`),
  ADD KEY `FK_supervisoremail_supervisor2` (`supervisor_email`);

--
-- Indexes for table `technologies`
--
ALTER TABLE `technologies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `external_departments_requests`
--
ALTER TABLE `external_departments_requests`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `past_projects`
--
ALTER TABLE `past_projects`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `supervisor_idea_request`
--
ALTER TABLE `supervisor_idea_request`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_idea_request`
--
ALTER TABLE `team_idea_request`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `technologies`
--
ALTER TABLE `technologies`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `external_departments_requests`
--
ALTER TABLE `external_departments_requests`
  ADD CONSTRAINT `FK_adminemail_admin` FOREIGN KEY (`admin_email`) REFERENCES `admin` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects_technology`
--
ALTER TABLE `projects_technology`
  ADD CONSTRAINT `FK_projectid_pastprojects` FOREIGN KEY (`project_id`) REFERENCES `past_projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_technologyid__technologies` FOREIGN KEY (`technology_id`) REFERENCES `technologies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK_teamemail_team` FOREIGN KEY (`team_email`) REFERENCES `teams` (`leader_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisor_idea_request`
--
ALTER TABLE `supervisor_idea_request`
  ADD CONSTRAINT `FK_supervisoremail_supervisor1` FOREIGN KEY (`supervisor_email`) REFERENCES `supervisors` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_teamemail_team2` FOREIGN KEY (`team_email`) REFERENCES `teams` (`leader_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supervisor_projects`
--
ALTER TABLE `supervisor_projects`
  ADD CONSTRAINT `FK_pastprojectid_pastprojects` FOREIGN KEY (`pastproject_id`) REFERENCES `past_projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_supervisoremail _supervisor  ` FOREIGN KEY (`supervisor_email`) REFERENCES `supervisors` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `FK_supervisoremail_supervisor` FOREIGN KEY (`supervisor_email`) REFERENCES `supervisors` (`email`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `team_idea_request`
--
ALTER TABLE `team_idea_request`
  ADD CONSTRAINT `FK_supervisoremail_supervisor2` FOREIGN KEY (`supervisor_email`) REFERENCES `supervisors` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_teamemail_team1` FOREIGN KEY (`team_email`) REFERENCES `teams` (`leader_email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
