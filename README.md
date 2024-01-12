# Project Name

## Description

This project is a Wiki Content Management System designed to provide an efficient back office for administrators and a user-friendly front office for authors. The system enables easy management of categories, tags, and wikis, allowing authors to create, modify, and delete their content. The emphasis on the front office includes a simplified registration process, an effective search bar, and dynamic displays of the latest wikis and categories for seamless navigation.

## Technologies Used

- **Frontend:** HTML5, CSS Framework, Javascript
- **Backend:** PHP 8 with MVC Architecture
- **Database:** PDO driver

## Key Features

### Back Office

- **Category Management (Admin):**
  - Create, modify, and delete categories.
  - Associate multiple wikis with a category.

- **Tag Management (Admin):**
  - Create, modify, and delete tags.
  - Associate tags with wikis for precise navigation.

- **Author Registration:**
  - Authors can register with basic information (name, email, secure password).

- **Wiki Management (Authors and Admins):**
  - Authors can create, modify, and delete their wikis.
  - Authors can associate a single category and multiple tags with their wikis.
  - Admins can archive inappropriate wikis for a safe and relevant environment.

- **Dashboard Homepage:**
  - View entity statistics via the dashboard.

### Front Office

- **Login and Register:**
  - Users can create an account and log in.
  - Admins redirected to the dashboard; others to the homepage.

- **Search Bar:**
  - AJAX-enabled search bar for seamless searching of wikis, categories, and tags.

- **Latest Wikis Display:**
  - Homepage or dedicated section displaying the latest added wikis.

- **Latest Categories Display:**
  - Separate section presenting recently created or updated categories.

- **Redirect to Wiki Single Page:**
  - Clicking on a wiki redirects users to a dedicated page with complete details.

## Bonus Features

- **Image Upload in PHP:**
  - Option to upload images to enrich content.

- **MVC Architecture:**
  - Routing system based on Model-View-Controller architecture.
  - Autoload using namespaces for class organization.


## Installation
1. Clone this repository or download zip
```bash
git clone https://github.com/itzibtihal/Wiki.git
```
2. run the following CMDs in vsCode terminal 
```bash
    composer init 
```
3. 

 ```bash
    composer require vlucas/phpdotenv 
``` 
4. 

 ```bash
    composer dump-autoload 
```