# Content Management System (CMS)

## Prerequisites

Before you can run locally, ensure that your computer meets the following requirements:

- Node.js: [Download and install Node.js](https://nodejs.org/).
- PHP: [Download and install the latest version of PHP](https://www.php.net/downloads.php).

## Installation

1. Clone this repository to your local machine:

   ```bash
   git clone https://github.com/WarpDrive2036/CMS

2. Navigate to the project directory:
  cd your-cms-name

Check the configuration file located at config/config.php. Ensure that it contains the following database settings:
'host' => 'localhost',
'port' => 3306,
'dbname' => 'cms',
'charset' => 'utf8mb4',
// Add username and password if necessary
'username' => 'your_db_username',
'password' => 'your_db_password',

Update the configuration file with the appropriate values for your local database setup.

3. Usage
To run Your CMS Name locally, follow these steps:

Open a terminal or command prompt.

Navigate to the project directory:
cd your-cms-name

Start a local web server to serve the project from the public folder:
php -S localhost:8888 -t public

Finally, Open your web browser and access the CMS at http://localhost:8888.








